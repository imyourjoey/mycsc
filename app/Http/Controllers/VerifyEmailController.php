<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class VerifyEmailController extends Controller
{
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
