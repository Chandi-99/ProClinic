<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
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

Route::get('donation', [App\Http\Controllers\Home\donationController::class, 'index'])->name('donation');
Route::post('donation', [App\Http\Controllers\Home\donationController::class, 'donate'])->name('donationpost');

Route::get('blog', [App\Http\Controllers\Blog\blogController::class, 'index'])->name('blog');
Route::post('blog', [App\Http\Controllers\Blog\blogController::class, 'update'])->name('blog.update');

Route::get('videochat', [App\Http\Controllers\Home\VideoChatController::class, 'index'])->name('videochat');
Route::post('auth', [App\Http\Controllers\Home\VideoChatController::class, 'auth']);

Route::get('/user/reports', [App\Http\Controllers\Home\reportController::class, 'index'])->name('user.reports');
Route::post('/user/reports', [App\Http\Controllers\Home\reportController::class, 'updateReports'])->name('user.reports.update');
Route::get('/user/reports/{id}', function ($id) {
    $report = App\Models\Report::find($id);
    $report->delete();
    return redirect('/user/reports');
});
Route::get('/user/pdfreports/{id}', function ($id) {
    $pdf = App\Models\ReportPDF::find($id);
    $pdf->delete();
    return redirect('/user/reports');
});

Route::get('/rooms', [App\Http\Controllers\Staff\roomController::class, 'index'])->name('room');
Route::post('/rooms', [App\Http\Controllers\Staff\roomController::class, 'create'])->name('room.create');

Route::get('/newPatient', [App\Http\Controllers\Staff\patientController::class, 'index'])->name('patient');
Route::post('/newPatient', [App\Http\Controllers\Staff\patientController::class, 'create'])->name('patient.create');

Route::get('/newDoctor', [App\Http\Controllers\Staff\doctorController::class, 'index'])->name('doctor');
Route::post('/newDoctor', [App\Http\Controllers\Staff\doctorController::class, 'create'])->name('doctor.create');

Route::get('/newStaff', [App\Http\Controllers\Admin\newStaffController::class, 'index'])->name('newstaff');
Route::post('/newStaff', [App\Http\Controllers\Admin\newStaffController::class, 'create'])->name('newstaff.create');

Route::get('/showpatients', [App\Http\Controllers\Admin\patientDetailsController::class, 'index'])->name('patientdetails');
Route::post('/showpatients', [App\Http\Controllers\Admin\patientDetailsController::class, 'search'])->name('patientdetails.search');

Route::get('/showdoctors', [App\Http\Controllers\Admin\doctorDetailsController::class, 'index'])->name('doctordetails');
Route::post('/showdoctors', [App\Http\Controllers\Admin\doctorDetailsController::class, 'search'])->name('doctordetails.search');

Route::get('/showappointments', [App\Http\Controllers\Admin\appointmentDetailsController::class, 'index'])->name('appointmentdetails');
Route::post('/showappointments', [App\Http\Controllers\Admin\appointmentDetailsController::class, 'search'])->name('appointmentdetails.search');

Route::get('/viewearnings', [App\Http\Controllers\Admin\viewEarningController::class, 'index'])->name('viewearnings');
Route::get('/viewearnings/overall', [App\Http\Controllers\Admin\viewEarningController::class, 'overall'])->name('viewearnings.overall');

Route::get('/staff/showPatients', [App\Http\Controllers\Staff\patientDetailsNewController::class, 'index'])->name('patientDetails');
Route::post('/staff/showPatients', [App\Http\Controllers\Staff\patientDetailsNewController::class, 'search'])->name('patientDetails.search');

Route::get('/staff/showDoctors', [App\Http\Controllers\Staff\doctorDetailsNewController::class, 'index'])->name('doctorDetails');
Route::post('/staff/showDoctors', [App\Http\Controllers\Staff\doctorDetailsNewController::class, 'search'])->name('doctorDetails.search');

