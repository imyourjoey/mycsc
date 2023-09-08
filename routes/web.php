<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LogoutController;
use Egulias\EmailValidator\Parser\Comment;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\TechnicianController;
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
Route::get('/hello', [CalendarController::class, 'index'])->name('calendar.index');


Route::get('/kkkk', function () {
    return view('invoice.create');
})->name('kkkk');




Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::post('appointment/create', [AppointmentController::class,'create'])->name('appointment.create');


// Route::get('/hello', function () {
//     return view('hello');
// });

Route::get('/login', [LoginController::class,'showLoginForm'])->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/index', [AdminController::class, 'index'])->name('admin.index');


    //User
    Route::get('/user/create', [UserController::class, 'showCreate'])->name('user.show-create');
    Route::get('/user/update/{id}',[UserController::class,'showUpdate'])->name('user.show-update');

    Route::post('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/update/{id}', [UserController::class, 'update'])->name('user.update');

    Route::get('/user',[UserController::class,'index'])->name('user.index');
    Route::post('/user/delete', [UserController::class, 'destroy'])->name('user.destroy');


    //Service
    Route::get('/service/create',[ServiceController::class, 'create'])->name('service.create');
    Route::post('/service/store', [ServiceController::class, 'store'])->name('service.store');

    //Order
    Route::get('/order/create',[OrderController::class, 'create'])->name('order.create');

    //Invoice
    Route::get('/invoice/create',[InvoiceController::class, 'create'])->name('invoice.create');

    //Feedback
    Route::get('/feedback/create',[FeedbackController::class, 'create'])->name('feedback.create');

    //Inquiry
    Route::get('/inquiry/create',[InquiryController::class, 'create'])->name('inquiry.create');

    //Training
    Route::get('/training/create',[TrainingController::class, 'create'])->name('training.create');

    //News
    Route::get('/announcement/create',[AnnouncementController::class, 'create'])->name('announcement.create');

    

});

Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/client/index', [ClientController::class, 'index'])->name('client.index');
});

Route::middleware(['auth', 'role:technician'])->group(function () {
    Route::get('/technician/index', [TechnicianController::class, 'index'])->name('technician.index');
});