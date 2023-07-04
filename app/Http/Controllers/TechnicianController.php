<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class TechnicianController extends Controller
{

     //Create New technician
     public function store(Request $request){

        $highestTechnician = DB::table('technician')
        ->select('technicianID')
        ->orderBy('technicianID', 'desc')
        ->first();

    if ($highestTechnician) {
        $currentNumber = substr($highestTechnician->technicianID, 3);
        $nextNumber = intval($currentNumber) + 1;
        $nextTechnicianID = 'TE_' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
    } else {
        $nextTechnicianID = 'TE_00001';
    }


        $request->validate([
            'role' => ['required'],
            'adminUsername' => ['required', Rule::unique('technician','technicianUsername')],
            'adminName' => ['required'],
            'adminPhone' => ['required'],
            'adminEmail' => ['required'],
            'adminPassword' => 'required|confirmed',
            'adminPassword_confirmation' =>'required'
        ]);
        
        //hash password
        $request['adminPassword']= bcrypt($request['adminPassword']);

        DB::table('technician')->insert([
            'technicianID' => $nextTechnicianID,
            'technicianUsername' => $request->input('adminUsername'),
            'technicianName' => $request->input('adminName'),
            'technicianPhone' => $request->input('adminPhone'),
            'technicianEmail' => $request->input('adminEmail'),
            'technicianPassword' => $request->input('adminPassword'),
            
        ]);

        return redirect()->back()->with('message', 'New technician account created!');
    
}
    
}
