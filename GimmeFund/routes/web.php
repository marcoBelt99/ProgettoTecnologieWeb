<?php

use Illuminate\Support\Facades\Route;
/*
----- -----------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Raggruppo le rotte per l'utente all'interno del gruppo admin. Admin gestisce gli utenti 
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function() {
    // Creo le rotte per il controller degli utenti. Tranne per i metodi che non servono in questo caso
    Route::resource('/users', 'UsersController', ['except' => ['show', 'create', 'store']]);
});

/** @author Breg */
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:see-analytics')->group(function() {
    /* Creo la rotta per la visualizzazione degli analytics dell'admin */
    /** @author Breg */
    Route::get('/analytics', 'AnalyticController@index')->name('analytics.index')->middleware('can:see-analytics');
    Route::get('/analytics/chartData', 'AnalyticController@getChartDataDonPerDate')->name('analytics.get.harts.data')->middleware('can:see-analytics');
    Route::post('/analytics/updateChartsData', 'AnalyticController@updateChartDataDonPerDate')->name('analytics.update1.charts.data')->middleware('can:see-analytics');
    Route::post('/analytics/getThreeCatChartsData', 'AnalyticController@getDataCategoryCharts')->name('analytics.update2.charts.data')->middleware('can:see-analytics');
});

/** @author Breg 
 * Route per CRUD categorie
*/
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-categories')->group(function() {
    Route::resource('/category', 'CategoryController');
});

/* Creo la rotta per la raccolta fondi: effettuabile solo dagli utenti ordinari */
Route::resource('/fundraiser', 'FundraiserController', ['except' => ['index', 'update', 'show', 'edit']])->middleware('can:make-fundraiser');
Route::put('/update/fundraiser/{fundraiser}', 'FundraiserController@update')->name('fundraiser.update');
Route::get('/show/fundraiser/{fundraiser}', 'FundraiserController@show')->name('show.fundraiser');
Route::get('/fundraiser/user/{user}', 'FundraiserController@getUserFundraisers')->name('user.fundraisers')->middleware('can:make-fundraiser');
Route::get('/fundraiser', 'FundraiserController@index')->name('fundraiser.index');
Route::get('/fundraiser/{fundraiser}/edit', 'FundraiserController@edit');

/* Creo la rotta per la pagina fundraiser ed il middleware per differenziare sempre le azioni per utente ordinario e admin */
Route::get('/donation/{id}', 'DonationController@create')->name('donation.create')->middleware(['auth', 'can:make-donation']);

/* Creo la rotta per la pagina delle donazioni */
Route::resource('/donation', 'DonationController', ['except' => ['create']]);

/* Creo la rotta per ... */
Route::put('/user/{user}', 'UserController@update')->name('user.update');
Route::resource('/user', 'UserController', ['except' => ['index', 'create', 'store', 'show', 'update']]);

/* Creo la rotta per la gestione dei coupon */
Route::prefix('user')->prefix('user')->name('user.')->group(function() {
    Route::get('/{user}/coupon', 'CouponController@index')->name('coupon.index');
    Route::resource('/coupon', 'CouponController', ['except' =>  ['index']])->middleware('can:create-coupon');
});

Route::get('/coupon', 'CouponController@create')->name('coupon.create');

/**  @author Marco Creo la rotta per la pagina di informazioni  */
Route::get('/information', function () {
    return view('information');
});

/** @author Breg */
Route::post('/user/{user}/password/' ,'Auth\ChangePasswordController@update')->name('user.change.password');

Route::get('/supportus', function () {
    return view('sostienici');
})->middleware('can:support-us');

/* Creo la rotta per la pagina chi siamo */
Route::get('/whoweare', function () {
    return view('whoweare');
});

/** Rotte dei commenti */
Route::resource('/comment', 'CommentController');