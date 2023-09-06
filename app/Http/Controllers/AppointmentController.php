<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function create(Request $request){


        //determine next appointmentID
        if (Appointment::count() > 0) {
            // Retrieve the last appointment record
            $lastAppointment = Appointment::latest()->first();
    
            // Extract the last appointment ID (e.g., 'AP001' -> 1)
            $lastAppointmentId = intval(substr($lastAppointment->appointmentID, 2));
    
            // Increment the last appointment ID
            $newAppointmentId = $lastAppointmentId + 1;
    
            // Format the new appointment ID as 'APxxx' (e.g., 'AP001')
            $formattedAppointmentId = 'AP' . str_pad($newAppointmentId, 3, '0', STR_PAD_LEFT);
        } else {
            // If the 'appointments' table is empty, start with 'AP001'
            $formattedAppointmentId = 'AP001';
        }


        //find client with same name with request
        $client = DB::table('users')->where('name', $request->input('clientName'))->first();

        if (!$client) {
        // If the client doesn't exist, you can handle the error here
        return response()->json(['error' => 'Client not found'], 404);
        }



       $newAppointment = new Appointment();
       $newAppointment->appointmentID = $formattedAppointmentId;
       $newAppointment->userTag = $client->userTag;
       $newAppointment->appointmentDateTime = $request->appointmentDateTime;
       $newAppointment->appointmentStatus = 'Approved';
    //    $newAppointment->remarks = null;
    
       $newAppointment->save();

       $responseData = [
        'newAppointment' => $newAppointment,
        'clientName' => $client->name,
       ];

       return response()->json($responseData);


        
    }
}
