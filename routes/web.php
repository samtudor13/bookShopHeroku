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
//welcome page route
Route::get('/welcome', function () {
    return view('welcome');
});
//landing (home) page
Route::get('/landing', function () {
    return view('landing');
});

//landing page
Route::get('/landing', 'BookController@display');
//public books - pre-login
Route::get('/booksPublic', 'BookController@displayBooksPublic');
//user books - logged in
Route::get('/booksLoggedIn', 'BookController@displayBooksLoggedIn')->middleware('auth');

//admin
//Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function(){});

//admin route inc authentication
Route::get('/admin',['middleware' => 'adminmiddleware', function () {
    return view('admin');
}]);

//Route::resource('admin', 'BookController');

//post rights to admin page
Route::post('admin', 'BookController@store')->name('admin');

//redirects inital loading url to landing page
Route::get('/', function () {
    return redirect('landing');
});
