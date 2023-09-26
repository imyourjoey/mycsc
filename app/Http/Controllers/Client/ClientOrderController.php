<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClientOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $userTag = Auth::user()->userTag;

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
                ->where('order.clientTag', '=', $userTag)
                ->get();
            
            return DataTables::of($orders)->toJson();
        }
    
        return view('client.order.index'); 

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
