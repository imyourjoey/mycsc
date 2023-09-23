<?php

namespace App\Http\Controllers\Admin;


use App\Models\Service;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class AdminServiceController extends Controller
{


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $services = Service::select(['serviceID', 'serviceName', 'serviceDesc', 'servicePic', 'serviceEstDuration', 'created_at', 'updated_at']);
            
            return DataTables::of($services)->toJson();
        }
    
        return view('admin.service.index'); 

    }
    public function create(){
        return view('admin.service.create');
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

        if($request->hasFile('servicePic')){
            $imgpath = $request->file('servicePic')->store('services', 'public');
        }

        


        
        // $request->file('servicePic')->store('service', 'public');
        $serviceID = AdminServiceController::generateUniqueServiceID();
        $userTag = AdminServiceController::getUserTagByName($request->adminName);

        $service = new Service();
        $service->serviceID = $serviceID;
        $service->userTag = $userTag;
        $service->serviceName = $request->serviceTitle;
        $service->serviceDesc = $request->serviceDesc;
        $service->servicePic = $imgpath;
        $service->serviceEstDuration = $request->estDuration;
        $service->save();

        return redirect()->back()->with('message', 'Service created successfully!');
    }

    public function edit(Service $service)
    {
        return view('admin.service.edit', ['service' => $service]);
    }


    public function update(Request $request, Service $service)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'serviceTitle' => 'required',
            'serviceDesc' => 'required',
            'estDuration' => 'required',
            'adminName' => 'required' 
        ]);

        if($request->hasFile('servicePic')){
            $imgpath = $request->file('servicePic')->store('services', 'public');
            $service->servicePic = $imgpath;
        }

        
        

        // Update the service's attributes
        $service->serviceName = $validatedData['serviceTitle'];
        $service->serviceDesc = $validatedData['serviceDesc'];
        $service->serviceEstDuration = $validatedData['estDuration'];
        // $service->userTag = $validatedData['adminName'];

        // Save the changes
        $service->save();

        // Redirect back with a success message
        return redirect()->route('admin.service.edit', ['service' => $service])
        ->with('message', 'Service details updated successfully.');
    }


    public function destroy(Request $request)
{
    $selectedIds = $request->input('selectedIds');
    
    // Ensure selectedIds is an array and not empty
    if (!is_array($selectedIds) || count($selectedIds) === 0) {
        return response()->json(['message' => 'No records selected for deletion.'], 400);
    }

    // Delete the selected records from the database
    Service::whereIn('serviceID', $selectedIds)->delete();

    return response()->json(['message' => 'Selected records have been deleted successfully.'], 200);
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