Route::get('/staff/showAppointments', [App\Http\Controllers\Staff\appointmentDetailsNewController::class, 'index'])->name('appointmentDetails');
Route::post('/staff/showAppointments', [App\Http\Controllers\Staff\appointmentDetailsNewController::class, 'search'])->name('appointmentDetails.search');

Route::get('/viewMessages', [App\Http\Controllers\Staff\viewMessageController::class, 'index'])->name('viewmessages');
Route::post('/viewMessages', [App\Http\Controllers\Staff\viewMessageController::class, 'search'])->name('viewmessages.search');

Route::get('/viewMessages/allread', [App\Http\Controllers\Staff\viewMessageController::class, 'allread'])->name('allread');
Route::get('/viewMessages/allunread', [App\Http\Controllers\Staff\viewMessageController::class, 'allunread'])->name('allunread');

Route::get('/viewApplications', [App\Http\Controllers\Staff\viewApplicationController::class, 'index'])->name('viewapplications');
Route::post('/viewApplications', [App\Http\Controllers\Staff\viewApplicationController::class, 'search'])->name('viewapplications.search');

Route::get('/staffchat/{id}', [App\Http\Controllers\Staff\staffChatController::class, 'index']);
Route::get('/staffchat/{id}/clearall', [App\Http\Controllers\Staff\staffChatController::class, 'clearChat']);
Route::get('/staffchat/{id}/send', [App\Http\Controllers\Staff\staffChatController::class, 'send']);

Route::get('/viewApplications/allread', [App\Http\Controllers\Staff\viewApplicationController::class, 'allread'])->name('allreadApplications');
Route::get('/viewApplications/allunread', [App\Http\Controllers\Staff\viewApplicationController::class, 'allunread'])->name('allunreadApplications.search');

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

Route::get('/medicine', [App\Http\Controllers\Staff\medicineController::class, 'index'])->name('medicine.index');
Route::post('/medicine', [App\Http\Controllers\Staff\medicineController::class, 'update'])->name('medicine.update');
Route::get('/medicine/edit/{id}', [App\Http\Controllers\Staff\medicineEditController::class, 'index']);
Route::post('/medicine/edit/{id}', [App\Http\Controllers\Staff\medicineEditController::class, 'edit']);
Route::get('/medicine/delete/{id}', function ($id) {
    $medicine = App\Models\Medicine::find($id);
    $medicine->delete();
    return redirect('/medicine');
});

Route::get('/doctor/visitings', [App\Http\Controllers\Doctor\visitingController::class, 'index'])->name('doctor.visiting');
Route::post('/doctor/visitings', [App\Http\Controllers\Doctor\visitingController::class, 'update'])->name('doctor.visiting.update');
Route::get('/doctor/visitings/edit/{id}', [App\Http\Controllers\Doctor\visitingEditController::class, 'index'])->name('doctor.visiting.edit');
Route::post('/doctor/visitings/edit/{id}', [App\Http\Controllers\Doctor\visitingEditController::class, 'update'])->name('doctor.visiting.editpost');
Route::get('/doctor/visitings/delete/{id}', function ($id) {
    $visiting = App\Models\Visitings::where('id', $id)->get();
    $visiting[0]->delete();
    Session::flash('alert_1', 'Session removed. Need to attend same session until this month end!');
    return redirect('/doctor/visitings');
});

Route::get('/newappointment/{id}', [App\Http\Controllers\Home\appointmentController::class, 'index'])->name('appointment');
Route::post('/newappointment/{id}', [App\Http\Controllers\Home\appointmentController::class, 'update'])->name('appointment.update');
Route::get('/newappointment/{id}/{Id}/{type}', [App\Http\Controllers\Home\appointmentNextController::class, 'index'])->name('appointment.check');
Route::post('/newappointment/{id}/{Id}/{type}', [App\Http\Controllers\Home\appointmentNextController::class, 'check'])->name('appointment.validate');

Route::get('/payment', [App\Http\Controllers\Home\PaymentController::class, 'index'])->name('payment');
Route::post('/payment', [App\Http\Controllers\Home\PaymentController::class, 'pay']);

