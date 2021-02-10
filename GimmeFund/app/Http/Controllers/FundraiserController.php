<?php

namespace App\Http\Controllers;

use App\Fundraiser;
use App\Donation;
use App\Category;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FundraiserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fundraisers = Fundraiser::all();
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
        Fundraiser::create([
            'name' => $request->name,
            'media_url' => $request->media_url,
            'description' => $request->description,
            'goal' => $request->goal,
            'starting_date' => date('Y-m-d'),
            'ending_date' => $request->ending_date,
            'category_id' => $request->category,
            'user_id' => Auth::user()->id,
        ]);

        return $this->index();
    }

    /**
     * Display the specified resource.
     *
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
