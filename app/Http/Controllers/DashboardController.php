<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showClientDash(){
        return view('client.dashboard');
    }

    public function showAdminDash(){


        //get inquiries received today
        $today = now()->toDateString();
        $inquiryCount = Inquiry::whereDate('created_at', $today)->count();
    

        return view('admin.dashboard',['inquiryCount'=>$inquiryCount]);
    }

    public function showTechnicianDash(){
        return view('technician.dashboard');
    }


}
