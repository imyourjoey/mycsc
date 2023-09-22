<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;


class CalendarController extends Controller
{

    public function create(){
        return view('appointment.create');
    }
    public function index()
    {
        $events = array();
        $appointments = DB::table('appointment')->get();
        $trainings = DB::table('training')->get();
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
        
        foreach($trainings as $training) {
            
            $events[] = [
                'id'   => $training->trainingID,
                'title' => $training->trainingTitle,
                'start' => $training->startDateTime,
                'end' => $training->endDateTime
            ];
        }
        
        return view('/hello', ['events' => $events, 'clients' => $clients]);
}


public function destroy(Request $request)
{
    $id = $request->input('id');
    $idArray = explode(',', $id);

    // Delete the selected records from the database
    Appointment::whereIn('appointmentID', $idArray)->delete();

    return response()->json(['message' => 'Selected record have been deleted successfully.'], 200);
}

public function showVerify(){
    return view('verify-email');
}



public function verifyEmail(Request $request, User $user){
    $request->validate([
        'otp' => 'required|digits:6', 
    ]);

    $decryptedOtp =  Crypt::decrypt($user->oneTimePin);
    if( $decryptedOtp === $request->input('otp')){
        $user->emailVerified = 1;
        $user->save();
        if ($user->role === 'admin') {
            return redirect()->route('admin.index')->with('message', 'Email successfully verified! Logged in as Admin!');
        } elseif ($user->role === 'client') {
            return redirect()->route('client.index')->with('message', 'Email successfully verified! Logged in as Client!');
        } elseif ($user->role === 'technician') {
            return redirect()->route('technician.index')->with('message', 'Email successfully verified! Logged in as Technician!');
        }


    }else{
        return redirect()->back()
        ->with('error', 'The code entered was incorrect');
    }
}
}