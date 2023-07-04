<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\Client;


class ClientController extends Controller
{
     //Create New client
     public function store(Request $request){

        $highestClient = DB::table('client')
        ->select('clientID')
        ->orderBy('clientID', 'desc')
        ->first();

    if ($highestClient) {
        $currentNumber = substr($highestClient->clientID, 3);
        $nextNumber = intval($currentNumber) + 1;
        $nextClientID = 'CL_' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
    } else {
        $nextClientID = 'CL_00001';
    }


        $request->validate([
            'role' => ['required'],
            'adminUsername' => ['required', Rule::unique('client','clientUsername')],
            'adminName' => ['required'],
            'adminPhone' => ['required'],
            'adminEmail' => ['required'],
            'adminPassword' => 'required|confirmed',
            'adminPassword_confirmation' =>'required'
        ]);
        
        //hash password
        $request['adminPassword']= bcrypt($request['adminPassword']);

        DB::table('client')->insert([
            'clientID' => $nextClientID,
            'clientUsername' => $request->input('adminUsername'),
            'clientName' => $request->input('adminName'),
            'clientPhone' => $request->input('adminPhone'),
            'clientEmail' => $request->input('adminEmail'),
            'clientPassword' => $request->input('adminPassword'),
            
        ]);

        return redirect()->back()->with('message', 'New client account created!');
    }
}
