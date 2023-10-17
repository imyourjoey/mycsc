<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use Egulias\EmailValidator\Parser\Comment;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VerifyEmailController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminInquiryController;
use App\Http\Controllers\Admin\AdminInvoiceController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Client\ClientOrderController;
use App\Http\Controllers\Admin\AdminFeedbackController;
use App\Http\Controllers\Admin\AdminTrainingController;
use App\Http\Controllers\Client\ClientInquiryController;
use App\Http\Controllers\Client\ClientInvoiceController;
use App\Http\Controllers\Technician\TechOrderController;
use App\Http\Controllers\Client\ClientFeedbackController;
use App\Http\Controllers\Admin\AdminAppointmentController;
use App\Http\Controllers\Technician\TechServiceController;
use App\Http\Controllers\Admin\AdminAnnouncementController;
use App\Http\Controllers\Client\ClientEnrollmentController;
use App\Http\Controllers\Client\ClientAppointmentController;

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





Route::get('', [LandingController::class,'showLandingPage'])->name('landing');

//show my profile
Route::get('/profile/edit', [ProfileController::class,'edit'])->name('profile.edit');
Route::post('/{user}/profile/update', [ProfileController::class,'update'])->name('profile.update');

//show change password page
Route::get('/password/edit', [PasswordController::class,'edit'])->name('password.edit');
Route::post('/{user}/password/update', [PasswordController::class,'update'])->name('password.update');



Route::post('/mark-notifications-as-read', [NotificationController::class,'markAsRead'])->name('mark-notifications-as-read');



//Guest routes
Route::post('/submit-guest-inquiry', [GuestController::class,'submitGuestInquiry'])->name('submitGuestInquiry');






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
    Route::get('index', [DashboardController::class, 'showAdminDash'])->name('admin.index');

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

Route::middleware(['auth', 'role:client'])->prefix('client')->group(function () {
    Route::get('index', [DashboardController::class, 'showClientDash'])->name('client.index');

    //Appointments
    Route::prefix('appointments')->name('client.appointment.')->group(function () {
        Route::get('', [ClientAppointmentController::class, 'index'])->name('index');
        Route::get('show/{id}', [ClientAppointmentController::class, 'show'])->name('show');
        Route::get('create', [ClientAppointmentController::class, 'create'])->name('create');
        Route::post('store', [ClientAppointmentController::class, 'store'])->name('store'); 
        Route::get('{appointment}/edit', [ClientAppointmentController::class, 'edit'])->name('edit');
        Route::put('{appointment}/update', [ClientAppointmentController::class, 'update'])->name('update');
        Route::delete('destroy', [ClientAppointmentController::class, 'destroy'])->name('destroy');
    });


    //Order
    Route::prefix('orders')->name('client.order.')->group(function () {
        Route::get('', [ClientOrderController::class, 'index'])->name('index');
        Route::get('create',[ClientOrderController::class, 'create'])->name('create');
        Route::post('store', [ClientOrderController::class, 'store'])->name('store');
        Route::get('{order}/edit', [ClientOrderController::class, 'edit'])->name('edit');
        Route::post('{order}/update', [ClientOrderController::class, 'update'])->name('update');
        Route::delete('destroy', [ClientOrderController::class, 'destroy'])->name('destroy');
    
    });


    //Invoice
    Route::prefix('invoices')->name('client.invoice.')->group(function () {
        Route::get('{invoice}/showInvoice',[ClientInvoiceController::class, 'showInvoice'])->name('showInvoice');
        Route::get('{invoice}/showReceipt',[ClientInvoiceController::class, 'showReceipt'])->name('showReceipt');
        Route::get('', [ClientInvoiceController::class, 'index'])->name('index');
        Route::get('create', [ClientInvoiceController::class, 'create'])->name('create');
        Route::post('store', [ClientInvoiceController::class, 'store'])->name('store'); 
        Route::get('{invoice}/edit', [ClientInvoiceController::class, 'edit'])->name('edit');
        Route::put('{invoice}/update', [ClientInvoiceController::class, 'update'])->name('update');
        Route::delete('destroy', [ClientInvoiceController::class, 'destroy'])->name('destroy');
        
    });



    //Training
    Route::prefix('enrollments')->name('client.enrollment.')->group(function () {
        Route::get('', [ClientEnrollmentController::class, 'index'])->name('index');
        Route::get('create', [ClientEnrollmentController::class, 'create'])->name('create');
        Route::post('store', [ClientEnrollmentController::class, 'store'])->name('store'); 
        Route::get('{training}/edit', [ClientEnrollmentController::class, 'edit'])->name('edit');
        Route::put('{training}/update', [ClientEnrollmentController::class, 'update'])->name('update');
        Route::delete('destroy', [ClientEnrollmentController::class, 'destroy'])->name('destroy');
    });


    //Inquiry
    Route::prefix('inquiries')->name('client.inquiry.')->group(function () {
        Route::get('', [ClientInquiryController::class, 'index'])->name('index');
        Route::get('create', [ClientInquiryController::class, 'create'])->name('create');
        Route::post('store', [ClientInquiryController::class, 'store'])->name('store'); 
        Route::get('{inquiry}/edit', [ClientInquiryController::class, 'edit'])->name('edit');
        Route::put('{inquiry}/update', [ClientInquiryController::class, 'update'])->name('update');
        Route::delete('destroy', [ClientInquiryController::class, 'destroy'])->name('destroy');
    });


    //Feedback
    Route::prefix('feedbacks')->name('client.feedback.')->group(function () {
        Route::get('', [ClientFeedbackController::class, 'index'])->name('index');
        Route::get('create',[ClientFeedbackController::class, 'create'])->name('create');
        Route::post('store', [ClientFeedbackController::class, 'store'])->name('store'); 
        Route::get('{feedback}/edit', [ClientFeedbackController::class, 'edit'])->name('edit');
        Route::post('{feedback}/update', [ClientFeedbackController::class, 'update'])->name('update');
        Route::delete('destroy', [ClientFeedbackController::class, 'destroy'])->name('destroy');
    });

});

Route::middleware(['auth', 'role:technician'])->prefix('technician')->group(function () {
    Route::get('index', [DashboardController::class, 'showTechnicianDash'])->name('technician.index');

    //Order
    Route::prefix('orders')->name('technician.order.')->group(function () {
        Route::get('', [TechOrderController::class, 'index'])->name('index');
        Route::get('create',[TechOrderController::class, 'create'])->name('create');
        Route::post('store', [TechOrderController::class, 'store'])->name('store');
        Route::get('{order}/edit', [TechOrderController::class, 'edit'])->name('edit');
        Route::post('{order}/update', [TechOrderController::class, 'update'])->name('update');
        Route::delete('destroy', [TechOrderController::class, 'destroy'])->name('destroy');
    
    });

    //service
    Route::prefix('services')->name('technician.service.')->group(function () {
        Route::get('', [TechServiceController::class, 'index'])->name('index');
        Route::get('create',[TechServiceController::class, 'create'])->name('create');
        Route::post('store', [TechServiceController::class, 'store'])->name('store');
        Route::get('{service}/edit', [TechServiceController::class, 'edit'])->name('edit');
        Route::post('{service}/update', [TechServiceController::class, 'update'])->name('update');
        Route::delete('destroy', [TechServiceController::class, 'destroy'])->name('destroy');
    
        });






});