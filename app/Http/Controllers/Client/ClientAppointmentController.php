<?php

namespace App\Http\Controllers\Client;

use App\Models\User;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AppointmentRequested;


class ClientAppointmentController extends Controller
{
    
    public function index(Request $request)
    {
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
                ->where('appointment.userTag', '=', auth()->user()->userTag)
                ->get();

            return DataTables::of($clientAppointments)->toJson();
        }

        return view('client.appointment.index');
    }

    public function create(){

    }

    public function destroy(Request $request)
    {
        $selectedIds = $request->input('selectedIds');
        
        // Ensure selectedIds is an array and not empty
        if (!is_array($selectedIds) || count($selectedIds) === 0) {
            return response()->json(['message' => 'No records selected for deletion.'], 400);
        }
    
        // Delete the selected records from the database
        Appointment::whereIn('appointmentID', $selectedIds)->delete();
    
        return response()->json(['message' => 'Selected records have been deleted successfully.'], 200);
    }


    public function store(Request $request)
    {
    

    // Validate the request data here if needed
    $request->validate([
        'datetime' => 'required|date_format:Y-m-d H:i'
    ]);
    // Create a new appointment
    
    $appointment = new Appointment();
    $appointment->appointmentID = ClientAppointmentController::generateUniqueAppointmentID();
    $appointment->appointmentName = auth()->user()->name;
    $appointment->userTag = auth()->user()->userTag;
    $appointment->appointmentContact = auth()->user()->phoneNo;
    $appointment->appointmentEmail = auth()->user()->email;
    $appointment->appointmentDateTime = $request->input('datetime');
    $appointment->appointmentStatus = 'pending';
    $appointment->remarks = null;
    $appointment->save();

    $admins = User::where('role', 'admin')->get();
        
    foreach ($admins as $admin) {
            $admin->notify(new AppointmentRequested($appointment));
    }

    return redirect()->back()->with('message', 'Appointment request submitted successfully!');
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


