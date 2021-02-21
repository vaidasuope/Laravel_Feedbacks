<?php

use App\Service;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Console\Input\Input;

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
//Route::get('/', function () {
//    return view('pages/home');
//});

Route::get('/', "ServiceController@index");
Route::get('/add-service',"ServiceController@addService");
Route::post('/store', "ServiceController@addToDatabase");
Route::get('/delete/{service}', 'ServiceController@delete');
Route::get('/edit/{service}', 'ServiceController@edit');
Route::post('/storeUpdate/{service}', "ServiceController@storeUpdate");
Route::get('/service/{service}',"ServiceController@showFull");
Route::post('/addComment','ReviewController@addCommentToDatabase');
Route::post('/addStar','ReviewController@addStarToDatabase');

//Search
Route::get('/search','ServiceController@search');


Route::get('/add-spec', 'SpecializationController@addSpec');
Route::post('/saveSpec', 'SpecializationController@addToDatabaseSpecialization');

Route::get('/add-company','CompanyController@addCompany');
Route::post('/saveComp', 'CompanyController@addToDatabaseCompany');

Auth::routes();
Route::get("/logout", "\App\Http\Controllers\Auth\LoginController@logout");
//Route::get('/home', 'HomeController@index')->name('home');
