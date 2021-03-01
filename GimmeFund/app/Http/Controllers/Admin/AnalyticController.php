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

    /**
     * @author @EnricoBreg
     * Extract data from database, for ajax method.
     *
     * @return json_encoded data for view
     */
    public function getDataCategoryCharts(Request $request) 
    {
        isset($request->first_category)   ? $first_category_id  = $request->first_category  : $first_category_id    = 14;
        isset($request->first_category)   ? $second_category_id = $request->second_category : $second_category_id   = 5;
        isset($request->first_category)   ? $third_category_id  = $request->third_category  : $third_category_id    = 11;

        $firstCategoryFundraisers     = Fundraiser::where('category_id', $first_category_id)->count();
        $secondCategoryFundraisers    = Fundraiser::where('category_id', $second_category_id)->count();
        $thirdCategoryFundraisers     = Fundraiser::where('category_id', $third_category_id)->count();

        $first_category  = Category::find($first_category_id);
        $second_category = Category::find($second_category_id);
        $third_category  = Category::find($third_category_id);
        
        return json_encode([
            'status'                => 'success',
            'firstCatFundNumber'    => $firstCategoryFundraisers,
            'secondCatFundNumber'   => $secondCategoryFundraisers,
            'thirdCatFundNumber'    => $thirdCategoryFundraisers,
            'firstCategoryName'     => $first_category->name,
            'secondCategoryName'    => $second_category->name,
            'thirdCategoryName'     => $third_category->name,
            'firstCategoryId'       => $first_category_id,
            'secondCategoryId'      => $second_category_id,
            'thirdCategoryId'       => $third_category_id,
        ]);
        
    }
    
}