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
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function() {
    /* Creo la rotta per la visualizzazione degli analytics dell'admin */
    /** @author Breg */
    Route::get('/analytics', 'AnalyticController@index')->name('analytics.index');
    Route::get('/analytics/chartData', 'AnalyticController@getChartDataDonPerDate')->name('analytics.get.harts.data');
    Route::post('/analytics/updateChartsData', 'AnalyticController@updateChartDataDonPerDate')->name('analytics.update.charts.data');
});

/* Creo la rotta per la raccolta fondi: effettuabile solo dagli utenti ordinari */
Route::resource('/fundraiser', 'FundraiserController');//->middleware('can:make-fundraiser');

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

/**  @author Marco Creo la rotta per la pagina di informazioni: chi siamo (whoweare?)  */
Route::get('/information', function () {
    return view('information');
});

/** @author Breg */
Route::post('/user/{user}/password/' ,'Auth\ChangePasswordController@update')->name('user.change.password');

/** @author Marco
 *  Creo la rotta per poter gestire le immagini nei tag <img src="" ...>
 */
/* use App\Http\Controllers\StorageFileController;
Route::get('image/{filename}', [StorageFileController::class,'getPubliclyStorgeFile'])->name('image.displayImage');
Route::get('image/{filename}', 'StorageFileController@displayImage')->name('image.displayImage'); */

Route::get('/sostienici', function () {
    return view('sostienici');
});

Route::get('/whoweare', function () {
    return view('whoweare');
});