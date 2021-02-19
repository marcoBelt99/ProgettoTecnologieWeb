<?php

namespace App\Http\Controllers;
use App\Fundraiser;
use App\Donation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
    
     * @return v{{ oid }}
     */
    /* public function __construct()
    {
        $this->middleware('auth');
    } */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $fundraisers = Fundraiser::all();
        $donations = array(); // Definisco la variabile donations come un array (associativo) da passare alla view fundraisers.index
        $visual = array();
        $i = 0;

        foreach($fundraisers as $fundraiser) {
            // Ogni entry rappresenta la somma delle donazione per quella data raccolta fondi
            $donations += [
                $fundraiser->id => Donation::select('amount')->where('fundraiser_id', $fundraiser->id)->sum('amount')
            ];
            
            // visual serve per ottenere l'url delle immagini e la data.
            // take serve per ..
        }
       
        foreach($fundraisers as $fundraiser){
            $visual[$i] = [
                //Fundraiser::select('media_url', 'starting_date')->orderBy('starting_date','desc')->take(3)->get()
                /* $sites = Site::select('code_site')->orderBy('code_site','desc')->get(); */
                Fundraiser::select('media_url')->orderBy('starting_date')->get()
            ];
            ++$i;
        }
        

        //dd($visual);

        return view('home')->with([
            'fundraisers' => $fundraisers, 
            'donations' => $donations,
            'visual' => $visual ]);
    }
}


?>