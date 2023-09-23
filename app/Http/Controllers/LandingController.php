<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function showLandingPage(){
        $services = Service::all();

        return view('landing' ,compact('services')); 
    }
}
