<?php

use App\Models\Inquiry;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\TechnicianController;

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
    return view('landing');
});

Route::get('/adminlogin', function () {
    return view('adminlogin');
});


Route::get('/admindash', function () {
    return view('admindash');
});


Route::get('/inquiryupdate', function(){
    return view('inquiryupdate');
});

//Show Login/Register Form
Route::get('/admincreateuser',[AdminController::class, 'create']);

//Create New User
Route::post('/admin', [AdminController::class, 'store']);

//Create New Client
Route::post('/client', [ClientController::class, 'store']);

//Create New Client
Route::post('/technician', [TechnicianController::class, 'store']);

//create new inquiry
Route::post('/inquiry', [InquiryController::class, 'store']);


//show inquiries datatable
Route::get('/inquirydatatable',[InquiryController::class, 'showDataTable']);


//delete inquiry
Route::delete('/inquiry/{inquiry}',[InquiryController::class, 'destroy']);


