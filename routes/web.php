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

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/welcome', function(){
    return view('welcome');
});

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admindashboard');
Route::get('/staff', [App\Http\Controllers\StaffController::class, 'index'])->name('staffdashboard');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('welcome', [App\Http\Controllers\welcomeController::class, 'store'])->name('welcome');
Route::post('home', [App\Http\Controllers\HomeController::class, 'store']);

Route::get('donation', [App\Http\Controllers\donationController::class, 'index'])->name('donation');;
Route::post('donation', [App\Http\Controllers\stripeController::class, 'chargeCustomer']);
Route::get('blog', [App\Http\Controllers\blogController::class, 'index'])->name('blog');

Route::get('videochat', [App\Http\Controllers\VideoChatController::class, 'index'])->name('videochat');
Route::post('auth', [App\Http\Controllers\VideoChatController::class, 'auth']);


