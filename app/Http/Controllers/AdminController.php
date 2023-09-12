<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){


        //get inquiries received today
        $today = now()->toDateString();
        $inquiryCount = Inquiry::whereDate('created_at', $today)->count();
    

        return view('admin.dashboard',['inquiryCount'=>$inquiryCount]);
    }
}
