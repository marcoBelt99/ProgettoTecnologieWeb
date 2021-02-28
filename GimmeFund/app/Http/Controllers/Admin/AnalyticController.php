<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Donation;

class AnalyticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {   
        return view('admin.analytics.analytics');
    }

    /**
     * @author @EnricoBreg
     * Extract data from database, for ajax method.
     *
     * @return json_encoded data for view
     */
    public function getChartDataDonPerDate() 
    {
        // Ricavo le date delle donazioni
        $dates = Donation::select('date')->distinct()->orderBy('date', 'asc')->get();
        
        // Ricavo somme importi donazioni ordinate per data
        $totAmountPerDate = array();
        foreach($dates as $d) {
            array_push($totAmountPerDate, Donation::where('date', $d['date'])->sum('amount'));
        }
        
        $totDonNumber = [];
        foreach($dates as $d) {
            $count = Donation::where('date', $d->date)->count();
            array_push($totDonNumber, $count);
        }
        
        return json_encode([
            'status' => 'success',
            'axisX' => $dates,
            'axisY' => $totAmountPerDate,
            'numDonations' => $totDonNumber
        ]);
    }

    /**
     * @author @EnricoBreg
     * Extract data from database, for ajax method.
     *
     * @return json_encoded data for view
     */
    public function updateChartDataDonPerDate(Request $request) 
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        // DATE DI PROVA
        /* $startDate = date('2021-02-10');
        $endDate = date('2021-02-26'); */

        // Ricavo le date delle donazioni
        $dates = Donation::select('date')->distinct()->whereBetween('date', [$startDate, $endDate])->orderBy('date', 'asc')->get();

        // Ricavo somme importi donazioni ordinate per data
        $totAmountPerDate = array();
        foreach($dates as $d) {
            array_push($totAmountPerDate, Donation::where('date', $d['date'])->sum('amount'));
        }
        
        $totDonNumber = [];
        foreach($dates as $d) {
            $count = Donation::where('date', $d->date)->count();
            array_push($totDonNumber, $count);
        }
        
        return json_encode([
            'status' => 'success',
            'axisX' => $dates,
            'axisY' => $totAmountPerDate,
            'numDonations' => $totDonNumber
        ]);
    }
    
}