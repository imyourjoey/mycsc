<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LogoutController;
use Egulias\EmailValidator\Parser\Comment;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AnnouncementController;

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
    Route::prefix('orders')->name('order.')->group(function () {
        Route::get('', [OrderController::class, 'index'])->name('index');
        Route::get('create',[OrderController::class, 'create'])->name('create');
        Route::post('store', [OrderController::class, 'store'])->name('store');
        Route::get('{order}/edit', [OrderController::class, 'edit'])->name('edit');
        Route::post('{order}/update', [OrderController::class, 'update'])->name('update');
        Route::delete('destroy', [OrderController::class, 'destroy'])->name('destroy');
    
    });

    //Invoice
    Route::prefix('invoices')->name('invoice.')->group(function () {
        Route::get('', [InvoiceController::class, 'index'])->name('index');
        Route::get('create', [InvoiceController::class, 'create'])->name('create');
        Route::post('store', [InvoiceController::class, 'store'])->name('store'); 
        Route::get('{invoice}/edit', [InvoiceController::class, 'edit'])->name('edit');
        Route::post('{invoice}/update', [InvoiceController::class, 'update'])->name('update');
        Route::delete('destroy', [InvoiceController::class, 'destroy'])->name('destroy');
    });
    
    //Feedback
    Route::prefix('feedbacks')->name('feedback.')->group(function () {
        Route::get('', [FeedbackController::class, 'index'])->name('index');
        Route::get('create',[FeedbackController::class, 'create'])->name('create');
        Route::post('store', [FeedbackController::class, 'store'])->name('store'); 
        Route::get('{feedback}/edit', [FeedbackController::class, 'edit'])->name('edit');
        Route::post('{feedback}/update', [FeedbackController::class, 'update'])->name('update');
        Route::delete('destroy', [FeedbackController::class, 'destroy'])->name('destroy');
    });
    //Inquiry
    Route::prefix('inquiries')->name('inquiry.')->group(function () {
        Route::get('', [InquiryController::class, 'index'])->name('index');
        Route::get('create', [InquiryController::class, 'create'])->name('create');
        Route::post('store', [InquiryController::class, 'store'])->name('store'); 
        Route::get('{inquiry}/edit', [InquiryController::class, 'edit'])->name('edit');
        Route::put('{inquiry}/update', [InquiryController::class, 'update'])->name('update');
        Route::delete('destroy', [InquiryController::class, 'destroy'])->name('destroy');
    });
    

    //Training
    Route::prefix('trainings')->name('training.')->group(function () {
        Route::get('', [TrainingController::class, 'index'])->name('index');
        Route::get('create', [TrainingController::class, 'create'])->name('create');
        Route::post('store', [TrainingController::class, 'store'])->name('store'); 
        Route::get('{training}/edit', [TrainingController::class, 'edit'])->name('edit');
        Route::put('{training}/update', [TrainingController::class, 'update'])->name('update');
        Route::delete('destroy', [TrainingController::class, 'destroy'])->name('destroy');
    });
    
    //News
    Route::prefix('announcements')->name('announcement.')->group(function () {
        Route::get('', [AnnouncementController::class, 'index'])->name('index');
        Route::get('create', [AnnouncementController::class, 'create'])->name('create');
        Route::post('store', [AnnouncementController::class, 'store'])->name('store'); 
        Route::get('{announcement}/edit', [AnnouncementController::class, 'edit'])->name('edit');
        Route::put('{announcement}/update', [AnnouncementController::class, 'update'])->name('update');
        Route::delete('destroy', [AnnouncementController::class, 'destroy'])->name('destroy');
    });
    

    

});

Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/clients/index', [ClientController::class, 'index'])->name('client.index');
});

Route::middleware(['auth', 'role:technician'])->group(function () {
    Route::get('/technicians/index', [TechnicianController::class, 'index'])->name('technician.index');
});