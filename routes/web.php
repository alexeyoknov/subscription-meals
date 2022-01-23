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

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/','App\Http\Controllers\SubscriptionMealsController@index');
Route::get('/subscription-meals/{id}','App\Http\Controllers\SubscriptionMealsController@showSubscription');
Route::get('/new-subscription-meals','App\Http\Controllers\SubscriptionMealsController@create')->name('subscriptionCreate');
Route::post('/new-subscription-meals','App\Http\Controllers\SubscriptionMealsController@store')->name('subscriptionStore');

