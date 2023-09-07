<?php

namespace App\Http\Controllers;


use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class ServiceController extends Controller
{
    public function create(){
        return view('service.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'serviceTitle' => 'required',
            'serviceDesc' => 'required',
            'servicePic' => 'required',
            'estDuration' => 'required',
            'adminName' => 'required',
        ],
        [
            // 'phoneNo.required' => 'The phone number field is required'
        ]);

        // $file = $request->file('servicePic');
        // $file->store('service', 'public');

        if($request->hasFile('servicePic')){
             $request->file('servicePic')->store('services', 'public');
        }


        
        // $request->file('servicePic')->store('service', 'public');
        $serviceID = ServiceController::generateUniqueServiceID();
        $userTag = ServiceController::getUserTagByName($request->adminName);

        $service = new Service();
        $service->serviceID = $serviceID;
        $service->userTag = $userTag;
        $service->serviceName = $request->serviceTitle;
        $service->serviceDesc = $request->serviceDesc;
        $service->servicePic = $request->servicePic;
        $service->serviceEstDuration = $request->estDuration;
        $service->save();

        return redirect()->back()->with('message', 'Service created successfully!');
    }


    public function generateUniqueServiceID()
    {
        $prefix = 'SE';
        
        if ($prefix) {
            $unique = false;
            $count = 1;
            
            while (!$unique) {
                $serviceID = $prefix . str_pad($count, 3, '0', STR_PAD_LEFT);
                
                if (!Service::where('serviceID', $serviceID)->exists()) {
                    $unique = true;
                }
                
                $count++;
            }
    
            return $serviceID;
        }
    
        return '';
    }

    public function getUserTagByName($name)
    {
        $user = User::where('name', $name)->first();
    
        if ($user) {
            $userTag = $user->userTag; 
            return $userTag;
        } 
    }
}
