<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    public function store(Request $request)
{
    $request->validate([
        'clientName' => 'required',
        'datetime' => 'required|date_format:Y-m-d H:i',
        'remarks' => 'nullable',
    ]);
    

    $dateTimeFormat = "Y-m-d H:i:s";
    $appointmentDateTime = strtotime($request->datetime);
    $appointmentDateTime = date($dateTimeFormat, $appointmentDateTime);

    // dd($appointmentDateTime);
    $clientTag = AppointmentController::getUserTagByName($request->clientName);

    $client = User::where('userTag', $clientTag)->first();
    $clientPhone = $client->phoneNo;
    $clientEmail = $client->email;

    $appointment = new Appointment();
    $appointment->appointmentID = AppointmentController::generateUniqueAppointmentID();
    $appointment->appointmentName = $request->clientName;
    $appointment->userTag = $clientTag;
    $appointment->appointmentContact = $clientPhone; 
    $appointment->appointmentEmail = $clientEmail;   
    $appointment->appointmentDateTime = $appointmentDateTime;
    $appointment->appointmentStatus = 'Approved';
    $appointment->remarks = $request->remarks;
    $appointment->save();

    return redirect()->back()->with('message', 'Appointment created successfully!');
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


public function getUserTagByName($name)
{
    $user = User::where('name', $name)->first();

    if ($user) {
        $userTag = $user->userTag; 
        return $userTag;
    } 
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
