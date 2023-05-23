<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/welcome', function(){
    return view('welcome');
});
Route::post('welcome', [App\Http\Controllers\contactController::class, 'store'])->name('welcome');
Route::post('home', [App\Http\Controllers\HomeController::class, 'store'])->name('home');

//Route::get('searchMedicine', [App\Http\Controllers\searchMediController::class, 'index'])->name('searchmedicine');

