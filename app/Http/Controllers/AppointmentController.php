<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{

    public function create(Request $request){
        
        $selectedDate = $request->input('date');
        $clients = DB::table('users')->where('role','client')->get();

      
        return view('appointment.create', ['clients' => $clients, 'selectedDate'=> $selectedDate]);

    }
    public function index()
    {
        $events = array();
        $appointments = DB::table('appointment')->get();
        // $trainings = DB::table('training')->get();
        $clients = DB::table('users')->where('role','client')->get();


        foreach($appointments as $appointment){

            $client = DB::table('users')->where('userTag', $appointment->userTag)->first();
            
            $dateTimeFormat = "Y-m-d H:i:s";
            $appointmentEndTime = strtotime($appointment->appointmentDateTime)+3600;
            $appointmentEndTime = date($dateTimeFormat, $appointmentEndTime);
            
            $events[] = [
                'id'   => $appointment->appointmentID,
                'title' => 'Appointment with: '.$client->name,
                'start' => $appointment->appointmentDateTime,
                'end' => $appointmentEndTime
            ];

           
            
            
            
        }
        
        // foreach($trainings as $training) {
            
        //     $events[] = [
        //         'id'   => $training->trainingID,
        //         'title' => $training->trainingTitle,
        //         'start' => $training->startDateTime,
        //         'end' => $training->endDateTime
        //     ];
        // }
        
        return view('appointment.index', ['events' => $events, 'clients' => $clients]);
}

    // public function create(Request $request){


    //     //determine next appointmentID
    //     if (Appointment::count() > 0) {
    //         // Retrieve the last appointment record
    //         $lastAppointment = Appointment::latest()->first();
    
    //         // Extract the last appointment ID (e.g., 'AP001' -> 1)
    //         $lastAppointmentId = intval(substr($lastAppointment->appointmentID, 2));
    
    //         // Increment the last appointment ID
    //         $newAppointmentId = $lastAppointmentId + 1;
    
    //         // Format the new appointment ID as 'APxxx' (e.g., 'AP001')
    //         $formattedAppointmentId = 'AP' . str_pad($newAppointmentId, 3, '0', STR_PAD_LEFT);
    //     } else {
    //         // If the 'appointments' table is empty, start with 'AP001'
    //         $formattedAppointmentId = 'AP001';
    //     }


    //     //find client with same name with request
    //     $client = DB::table('users')->where('name', $request->input('clientName'))->first();

    //     if (!$client) {
    //     // If the client doesn't exist, you can handle the error here
    //     return response()->json(['error' => 'Client not found'], 404);
    //     }



    //    $newAppointment = new Appointment();
    //    $newAppointment->appointmentID = $formattedAppointmentId;
    //    $newAppointment->userTag = $client->userTag;
    //    $newAppointment->appointmentDateTime = $request->appointmentDateTime;
    //    $newAppointment->appointmentStatus = 'Approved';
    // //    $newAppointment->remarks = null;
    
    //    $newAppointment->save();

    //    $responseData = [
    //     'newAppointment' => $newAppointment,
    //     'clientName' => $client->name,
    //    ];

    //    return response()->json($responseData);


        
    // }
}
