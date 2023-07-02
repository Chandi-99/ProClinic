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

Route::get('/',  [App\Http\Controllers\Home\welcomeController::class, 'index']);

Auth::routes();
Route::get('welcome', [App\Http\Controllers\Home\welcomeController::class, 'index']);
Route::get('/admin', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admindashboard');
Route::get('/staff', [App\Http\Controllers\Staff\StaffController::class, 'index'])->name('staffdashboard');
Route::get('/doctor', [App\Http\Controllers\Doctor\doctorDashboardController::class, 'index'])->name('doctordashboard');
Route::get('/home', [App\Http\Controllers\Home\HomeController::class, 'index']);

Route::post('/welcome', [App\Http\Controllers\Home\welcomeController::class, 'store'])->name('welcome');
Route::post('home', [App\Http\Controllers\Home\HomeController::class, 'store'])->name('home');

Route::get('donation', [App\Http\Controllers\Home\donationController::class, 'index'])->name('donation');;

Route::get('blog', [App\Http\Controllers\Blog\blogController::class, 'index'])->name('blog');
Route::post('blog', [App\Http\Controllers\Blog\blogController::class, 'update'])->name('blog.update');

Route::get('videochat', [App\Http\Controllers\Home\VideoChatController::class, 'index'])->name('videochat');
Route::post('auth', [App\Http\Controllers\Home\VideoChatController::class, 'auth']);

Route::get('/user/reports', [App\Http\Controllers\Home\reportController::class, 'index'])->name('user.reports');
Route::post('/user/reports', [App\Http\Controllers\Home\reportController::class, 'updateReports'])->name('user.reports.update');

Route::get('/rooms', [App\Http\Controllers\Staff\roomController::class, 'index'])->name('room');
Route::post('/rooms', [App\Http\Controllers\Staff\roomController::class, 'create'])->name('room.create');

Route::get('/newPatient', [App\Http\Controllers\Staff\patientController::class, 'index'])->name('patient');
Route::post('/newPatient', [App\Http\Controllers\Staff\patientController::class, 'create'])->name('patient.create');

Route::get('/newDoctor', [App\Http\Controllers\Staff\doctorController::class, 'index'])->name('doctor');
Route::post('/newDoctor', [App\Http\Controllers\Staff\doctorController::class, 'create'])->name('doctor.create');

Route::get('/newpost', [App\Http\Controllers\Blog\postController::class, 'index'])->name('post');
Route::post('/newpost', [App\Http\Controllers\Blog\postController::class, 'create'])->name('post.create');

Route::get('/newNurse', [App\Http\Controllers\Staff\nurseController::class,'index'])->name('newNurse');
Route::post('/newNurse', [App\Http\Controllers\Staff\nurseController::class,'store'])->name('newNurse.store');

Route::get('/assignNurse', [App\Http\Controllers\Staff\assignNurseController::class,'index'])->name('assignNurse');
Route::post('/assignNurse', [App\Http\Controllers\Staff\assignNurseController::class,'store'])->name('assignNurse.store');

Route::get('/doctorblog', [App\Http\Controllers\Blog\doctorBlogController::class, 'index'])->name('doctorBlog');
Route::post('/doctorblog', [App\Http\Controllers\Blog\doctorBlogController::class, 'update'])->name('doctorBlog.update');

Route::get('/blog/{post}', [\App\Http\Controllers\Blog\BlogPostController::class, 'index']);
Route::post('/blog/{post}', [\App\Http\Controllers\Blog\BlogPostController::class, 'update']);





