<?php

namespace App\Http\Controllers;

use App\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Fundraiser;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donation = Donation::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($fundraiser_id)
    {
        return view('donation.create')->with('fundraiser_id', $fundraiser_id);
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

        $validator = Validator::make($input, [
            // Regole di validazione
            'amount' => 'required|numeric|min:1|max:200',
        ],    
        [
            // Messaggi di errore
            'amount.required' => 'Manca l\'importo della donazione',
            'amount.numeric' => 'L\'importo deve essere un numero',
            'amount.min' => 'L\'importo minimo della donazione è: 1.00 €',
            'amount.max' => 'L\'importo massimo della donazione è: 200.00 €'
        ]);

        if ($validator->fails()) {
            return redirect('/donation/create')->withErrors($validator)->withInput();
        }

        Donation::create($input);
        
        return redirect('/fundraiser');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function show(Donation $donation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function edit(Donation $donation)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donation $donation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donation $donation)
    {
        //
    }
}
