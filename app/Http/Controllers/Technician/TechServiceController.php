<?php

namespace App\Http\Controllers\Technician;

use App\Models\Service;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class TechServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $services = Service::select(['serviceID', 'serviceName', 'serviceDesc', 'servicePic', 'serviceEstDuration', 'created_at', 'updated_at']);
            
            return DataTables::of($services)->toJson();
        }
    
        return view('technician.service.index'); 

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('technician.service.edit', ['service' => $service]);
    }

    /**
     * Update the specified resource in storage.
     */
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
        return redirect()->route('technician.service.edit', ['service' => $service])
        ->with('message', 'Service details updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
