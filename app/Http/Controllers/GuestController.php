<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Inquiry;
use App\Models\Training;
use App\Models\Enrollment;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Notifications\inquirySent;
use Illuminate\Support\Facades\DB;
use App\Notifications\AppointmentRequested;
use Illuminate\Auth\Events\Validated;

class GuestController extends Controller
{
    public function submitGuestInquiry(Request $request)
    {
        $request->validate([
            'inquiryMessage' => 'required|string',
            'inquiryName' => 'required|string',
            'inquiryContactEmail' => 'required|email'
        ]);

        $inquiry = new Inquiry();

        // Update properties using the $inquiry variable
        $inquiry->inquiryID = self::generateUniqueInquiryID();
        $inquiry->userTag = null;
        $inquiry->inquiryName = $request->inquiryName; 
        $inquiry->inquiryMessage = $request->inquiryMessage;
        $inquiry->inquiryContactEmail = $request->inquiryContactEmail; 

        $inquiry->save();



        //notify admins
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            $admin->notify(new inquirySent($inquiry));
        }

        return redirect()->back()->with('message', 'Inquiry created successfully!');
    }


    public function showGuestEnrollment($trainingID){

        $training = Training::find($trainingID);
        return view('guest.enrollment.create',['training' => $training]);
    }


    public function submitGuestEnrollment(Request $request){
            // Count the number of enrollments for this training

            $enrollmentsCount = Enrollment::where('trainingID', $request->input('trainingID'))->count();
            $trainingCapacity = Training::where('trainingID', $request->input('trainingID'))->value('trainingCapacity');
            
            if ($enrollmentsCount >= $trainingCapacity) {
                        // The training is at maximum capacity
                        return redirect()->back()->with('error', 'This training is already at its maximum capacity.');
            }
        $existingEnrollment = Enrollment::where('applicantContact', $request->input('phoneNo'))
        ->where('trainingID', $request->input('trainingID'))
        ->first();

        if ($existingEnrollment) {
        // The user has already enrolled in this training
        return redirect()->back()->with('error', 'You have already enrolled in this training using this phone number.');
        }

        $request->validate([
        'name' => 'required|string',
        'email' => 'email|string',
        'phoneNo' => 'required'
        ]);

        $enrollment = new Enrollment();
        $enrollment->enrollmentID = GuestController::generateUniqueEnrollmentID(); // You can generate a unique enrollment ID as per your requirement
        $enrollment->userTag = null; // Assuming you're using user authentication
        $enrollment->trainingID = $request->input('trainingID'); 
        $enrollment->applicantName = $request->input('name');
        $enrollment->applicantEmail = $request->input('email');
        $enrollment->applicantContact = $request->input('phoneNo');
        $enrollment->enrollStatus = 'Approved'; // Set the initial status
        
        $enrollment->save();
        

        return redirect()->back()->with('message', 'Training Enrolled Successfully');


    }


    public function showGuestAppointmentForm(){
        return view('guest.appointment.create');
    }

    public function submitGuestAppointmentForm(Request $request)
    {
    

    // Validate the request data here if needed
        $request->validate([
            'datetime' => 'required|date_format:Y-m-d H:i',
            'name' =>'required|string',
            'phoneNo' => 'required',
            'email' => 'required|email'
        ]);
        // Create a new appointment
        
        $appointment = new Appointment();
        $appointment->appointmentID = GuestController::generateUniqueAppointmentID();
        $appointment->appointmentName = $request->name;
        $appointment->userTag = null;
        $appointment->appointmentContact = $request->phoneNo;
        $appointment->appointmentEmail = $request->email;
        $appointment->appointmentDateTime = $request->datetime;
        $appointment->appointmentStatus = 'pending';
        $appointment->remarks = null;
        $appointment->save();

        $admins = User::where('role', 'admin')->get();
            
        foreach ($admins as $admin) {
                $admin->notify(new AppointmentRequested($appointment));
        }

        return redirect()->back()->with('message','Appointment Request Successfully Submitted!');
        

    }


    public function showGuestAppointment(Request $request){


        if (!$request->ajax()){
            $request->validate([
                'guestEmail' => 'required|email'
            ]);
        }
        
        $guestEmail = $request->input('guestEmail');

        if ($request->ajax()) {

            $clientAppointments = DB::table('appointment')
                ->select([
                    'appointment.appointmentID',
                    'appointment.appointmentDateTime',
                    'appointment.appointmentStatus',
                    'appointment.remarks',
                    'appointment.created_at',
                    'appointment.updated_at'
                ])
                ->where('appointment.userTag', '=', $guestEmail )
                ->get();

            return DataTables::of($clientAppointments)->toJson();
        }

        return view('guest.appointment.show', ['email' => $guestEmail]);
    }




    public function generateUniqueInquiryID()
    {
    $prefix = 'IN';

    if ($prefix) {
        $unique = false;
        $count = 1;

        while (!$unique) {
            $inquiryID = $prefix . str_pad($count, 3, '0', STR_PAD_LEFT);

            if (!Inquiry::where('inquiryID', $inquiryID)->exists()) {
                $unique = true;
            }

            $count++;
        }

        return $inquiryID;
    }

    return '';
    } 


    public function generateUniqueEnrollmentID()
    {
        $prefix = 'EN';
    
        if ($prefix) {
        $unique = false;
        $count = 1;
        
        while (!$unique) {
            $enrollmentID = $prefix . str_pad($count, 3, '0', STR_PAD_LEFT);
            
            if (!Enrollment::where('enrollmentID', $enrollmentID)->exists()) {
                $unique = true;
            }
            
            $count++;
        }

        return $enrollmentID;
        }

        return '';
    }






    public function generateUniqueAppointmentID()
    {
        $prefix = 'AP';
    
        if ($prefix) {
        $unique = false;
        $count = 1;
        
        while (!$unique) {
            $appointmentID = $prefix . str_pad($count, 3, '0', STR_PAD_LEFT);
            
            if (!Appointment::where('appointmentID', $appointmentID)->exists()) {
                $unique = true;
            }
            
            $count++;
        }

        return $appointmentID;
        }

        return '';
    }


}
