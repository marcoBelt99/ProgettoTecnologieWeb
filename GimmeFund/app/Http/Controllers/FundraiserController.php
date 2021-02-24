<?php

namespace App\Http\Controllers;

use App\Fundraiser;
use App\Donation;
use App\Category;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/* In questo file posso mettere tutte le funzioni che voglio, e richiamarle dove voglio :) */
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
            'media_url' => 'required',
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
            'media_url.required' => 'Manca il link per foto',
        ]);
        
        Fundraiser::create($input);

        return redirect('/fundraiser');
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
        return view('fundraiser.details')->with([
            'fundraiser' => $fundraiser,
            'author' => $author]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fundraiser  $fundraiser
     * @return \Illuminate\Http\Response
     */
    public function edit(Fundraiser $fundraiser)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fundraiser  $fundraiser
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fundraiser $fundraiser)
    {
        //
    }
}
