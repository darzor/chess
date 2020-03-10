<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');
Auth::routes();


Route::get('/odaberi_suparnika/{notify}', 'ChessController@odaberi_suparnika');
Route::post('/odaberi_igraca', 'ChessController@odaberi_igraca');
Route::post('/prihvati_zahtjev', 'ChessController@prihvati_zahtjev');
Route::post('/odbij_zahtjev', 'ChessController@odbij_zahtjev');
Route::post('/nastavi_kasnije', 'ChessController@nastavi_kasnije');
Route::post('/zavrsi_igru', 'ChessController@zavrsi_igru');
Route::get('/nova_igra/{id}', 'ChessController@nova_igra');
Route::post('/povuci_potez/{id}', 'ChessController@povuci_potez');


//Route::get('/home', 'HomeController@index')->name('home');
