<?php

use Illuminate\Support\Facades\Route;

/*
{{-- |- --}} }}-----------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'FundraiserController@index')->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Raggruppo le rotte per l'utente all'interno del gruppo admin. Admin gestisce gli utenti 
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function() {
    // Creo le rotte per il controller degli utenti. Tranne per i metodi che non servono in questo caso
    Route::resource('/users', 'UsersController', ['except' => ['show', 'create', 'store']]);
});

/* Creo la rotta per la raccolta fondi: effettuabile solo dagli utenti ordinari */
Route::resource('/fundraiser', 'FundraiserController');//->middleware('can:make-fundraiser');
/* Creo la rotta per la pagina fundraiser */
Route::get('/donation/{id}', 'DonationController@create')->name('donation.create');
Route::resource('/donation', 'DonationController', ['except' => ['create']]);

Route::resource('/user', 'UserController', ['except' => ['index', 'create', 'store', 'store', 'show']]);