Route::get('/chat', [App\Http\Controllers\Home\ChatController::class, 'index']);
Route::get('/chat/clearall', [App\Http\Controllers\Home\ChatController::class, 'clearChat']);
Route::get('/send', [App\Http\Controllers\Home\ChatController::class, 'send']);

Route::get('/oldappointments/{id}', [App\Http\Controllers\Home\OldAppoController::class, 'index'])->name('old');
Route::post('/oldappointments/{id}', [App\Http\Controllers\Home\OldAppoController::class, 'index'])->name('old.post');

Route::get('/incomingappointments/{id}', [App\Http\Controllers\Home\IncomingAppoController::class, 'index'])->name('incoming');
Route::post('/incomingappointments/{id}', [App\Http\Controllers\Home\IncomingAppoController::class, 'index'])->name('incoming.post');
Route::get('/incomingappointments/{id}/{Id}', [App\Http\Controllers\Home\IncomingAppoController::class, 'check'])->name('incoming.check');
Route::get('/incomingappointments/join/{id}/{Id}', [App\Http\Controllers\Home\IncomingAppoController::class, 'join'])->name('incoming.join');

Route::get('/prescription/{id}/{Id}', [App\Http\Controllers\Home\PrescriptionController::class, 'index'])->name('prescription');
Route::post('/prescription/{id}/{Id}', [App\Http\Controllers\Home\PrescriptionController::class, 'download'])->name('prescription.download');

Route::get('/medical-certificate/{id}/{Id}', [App\Http\Controllers\Home\MedicalController::class, 'index'])->name('medical');
Route::post('/medical-certificate/{id}/{Id}', [App\Http\Controllers\Home\MedicalController::class, 'download'])->name('medical.download');

Route::get('/joinappointment/{id}/{Id}', [App\Http\Controllers\Home\MedicalController::class, 'index'])->name('joinappointment');
Route::post('/joinappointment/{id}/{Id}', [App\Http\Controllers\Home\MedicalController::class, 'join'])->name('joinappointment.join');

Route::get('/editDoctor/{id}', [App\Http\Controllers\Doctor\DoctorEditController::class, 'index']);
Route::post('/editDoctor/{id}', [App\Http\Controllers\Doctor\DoctorEditController::class, 'update']);

Route::get('/todaysession/{id}', [App\Http\Controllers\Doctor\TodaySessionController::class, 'index']);
Route::post('/todaysession/{id}', [App\Http\Controllers\Doctor\TodaySessionController::class, 'start']);

Route::get('/todaysession/{id}/{Id}', [App\Http\Controllers\Doctor\DiagnosisController::class, 'index']);
Route::post('/todaysession/{id}/{Id}', [App\Http\Controllers\Doctor\DiagnosisController::class, 'start']);

Route::get('/viewMyearnings', [App\Http\Controllers\Doctor\doctorViewEarningController::class, 'index'])->name('viewMyearnings');
Route::get('/viewMyearnings/overall', [App\Http\Controllers\Doctor\doctorViewEarningController::class, 'overall'])->name('viewMyearnings.overall');

Route::get('/show/doctor/appointments', [App\Http\Controllers\Doctor\doctorAppointmentController::class, 'index'])->name('doctorappointmentdetails');
Route::post('/show/doctor/appointments', [App\Http\Controllers\Doctor\doctorAppointmentController::class, 'search'])->name('doctorappointmentdetails.search');

Route::get('/staff/newappointment', [App\Http\Controllers\Staff\staffAppointmentController::class, 'index'])->name('staffappointment');
Route::post('/staff/newappointment', [App\Http\Controllers\Staff\staffAppointmentController::class, 'update'])->name('staffappointment.update');
Route::get('/staff/newappointment/{id}/{Id}/{type}', [App\Http\Controllers\Staff\staffAppointmentNextController::class, 'index'])->name('staffappointment.check');
Route::post('/staff/newappointment/{id}/{Id}/{type}', [App\Http\Controllers\Staff\staffAppointmentNextController::class, 'check'])->name('staffappointment.validate');