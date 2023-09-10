<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
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

        


        
        
        $orderID = OrderController::generateUniqueOrderID();
        $clientTag = OrderController::getUserTagByName($request->clientName);
        $technicianTag = OrderController::getUserTagByName($request->assignedTechnician);
        $serviceID = OrderController::getServiceIDByName($request->serviceType);

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
