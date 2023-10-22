<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Inquiry;
use App\Models\Invoice;
use App\Models\Feedback;
use App\Models\Training;
use App\Models\Enrollment;
use App\Models\Appointment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showClientDash(){
        return view('client.dashboard');
    }

    public function showAdminDash(){

        //count inquiries received today
        $today = now()->startOfDay();
        $inquiryCount = Inquiry::whereDate('created_at', $today)->count();



        //count approved appointment scheduled for today
        $scheduledAppointmentCount = Appointment::where('appointmentStatus', 'approved')
            ->whereDate('appointmentDateTime', $today)
            ->count();



        //count appointment requested today
        $requestedAppointmentCount = Appointment::whereDate('created_at', $today)->count();

        //count unapproved appointments
        $unapprovedAppointmentCount = Appointment::where('appointmentStatus', 'pending')->count();

        //count training scheduled today
        $scheduledTrainingCount = Training::whereDate('startDateTime', $today)->count();

        //count enrollments received today
        $enrollmentCount = Enrollment::whereDate('created_at', $today)->count();

        //count unapproved enrollments
        $unapprovedEnrollmentCount = Enrollment::where('enrollStatus', 'Pending')->count();

        //count feedback reeived today
        $feedbackCount = Feedback::whereDate('created_at', $today)->count();


        //count revenue month to date
        $startOfMonth = Carbon::now()->startOfMonth();
        $todayDate = Carbon::now();

        $totalPaymentAmount = Invoice::whereBetween('created_at', [$startOfMonth, $todayDate])
        ->sum('paymentAmount');

        //count revenue today
        $totalPaymentAmountToday = Invoice::whereDate('created_at', $today->toDateString())
            ->sum('paymentAmount');
        

        return view('admin.dashboard',['inquiryCount'=>$inquiryCount, 'scheduledAppointmentCount' => $scheduledAppointmentCount,
        'requestedAppointmentCount' => $requestedAppointmentCount, 'unapprovedAppointmentCount' => $unapprovedAppointmentCount,
        'scheduledTrainingCount' => $scheduledTrainingCount,
        'enrollmentCount' => $enrollmentCount,
        'unapprovedEnrollmentCount' => $unapprovedEnrollmentCount,
        'feedbackCount' => $feedbackCount,
        'totalPaymentAmount' => $totalPaymentAmount,
        'totalPaymentAmountToday' =>$totalPaymentAmountToday]);
    }

    public function showTechnicianDash(){
        return view('technician.dashboard');
    }


}
