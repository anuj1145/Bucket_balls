<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('index',[MainController::class,"index"])->name('home');
Route::post('/save_bucket',[MainController::class,"save_bucket"])->name('save_bucket');
Route::post('/save_ball',[MainController::class,"save_balls"])->name('save_balls'); 
Route::post('/ball_place',[MainController::class,"place_ball"])->name('place_balls');


