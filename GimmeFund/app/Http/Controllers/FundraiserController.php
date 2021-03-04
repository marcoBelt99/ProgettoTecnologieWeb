<?php

namespace App\Http\Controllers;

use App\Fundraiser;
use App\Donation;
use App\Category;
use App\User;
use App\Comment;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/* In questo file posso mettere tutte le funzion{{ i ch }}e voglio, e richiamarle dove voglio :) */
class FundraiserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = date('Y-m-d');
        // Solo raccolte fondi che non hanno raggiunto la data di scadenza
        $fundraisers = Fundraiser::all()->where('ending_date', '>', $today);
        $donations = array(); // Definisco la variabile donations come un array (associativo) da passare alla view fundraisers.index
        foreach($fundraisers as $fundraiser) {
            // Ogni entry rappresenta la somma delle donazione per quella data raccolta fondi
            $donations += [
                $fundraiser->id => Donation::select('amount')->where('fundraiser_id', $fundraiser->id)->sum('amount')
            ];
        }

        return view('fundraiser.index')->with([
            'fundraisers' => $fundraisers, 
            'donations' => $donations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('fundraiser.create')->with(['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $input = $request->all();
        // Uso sempre il metodo di Piva per la validazione
        $validator =$request->validate([
            // Regole di validazione
            'name' => 'required|max:255',
            'category_id' => 'required',
            'goal' => 'required|numeric',
            'ending_date' => 'required',
            'description' => 'required',
            'uploadedfile' => 'required',
        ], 
        [
            // Messaggi di errore 
            'name.required' => 'Dai un titolo alla tua campagna',
            'name.max' => 'Lunghezza massima del titolo consentita di 255 caratteri',
            'category_id.required' => 'Manca la categoria!',
            'goal.required' => 'Manca l\'importo che vuoi raccogliere',
            'goal.numeric' => 'L\'obiettivo deve essere un numero',
            'ending_date.required' => 'Manca la data di scandenza della campagna',
            'description.required' => 'Manca la descrizione della campagna',
            'uploadedfile.required' => 'Carica la foto per procedere',
        ]);
        
        // Variabili che servono per l'upload delle foto relative ad una nuova raccolta fondi
        $file = $request->file('uploadedfile');
        $filename = $file->getClientOriginalName();
        $filename = time() . '_' . $filename;
        
        $path = $file->storeAs('public', $filename);

        Fundraiser::create([
            'name' => $request->name,
            'description' => $request->description,
            'starting_date' => $request->starting_date,
            'ending_date' => $request->ending_date,
            'goal' => $request->goal,
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'filename' => $filename,
        ]);

        return redirect()->route('user.fundraisers', Auth::user()->id);
    }

    /**
     * Display the specified resource.
     * @param  \App\Fundraiser  $fundraiser
     * @return \Illuminate\Http\Response
     */
    public function show(Fundraiser $fundraiser)
    {
        //dd($fundraiser);
        $author = User::where('id', $fundraiser->user_id)->first();
        $donations = array();
        $donations = [$fundraiser->id => Donation::select('amount')->where('fundraiser_id', $fundraiser->id)->sum('amount')];
        
        $comments = Comment::where('fundraiser_id', $fundraiser->id)->get();

        $users = [];
        foreach($comments as $c) {
            $users += [$c->id => User::find($c->user_id)];
        }

        return view('fundraiser.details')->with([
            'fundraiser' => $fundraiser,
            'author' => $author,
            'donations' => $donations,
            'comments' =>  $comments,
            'users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fundraiser  $fundraiser
     * @return \Illuminate\Http\Response
     */
    public function edit(Fundraiser $fundraiser)
    {   
        $this->authorize('update', $fundraiser);

        $categories = Category::all();

        return view('user.fundraiser.edit')->with(['fundraiser'  => $fundraiser, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fundraiser  $fundraiser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fundraiser $fundraiser)
    {
        $this->authorize('update', $fundraiser);

        // modifica dei campi
        $fundraiser->name = $request->name;
        $fundraiser->description = $request->description;
        $fundraiser->goal = $request->goal;
        $fundraiser->category_id = $request->category_id;
        $fundraiser->ending_date = $request->ending_date;
        
        // Modifica foto
        if (isset($request->uploadedfile)) {
            $file = $request->file('uploadedfile');
            $filename = $file->getClientOriginalName();
            $filename = time() . '_' . $filename;
            $path = $file->storeAs('public', $filename);
            $fundraiser->filename = $filename;
        }

        // Salvataggio raccolta fondi
        $fundraiser->save();
        
        return redirect()->route('user.fundraisers', Auth::user()->id)->with(['message' => 'Modifiche salvate con successo']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fundraiser  $fundraiser
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fundraiser $fundraiser)
    {
        $this->authorize('delete', $fundraiser);
        
        $fundraiserToDelete = Fundraiser::find($fundraiser->id);
        Storage::delete($fundraiser->filename); // Cancellazione foto caricata 

        $fundraiserToDelete->delete(); // Cancellazione campagna

        return redirect()->route('user.fundraisers', Auth::user()->id);        
    }

    /**
     * @param userId
     * @return Campagne fondi utente
     */
    public function getUserFundraisers($userId) 
    {
        $userFundraisers = Fundraiser::where('user_id', $userId)->get();
        $totDonationsFundraiser = [];
        $numberDonationsFundraiser = [];

        foreach($userFundraisers as $uf) {
            $totDonationsFundraiser += [
                $uf->id => Donation::where('fundraiser_id', $uf->id)->sum('amount')
            ];
            $numberDonationsFundraiser += [
                $uf->id => Donation::where('fundraiser_id', $uf->id)->count()
            ];
        }

        $today = date('Y-m-d'); 

        return view('user.fundraiser.userFundraisers')
            ->with([
                'userFundraisers' => $userFundraisers,
                'totDonationsPerFundraiser' => $totDonationsFundraiser,
                'numberDonationsFundraiser' => $numberDonationsFundraiser,
                'today' => $today
                ]);
    }
}
