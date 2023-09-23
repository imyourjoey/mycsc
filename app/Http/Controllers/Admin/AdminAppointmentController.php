<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class AdminAppointmentController extends Controller
{
    public function show(Request $request)
    {
        $appointmentId = $request->input('id');
        $appointment = DB::table('appointment')->where('appointmentID', $appointmentId)->first();
    
        if (!$appointment) {
            return response()->json(['error' => 'Appointment not found'], 404);
        }
    
        $responseData = [
            'clientName' => $appointment->appointmentName,
            'dateTime' => $appointment->appointmentDateTime,
            'remarks' => $appointment->remarks,
            'status' => $appointment->appointmentStatus,
        ];
    
        return response()->json($responseData);
    }
    

    public function create(Request $request){
        
        $selectedDate = $request->input('date');
        $clients = DB::table('users')->where('role','client')->get();

      
        return view('admin.appointment.create', ['clients' => $clients, 'selectedDate'=> $selectedDate]);

    }

    public function index()
    {
        $events = array();
        $approvedAppointments = DB::table('appointment')->where('appointmentStatus','approved')->get();
        $upapprovedAppointments = DB::table('appointment')->where('appointmentStatus','pending')->get();
        // $trainings = DB::table('training')->get();
        $clients = DB::table('users')->where('role','client')->get();


        foreach($approvedAppointments as $approvedAppointment){

            $client = DB::table('users')->where('userTag', $approvedAppointment->userTag)->first();
            
            $dateTimeFormat = "Y-m-d H:i:s";
            $appointmentEndTime = strtotime($approvedAppointment->appointmentDateTime)+3600;
            $appointmentEndTime = date($dateTimeFormat, $appointmentEndTime);
            
            $events[] = [
                'id'   => $approvedAppointment->appointmentID,
                'title' => 'Appointment with: '.$client->name,
                'start' => $approvedAppointment->appointmentDateTime,
                'end' => $appointmentEndTime,
            ];
        }

        foreach($upapprovedAppointments as $unapprovedAppointment){

            $client = DB::table('users')->where('userTag', $unapprovedAppointment->userTag)->first();
            
            $dateTimeFormat = "Y-m-d H:i:s";
            $appointmentEndTime = strtotime($unapprovedAppointment->appointmentDateTime)+3600;
            $appointmentEndTime = date($dateTimeFormat, $appointmentEndTime);
            
            $events[] = [
                'id'   => $unapprovedAppointment->appointmentID,
                'title' => 'Appointment with: '.$client->name,
                'start' => $unapprovedAppointment->appointmentDateTime,
                'end' => $appointmentEndTime,
                'color' =>'#FE9100'
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
        
        return view('admin.appointment.index', ['events' => $events, 'clients' => $clients]);
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
        $clientTag = AdminAppointmentController::getUserTagByName($request->clientName);

        $client = User::where('userTag', $clientTag)->first();
        $clientPhone = $client->phoneNo;
        $clientEmail = $client->email;

        $appointment = new Appointment();
        $appointment->appointmentID = AdminAppointmentController::generateUniqueAppointmentID();
        $appointment->appointmentName = $request->clientName;
        $appointment->userTag = $clientTag;
        $appointment->appointmentContact = $clientPhone; 
        $appointment->appointmentEmail = $clientEmail;   
        $appointment->appointmentDateTime = $appointmentDateTime;
        $appointment->appointmentStatus = 'approved';
        $appointment->remarks = $request->remarks;
        $appointment->save();

        return redirect()->back()->with('message', 'Appointment created successfully!');
    }

    public function edit(Appointment $appointment){
        return view('admin.appointment.edit', ['appointment' => $appointment]);
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

    public function update(Request $request, Appointment $appointment)
{
    // Validate the form data
    $validatedData = $request->validate([
        'clientName' => 'required',
        'datetime' => 'required|date',
        'status' => 'required|in:pending,approved', // Assuming "status" can only be "pending" or "approved"
        'remarks' => 'nullable',
    ]);

    // Update the appointment's attributes
    $appointment->appointmentName = $validatedData['clientName'];
    $appointment->appointmentDateTime = $validatedData['datetime'];
    $appointment->appointmentStatus = $validatedData['status'];
    $appointment->remarks = $validatedData['remarks'];

    // Save the changes
    $appointment->save();

    // Redirect back with a success message
    return redirect()->route('admin.appointment.edit', ['appointment' => $appointment])
        ->with('message', 'Appointment details updated successfully.');
}

public function destroy(Request $request)
{
     $appointmentId = $request->input('id');
    
    
    // Ensure selectedIds is an array and not empty
    if ( $appointmentId == 'null') {
        return response()->json(['message' => 'No appointments selected for deletion.'], 400);
    }

    // Delete the selected appointments from the database
    
    Appointment::where('appointmentID',  $appointmentId)->delete();

    return response()->json(['message' => 'Selected appointments have been deleted successfully.'], 200);
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
