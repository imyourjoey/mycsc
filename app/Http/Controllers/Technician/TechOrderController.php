<?php

namespace App\Http\Controllers\Technician;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TechOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            
            $orders = DB::table('order')
                ->select([
                    'order.orderID',
                    'client.name as clientName', 
                    'service.serviceName as serviceName',
                    'technician.name as assignedTechnician',
                    'order.deviceType',
                    'order.hardwareManufacturer',
                    'order.partNo',
                    'order.serialNo',
                    'order.diskCapacity',
                    'order.capacityRestored',
                    'order.othersIncluded',
                    'order.orderStatus',
                    'order.orderStatusPic',
                    'order.orderRemarks',
                    'order.created_at',
                    'order.updated_at'
                ])
                ->leftJoin('users as client', 'order.clientTag', '=','client.userTag')
                ->leftJoin('service','order.serviceID', '=', 'service.serviceID')
                ->leftJoin('users as technician', 'order.technicianTag', '=', 'technician.userTag')
                ->where('order.technicianTag', auth()->user()->userTag)
                ->get();
            
            return DataTables::of($orders)->toJson();
        }
    
        return view('technician.order.index'); 

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
    public function edit(Order $order)
    {
        $clients = DB::table('users')->where('role','client')->get();
        $technicians = DB::table('users')->where('role','technician')->get();
        $services = DB::table('service')->get();

        // $user = User::findOrFail($id);
        // return view('user.update', compact('user'));
        return view('technician.order.edit', ['order' => $order,'clients' => $clients, 'technicians'=> $technicians, 'services'=> $services]);

        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'deviceType' => 'required',
            'manufacturer' => 'nullable',
            'assignedTechnician' => 'required',
            'partNo' => 'nullable',
            'orderStatus' => 'required',
            'serialNo' => 'nullable',
            'statusPic' => 'nullable|mimes:jpeg,png|max:10000',
            'othersIncluded' => 'nullable',
            'remarks' => 'nullable',
            'diskCapacity' => 'numeric|nullable',
            'capacityRestored' => 'numeric|nullable',
        ]);

        if($request->hasFile('statusPic')){
            $imgpath = $request->file('statusPic')->store('statusPics', 'public');
            $order->orderStatusPic = $imgpath;

        }

        
        
        $technicianTag = TechOrderController::getUserTagByName($validatedData['assignedTechnician']);
        

        // Update the service's attributes
        $order->deviceType = $validatedData['deviceType'];
        $order->hardwareManufacturer = $validatedData['manufacturer'];
        $order->technicianTag = $technicianTag;
        $order->partNo = $validatedData['partNo'];
        $order->orderStatus = $validatedData['orderStatus'];
        $order->serialNo = $validatedData['serialNo'];        
        $order->othersIncluded = $validatedData['othersIncluded'];
        $order->orderRemarks = $validatedData['remarks'];
        $order->diskCapacity = $validatedData['diskCapacity'];
        $order->capacityRestored = $validatedData['capacityRestored'];

        
        // $service->userTag = $validatedData['adminName'];

        // Save the changes
        $order->save();

        // Redirect back with a success message
        return redirect()->route('technician.order.edit', ['order' => $order])
        ->with('message', 'Order details updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
