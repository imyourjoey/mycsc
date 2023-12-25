<?php

namespace App\Http\Controllers\Client;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClientInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{

    if ($request->ajax()) {
        $userTag = Auth::user()->userTag; // Get the authenticated user's userTag

        $invoices = Invoice::select([
            'invoice.invoiceID',
            'invoice.orderID',
            'users.name as clientName', 
            'invoice.totalPayable',
            'invoice.invoiceDueDate',
            'invoice.paymentStatus',
            'invoice.paymentAmount',
            'invoice.paymentMethod',
            'invoice.paymentDate',
            'invoice.created_at',
            'invoice.updated_at'
            
        ])
        ->leftJoin('order', 'invoice.orderID', '=', 'order.orderID') 
        ->leftJoin('users', 'order.clientTag', '=', 'users.userTag')
        ->where('order.clientTag', '=', $userTag) 
        ->get();

        return DataTables::of($invoices)->toJson();
    }

    return view('client.invoice.index');
}



public function showInvoice(Invoice $invoice){
    // Fetch the invoice data based on the provided $invoiceID
    $invoiceInfo = DB::table('invoice')
        ->select(
            'invoice.invoiceID',
            'invoice.created_at as invoiceCreatedAt',
            'invoice.invoiceDueDate',
            'users.name as clientName',
            'users.phoneNo as clientPhoneNo',
            'users.email as clientEmail',
            'service.serviceName as serviceType',
            'invoice.totalPayable',
            'order.capacityRestored'
        )
        ->join('order', 'invoice.orderID', '=', 'order.orderID')
        ->join('users', 'invoice.userTag', '=', 'users.userTag')
        ->join('service', 'order.serviceID', '=', 'service.serviceID')
        ->where('invoice.invoiceID', $invoice->invoiceID)
        ->first();

    // Check if the invoice was found
    if ($invoice) {
        return view('show-invoice', ['invoice' => $invoiceInfo]);
    } else {
        // Handle the case where the invoice with the given ID was not found
        // You can redirect to an error page or return an error message
        // For example:
        // return view('invoice.not_found');
    }
}


public function showReceipt(Invoice $invoice){
    // Fetch the invoice data based on the provided $invoiceID
    $invoiceInfo = DB::table('invoice')
        ->select(
            'invoice.invoiceID',
            'invoice.created_at as invoiceCreatedAt',
            'invoice.invoiceDueDate',
            'users.name as clientName',
            'users.phoneNo as clientPhoneNo',
            'users.email as clientEmail',
            'service.serviceName as serviceType',
            'invoice.totalPayable',
            'invoice.paymentAmount',
            'invoice.paymentDate',
            'order.capacityRestored'
        )
        ->join('order', 'invoice.orderID', '=', 'order.orderID')
        ->join('users', 'invoice.userTag', '=', 'users.userTag')
        ->join('service', 'order.serviceID', '=', 'service.serviceID')
        ->where('invoice.invoiceID', $invoice->invoiceID)
        ->first();

    // Check if the invoice was found
    if ($invoiceInfo) {
        $balanceDue = $invoiceInfo->totalPayable - $invoiceInfo->paymentAmount;
        $invoiceInfo->balanceDue = $balanceDue;
        return view('show-receipt', ['invoice' => $invoiceInfo]);
    } else {
        // Handle the case where the invoice with the given ID was not found
        // You can redirect to an error page or return an error message
        // For example:
        // return view('invoice.not_found');
    }
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
