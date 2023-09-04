<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    public function index()
    {
        $events = array();
        $appointments = DB::table('appointment')->get();
        $trainings = DB::table('training')->get();
        $clients = DB::table('client')->get();


        foreach($appointments as $appointment){

            $client = DB::table('client')->where('clientID', $appointment->clientID)->first();
            
            $dateTimeFormat = "Y-m-d H:i:s";
            $appointmentEndTime = strtotime($appointment->appointmentDateTime)+3600;
            $appointmentEndTime = date($dateTimeFormat, $appointmentEndTime);
            
            $events[] = [
                'id'   => $appointment->appointmentID,
                'title' => 'Appointment with: '.$client->clientName,
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
}