<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminOrderController extends Controller
{
    public function create(){
        $clients = DB::table('users')->where('role','client')->get();
        $technicians = DB::table('users')->where('role','technician')->get();
        $services = DB::table('service')->get();

        return view('order.create',['clients' => $clients, 'technicians'=> $technicians, 'services'=> $services]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'serviceType' => 'required',
            'deviceType' => 'required',
            'clientName' => 'required',
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
        ],
        [
            // 'phoneNo.required' => 'The phone number field is required'
        ]);

        if($request->hasFile('statusPic')){
            $imgpath = $request->file('statusPic')->store('statusPics', 'public');
        }

        


        
        
        $orderID = AdminOrderController::generateUniqueOrderID();
        $clientTag = AdminOrderController::getUserTagByName($request->clientName);
        $technicianTag = AdminOrderController::getUserTagByName($request->assignedTechnician);
        $serviceID = AdminOrderController::getServiceIDByName($request->serviceType);

        $order = new Order();
        $order->orderID = $orderID;
        $order->serviceID = $serviceID;
        $order->deviceType = $request->deviceType;
        $order->clientTag = $clientTag;
        $order->hardwareManufacturer = $request->manufacturer;
        $order->technicianTag = $technicianTag;
        $order->partNo = $request->partNo;
        $order->orderStatus = $request->orderStatus;
        $order->serialNo = $request->serialNo;
        $order->orderStatusPic = $imgpath;
        $order->othersIncluded = $request->othersIncluded;
        $order->diskCapacity = $request->diskCapacity;
        $order->capacityRestored = $request->capacityRestored;
        $order->orderRemarks = $request->remarks;
        $order->save();

        return redirect()->back()->with('message', 'Order created successfully!');
    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $orders = Order::select(['orderID', 'clientTag', 'serviceID', 'technicianTag', 'deviceType', 'hardwareManufacturer', 'partNo', 'serialNo', 'diskCapacity', 'capacityRestored', 'othersIncluded', 'orderStatus', 'orderStatusPic', 'orderRemarks', 'created_at', 'updated_at']);

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
                ->get();
            
            return DataTables::of($orders)->toJson();
        }
    
        return view('order.index'); 

    }

    public function edit(Order $order)
    {
        $clients = DB::table('users')->where('role','client')->get();
        $technicians = DB::table('users')->where('role','technician')->get();
        $services = DB::table('service')->get();

        // $user = User::findOrFail($id);
        // return view('user.update', compact('user'));
        return view('order.edit', ['order' => $order,'clients' => $clients, 'technicians'=> $technicians, 'services'=> $services]);

        
    }


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

        
        
        $technicianTag = AdminOrderController::getUserTagByName($validatedData['assignedTechnician']);
        

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
        return redirect()->route('order.edit', ['order' => $order])
        ->with('message', 'Order details updated successfully.');
    }


    public function destroy(Request $request)
{
    $selectedIds = $request->input('selectedIds');
    
    // Ensure selectedIds is an array and not empty
    if (!is_array($selectedIds) || count($selectedIds) === 0) {
        return response()->json(['message' => 'No records selected for deletion.'], 400);
    }

    // Delete the selected records from the database
    Order::whereIn('orderID', $selectedIds)->delete();

    return response()->json(['message' => 'Selected records have been deleted successfully.'], 200);
}



    public function generateUniqueOrderID()
    {
        $prefix = 'OR';
        
        if ($prefix) {
            $unique = false;
            $count = 1;
            
            while (!$unique) {
                $orderID = $prefix . str_pad($count, 3, '0', STR_PAD_LEFT);
                
                if (!Order::where('orderID', $orderID)->exists()) {
                    $unique = true;
                }
                
                $count++;
            }
    
            return $orderID;
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

    public function getServiceIDByName($name){
        $service = Service::where('serviceName', $name)->first();
    
        if ($service) {
            $serviceID = $service->serviceID; 
            return $serviceID;
        } 
    }
}
