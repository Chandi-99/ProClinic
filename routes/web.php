<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;

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

Route::get('/home/{user}', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/welcome', function(){
    return view('welcome');
});
Route::post('welcome', [App\Http\Controllers\welcomeController::class, 'store'])->name('welcome');
Route::post('home', [App\Http\Controllers\HomeController::class, 'store']);

Route::get('donation', [App\Http\Controllers\donationController::class, 'index'])->name('donation');;
Route::post('donation', [App\Http\Controllers\stripeController::class, 'chargeCustomer'])->name('donation');
Route::get('blog', [App\Http\Controllers\blogController::class, 'index'])->name('blog');


