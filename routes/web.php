<?php

use Illuminate\Support\Facades\Route;

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


Auth::routes();

Route::get('/welcome', function () {
    return view('welcome');
});
//landing (home) page
Route::get('/landing', function () {
    return view('landing');
});

//landing page
Route::get('/landing', 'BookController@display');
//public
Route::get('/booksPublic', 'BookController@displayBooksPublic');
//user
Route::get('/booksLoggedIn', 'BookController@displayBooksLoggedIn')->middleware('auth');
//admin
//Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function(){});

Route::get('/admin',['middleware' => 'adminmiddleware', function () {
    return view('admin');
}]);

//Route::resource('admin', 'BookController');

Route::post('admin', 'BookController@store')->name('admin');
