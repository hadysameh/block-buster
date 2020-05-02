<?php

use Illuminate\Support\Facades\Route;
use App\Events\ReserveEvent;

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

Route::get('/', 'MoviesController@index');

Route::get('/seats/date/{date}/event/{event}/movie/{id}', 'SeatsController@create');

Route::get('/showtimes/{id}', 'ShowsController@show');

Route::post('/seats/buy','SeatsController@store');

Auth::routes();


// Route::get('/index', function ()
// {
//     return view('index');
// });

// Route::get('/index2', function ()
// {
    
//     return view('seats');
// });
// //->middleware('auth')
// Route::get('/index23', function ()
// {
//    broadcast(new ReserveEvent(1, 1));
//     // dd(env('PUSHER_APP_CLUSTER'));
//     if(true){
//         return 'test';
//     }
    
// });


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
