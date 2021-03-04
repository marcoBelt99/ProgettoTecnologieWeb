<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Donation;
use App\Category;
use App\Fundraiser;

class AnalyticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {   
        $donationCategories = Category::all();
        return view('admin.analytics.analytics')->with('donationCategories', $donationCategories);
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
        // Dati per il primo grafico
        $totAmountPerDate = array();
        foreach($dates as $d) {
            array_push($totAmountPerDate, Donation::where('date', $d['date'])->sum('amount'));
        }

        // Dati per il secondo grafico
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

        // Ricavo le date delle donazioni
        $dates = Donation::select('date')->distinct()->whereBetween('date', [$startDate, $endDate])->orderBy('date', 'asc')->get();

        // Ricavo somme importi donazioni ordinate per data
        // Dati per il primo grafico
        $totAmountPerDate = array();
        foreach($dates as $d) {
            array_push($totAmountPerDate, Donation::where('date', $d['date'])->sum('amount'));
        }
        
        // Dati per il secondo grafico
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
    public function getDataCategoryCharts(Request $request) 
    {  
        $categoriesNumber = Category::all()->count();

        $firstCategoryId  = $request->first_category_id  ?? $firstCategoryId  = rand(1, $categoriesNumber);
        $secondCategoryId = $request->second_category_id ?? $secondCategoryId = rand(1, $categoriesNumber);
        $thirdCategoryId  = $request->third_category_id  ?? $thirdCategoryId  = rand(1, $categoriesNumber);

        $firstCategoryFundraisers     = Fundraiser::where('category_id', $firstCategoryId)->count();
        $secondCategoryFundraisers    = Fundraiser::where('category_id', $secondCategoryId)->count();
        $thirdCategoryFundraisers     = Fundraiser::where('category_id', $thirdCategoryId)->count();
        $temp                         = Fundraiser::count();
        $remaingCategoryFundraisers   = $temp - $firstCategoryFundraisers - $secondCategoryFundraisers - $thirdCategoryFundraisers;

        $firstCategory  = Category::find($firstCategoryId);
        $secondCategory = Category::find($secondCategoryId);
        $thirdCategory  = Category::find($thirdCategoryId);

        $firstCategoryName  = Category::select('name')->where('id', $firstCategoryId)->first();
        $secondCategoryName = Category::select('name')->where('id', $secondCategoryId)->first();
        $thirdCategoryName  = Category::select('name')->where('id', $thirdCategoryId)->first();

        return json_encode([
            'status'         => 'success',
            'firstCategory'  => ['id' => $firstCategoryId,  'name' => $firstCategoryName,  'fundNumber' => $firstCategoryFundraisers],
            'secondCategory' => ['id' => $secondCategoryId, 'name' => $secondCategoryName, 'fundNumber' => $secondCategoryFundraisers],
            'thirdCategory'  => ['id' => $thirdCategoryId,  'name' => $thirdCategoryName,  'fundNumber' => $thirdCategoryFundraisers],
            'remaingCatFund' => ['name' => 'Restanti Campagne Fondi', 'fundNumber' => $remaingCategoryFundraisers],
        ]);
        
    }
    
}