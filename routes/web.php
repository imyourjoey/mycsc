<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use Egulias\EmailValidator\Parser\Comment;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VerifyEmailController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminInquiryController;
use App\Http\Controllers\Admin\AdminInvoiceController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Admin\AdminFeedbackController;
use App\Http\Controllers\Admin\AdminTrainingController;
use App\Http\Controllers\Admin\AdminAppointmentController;
use App\Http\Controllers\Admin\AdminAnnouncementController;

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


Route::delete('/hello/destroy', [CalendarController::class, 'destroy'])->name('calendar.destroy');




Route::get('/kkkk', function () {
    return view('invoice.create');
})->name('kkkk');




Route::get('/', function () {
    return view('landing');
})->name('landing');

// Route::get('appointment/create', [CalendarController::class,'create'])->name('appointment.create');


// Route::get('/hello', function () {
//     return view('hello');
// });

Route::get('/login', [LoginController::class,'showLoginForm'])->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

//verify email routes
Route::get('verifyemail', [VerifyEmailController::class, 'showVerify'])->name('showVerify');
Route::post('{user}/verifyemail',  [VerifyEmailController::class, 'verifyEmail'])->name('verifyEmail');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    //dashboard
    Route::get('dash', [DashboardController::class, 'showAdminDash'])->name('admin.index');

    //User
    Route::prefix('users')->name('admin.user.')->group(function () {
    Route::get('',[AdminUserController::class,'index'])->name('index');
    Route::get('create', [AdminUserController::class, 'create'])->name('create');
    Route::post('store', [AdminUserController::class, 'store'])->name('store');
    Route::get('{user}/edit',[AdminUserController::class,'edit'])->name('edit');
    Route::post('{user}/update', [AdminUserController::class, 'update'])->name('update');
    Route::delete('destroy', [AdminUserController::class, 'destroy'])->name('destroy');
    });
    
    //service
    Route::prefix('services')->name('admin.service.')->group(function () {
    Route::get('', [AdminServiceController::class, 'index'])->name('index');
    Route::get('create',[AdminServiceController::class, 'create'])->name('create');
    Route::post('store', [AdminServiceController::class, 'store'])->name('store');
    Route::get('{service}/edit', [AdminServiceController::class, 'edit'])->name('edit');
    Route::post('{service}/update', [AdminServiceController::class, 'update'])->name('update');
    Route::delete('destroy', [AdminServiceController::class, 'destroy'])->name('destroy');

    });
    

    //Order
    Route::prefix('orders')->name('admin.order.')->group(function () {
        Route::get('', [AdminOrderController::class, 'index'])->name('index');
        Route::get('create',[AdminOrderController::class, 'create'])->name('create');
        Route::post('store', [AdminOrderController::class, 'store'])->name('store');
        Route::get('{order}/edit', [AdminOrderController::class, 'edit'])->name('edit');
        Route::post('{order}/update', [AdminOrderController::class, 'update'])->name('update');
        Route::delete('destroy', [AdminOrderController::class, 'destroy'])->name('destroy');
    
    });

    //Invoice
    Route::prefix('invoices')->name('admin.invoice.')->group(function () {
        Route::get('{invoice}/showInvoice',[AdminInvoiceController::class, 'showInvoice'])->name('showInvoice');
        Route::get('{invoice}/showReceipt',[AdminInvoiceController::class, 'showReceipt'])->name('showReceipt');
        Route::get('', [AdminInvoiceController::class, 'index'])->name('index');
        Route::get('create', [AdminInvoiceController::class, 'create'])->name('create');
        Route::post('store', [AdminInvoiceController::class, 'store'])->name('store'); 
        Route::get('{invoice}/edit', [AdminInvoiceController::class, 'edit'])->name('edit');
        Route::put('{invoice}/update', [AdminInvoiceController::class, 'update'])->name('update');
        Route::delete('destroy', [AdminInvoiceController::class, 'destroy'])->name('destroy');
        
    });
    
    //Feedback
    Route::prefix('feedbacks')->name('admin.feedback.')->group(function () {
        Route::get('', [AdminFeedbackController::class, 'index'])->name('index');
        Route::get('create',[AdminFeedbackController::class, 'create'])->name('create');
        Route::post('store', [AdminFeedbackController::class, 'store'])->name('store'); 
        Route::get('{feedback}/edit', [AdminFeedbackController::class, 'edit'])->name('edit');
        Route::post('{feedback}/update', [AdminFeedbackController::class, 'update'])->name('update');
        Route::delete('destroy', [AdminFeedbackController::class, 'destroy'])->name('destroy');
    });
    //Inquiry
    Route::prefix('inquiries')->name('admin.inquiry.')->group(function () {
        Route::get('', [AdminInquiryController::class, 'index'])->name('index');
        Route::get('create', [AdminInquiryController::class, 'create'])->name('create');
        Route::post('store', [AdminInquiryController::class, 'store'])->name('store'); 
        Route::get('{inquiry}/edit', [AdminInquiryController::class, 'edit'])->name('edit');
        Route::put('{inquiry}/update', [AdminInquiryController::class, 'update'])->name('update');
        Route::delete('destroy', [AdminInquiryController::class, 'destroy'])->name('destroy');
    });


    //Appointment
    Route::prefix('appointments')->name('admin.appointment.')->group(function () {
        Route::get('', [AdminAppointmentController::class, 'index'])->name('index');
        Route::get('show/{id}', [AdminAppointmentController::class, 'show'])->name('show');
        Route::get('create', [AdminAppointmentController::class, 'create'])->name('create');
        Route::post('store', [AdminAppointmentController::class, 'store'])->name('store'); 
        Route::get('{appointment}/edit', [AdminAppointmentController::class, 'edit'])->name('edit');
        Route::put('{appointment}/update', [AdminAppointmentController::class, 'update'])->name('update');
        Route::delete('destroy', [AdminAppointmentController::class, 'destroy'])->name('destroy');
    });



    
    

    //Training
    Route::prefix('trainings')->name('admin.training.')->group(function () {
        Route::get('', [AdminTrainingController::class, 'index'])->name('index');
        Route::get('create', [AdminTrainingController::class, 'create'])->name('create');
        Route::post('store', [AdminTrainingController::class, 'store'])->name('store'); 
        Route::get('{training}/edit', [AdminTrainingController::class, 'edit'])->name('edit');
        Route::put('{training}/update', [AdminTrainingController::class, 'update'])->name('update');
        Route::delete('destroy', [AdminTrainingController::class, 'destroy'])->name('destroy');
    });
    
    //News
    Route::prefix('announcements')->name('admin.announcement.')->group(function () {
        Route::get('', [AdminAnnouncementController::class, 'index'])->name('index');
        Route::get('create', [AdminAnnouncementController::class, 'create'])->name('create');
        Route::post('store', [AdminAnnouncementController::class, 'store'])->name('store'); 
        Route::get('{announcement}/edit', [AdminAnnouncementController::class, 'edit'])->name('edit');
        Route::put('{announcement}/update', [AdminAnnouncementController::class, 'update'])->name('update');
        Route::delete('destroy', [AdminAnnouncementController::class, 'destroy'])->name('destroy');
    });
    

    

});

Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/clients/index', [DashboardController::class, 'showClientDash'])->name('client.index');
});

Route::middleware(['auth', 'role:technician'])->group(function () {
    Route::get('/technicians/index', [DashboardController::class, 'showTechnicianDash'])->name('technician.index');
});