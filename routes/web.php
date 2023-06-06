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

Route::get('/',  [App\Http\Controllers\welcomeController::class, 'index']);

Auth::routes();
Route::get('welcome', [App\Http\Controllers\welcomeController::class, 'index']);
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admindashboard');
Route::get('/staff', [App\Http\Controllers\StaffController::class, 'index'])->name('staffdashboard');
Route::get('/doctor', [App\Http\Controllers\doctorDashboardController::class, 'index'])->name('doctordashboard');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

Route::post('welcome', [App\Http\Controllers\welcomeController::class, 'store'])->name('welcome');
Route::post('home', [App\Http\Controllers\HomeController::class, 'store'])->name('home');

Route::get('donation', [App\Http\Controllers\donationController::class, 'index'])->name('donation');;
Route::post('donation', [App\Http\Controllers\stripeController::class, 'chargeCustomer']);
Route::get('blog', [App\Http\Controllers\blogController::class, 'index'])->name('blog');

Route::get('videochat', [App\Http\Controllers\VideoChatController::class, 'index'])->name('videochat');
Route::post('auth', [App\Http\Controllers\VideoChatController::class, 'auth']);

Route::get('/user/reports', [App\Http\Controllers\reportController::class, 'index'])->name('user.reports');
Route::post('/user/reports', [App\Http\Controllers\reportController::class, 'updateReports'])->name('user.reports.update');

Route::get('/rooms', [App\Http\Controllers\roomController::class, 'index'])->name('room');
Route::post('/rooms', [App\Http\Controllers\roomController::class, 'create'])->name('room.create');

Route::get('/newPatient', [App\Http\Controllers\patientController::class, 'index'])->name('patient');
Route::post('/newPatient', [App\Http\Controllers\patientController::class, 'create'])->name('patient.create');

Route::get('/newDoctor', [App\Http\Controllers\doctorController::class, 'index'])->name('doctor');
Route::post('/newDoctor', [App\Http\Controllers\doctorController::class, 'create'])->name('doctor.create');



