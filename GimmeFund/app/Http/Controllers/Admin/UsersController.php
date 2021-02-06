<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Gate;
use App\User;
use App\Role;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    // Questo metodo (costruttore) è chiamato quando sei loggato dentro
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Seleziona tutti gli utenti e li passa alla view.
        $users = User::all();
        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //dd($user); 
        /* Gestione dell'accesso: lo faccio con il gate creato nel file "AuthServiceProvider.php" */
        if (Gate::denies('edit-users')) {
            return redirect()->route('admin.users.index');
        }

        $roles = Role::all();

        return view('admin.users.edit')->with([
            'user' => $user,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //dd($request);

        // Applico le modifiche 
        /* ??? Mi salvo il ruolo dello user ???? . (Guardare in "User.php") */
        $user->roles()->sync($request->roles); // Sync accetta un array come parametro, attach solo uno. Sostanzialmente uguali 
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        // Salvo le modifiche
        $user->save();
        
        /* Ritorno la view dopo la modifica */
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //dd($user);

        if (Gate::denies('destroy-user')) {
            return redirect()->route('admin.users.index');
        }

        // Prima di eliminare un utente si devono rimuovere tutti i ruoli (ossia le chiavi esterne) a lui collegati. Per eliminarlo faccio così:
        $user->roles()->detach();
        $user->delete();

        return redirect()->route('admin.users.index');
    }

}