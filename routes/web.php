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
    //dashboard
    Route::get('/admins/index', [AdminController::class, 'index'])->name('admin.index');


    //User
    Route::prefix('users')->name('user.')->group(function () {
    Route::get('',[UserController::class,'index'])->name('index');
    Route::get('create', [UserController::class, 'create'])->name('create');
    Route::post('store', [UserController::class, 'store'])->name('store');
    Route::get('{user}/edit',[UserController::class,'edit'])->name('edit');
    Route::post('{user}/update', [UserController::class, 'update'])->name('update');
    Route::delete('destroy', [UserController::class, 'destroy'])->name('destroy');
    });
    
    //service
    Route::prefix('services')->name('service.')->group(function () {
    Route::get('', [ServiceController::class, 'index'])->name('index');
    Route::get('create',[ServiceController::class, 'create'])->name('create');
    Route::post('store', [ServiceController::class, 'store'])->name('store');
    Route::get('{service}/edit', [ServiceController::class, 'edit'])->name('edit');
    Route::post('{service}/update', [ServiceController::class, 'update'])->name('update');
    Route::delete('destroy', [ServiceController::class, 'destroy'])->name('destroy');

    });
    

    //Order
    Route::get('/orders/create',[OrderController::class, 'create'])->name('order.create');

    //Invoice
    Route::get('/invoices/create',[InvoiceController::class, 'create'])->name('invoice.create');

    //Feedback
    Route::get('/feedbacks/create',[FeedbackController::class, 'create'])->name('feedback.create');

    //Inquiry
    Route::get('/inquiries/create',[InquiryController::class, 'create'])->name('inquiry.create');

    //Training
    Route::get('/trainings/create',[TrainingController::class, 'create'])->name('training.create');

    //News
    Route::get('/announcements/create',[AnnouncementController::class, 'create'])->name('announcement.create');

    

});

Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/clients/index', [ClientController::class, 'index'])->name('client.index');
});

Route::middleware(['auth', 'role:technician'])->group(function () {
    Route::get('/technicians/index', [TechnicianController::class, 'index'])->name('technician.index');
});