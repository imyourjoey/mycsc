<?php

namespace App\Http\Controllers;


use App\Models\Service;
use App\Models\Feedback;
use App\Models\Training;
use App\Models\Announcement;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function showLandingPage(){
        $services = Service::all();
        $announcements = Announcement::all();
        $trainings = Training::all();
        $feedbacks = Feedback::select('feedback.*', 'users.name as name')
        ->leftJoin('users', 'feedback.userTag', '=', 'users.userTag')
        ->get();

        return view('landing', compact('trainings', 'announcements', 'services', 'feedbacks')); 
    }


    
}
