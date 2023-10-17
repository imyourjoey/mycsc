<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use App\Notifications\inquirySent;

class GuestController extends Controller
{
    public function submitGuestInquiry(Request $request)
    {
        $request->validate([
            'inquiryMessage' => 'required|string',
            'inquiryName' => 'required|string',
            'inquiryContactEmail' => 'required|email'
        ]);

        $inquiry = new Inquiry();

        // Update properties using the $inquiry variable
        $inquiry->inquiryID = self::generateUniqueInquiryID();
        $inquiry->userTag = null;
        $inquiry->inquiryName = $request->inquiryName; 
        $inquiry->inquiryMessage = $request->inquiryMessage;
        $inquiry->inquiryContactEmail = $request->inquiryContactEmail; 

        $inquiry->save();



        //notify admins
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            $admin->notify(new inquirySent($inquiry));
    }

        return redirect()->back()->with('message', 'Inquiry created successfully!');
    }


    public function generateUniqueInquiryID()
{
    $prefix = 'IN';

    if ($prefix) {
        $unique = false;
        $count = 1;

        while (!$unique) {
            $inquiryID = $prefix . str_pad($count, 3, '0', STR_PAD_LEFT);

            if (!Inquiry::where('inquiryID', $inquiryID)->exists()) {
                $unique = true;
            }

            $count++;
        }

        return $inquiryID;
    }

    return '';
} 
}
