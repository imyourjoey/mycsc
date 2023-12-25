<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Notifications\invoiceIssued;

class AdminInvoiceController extends Controller
{
    public function create(){

        $orders = DB::table('order')
        ->select('order.orderID', 'users.name')
        ->join('users', 'order.clientTag', '=', 'users.userTag')
        ->where('order.orderStatus', '!=', 'completed')
        ->get();


        return view('admin.invoice.create',['orders' => $orders]);
    }

    public function edit(Invoice $invoice)
    {
        $orders = DB::table('order')
        ->select('order.orderID', 'users.name')
        ->join('users', 'order.clientTag', '=', 'users.userTag')
        ->where('order.orderStatus', '!=', 'completed')
        ->get();
        $client = DB::table('users')->where('userTag',$invoice->userTag)->get();

        // $user = User::findOrFail($id);
        // return view('user.update', compact('user'));
        return view('admin.invoice.edit', ['invoice' => $invoice,'client' => $client, 'orders'=> $orders]);

        
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

    public function store(Request $request)
{
    $request->validate([
        'orderID' => 'required|exists:order,orderID', 
        'dueDate' => 'required|date',
        'totalPayable' => 'required|numeric|min:0',
        'amountPaid' => 'nullable|numeric|min:0',
        'paymentStatus' => 'required|in:pending,paid',
        'paymentMethod' => 'nullable|string|max:60',
        'paymentDate' => 'nullable|date'
    ]);


    // Custom validation rule: If amountPaid < totalPayable, paymentStatus cannot be pending
    $request->validate([
        'paymentStatus' => function ($attribute, $value, $fail) use ($request) {
            if ($request->amountPaid < $request->totalPayable && $value == 'paid') {
                $fail('If "Amount Paid" is less than "Total Payable", "Payment Status" cannot be set to "Paid".');
            }
        },
    ]);

    

    $order = Order::where('orderID', $request->input('orderID'))->first();
    $clientTag = $order->clientTag;


    // Create a new invoice
    $invoice = new Invoice();
    $invoice->invoiceID = AdminInvoiceController::generateUniqueInvoiceID(); // Implement your unique ID generation logic
    $invoice->orderID = $request->input('orderID');
    $invoice->userTag = $clientTag;
    $invoice->totalPayable = $request->totalPayable;
    $invoice->invoiceDueDate = $request->dueDate;
    $invoice->paymentStatus = $request->paymentStatus;
    $invoice->paymentAmount = $request->amountPaid;
    $invoice->paymentMethod = $request->paymentMethod;
    

    if ($request->paymentStatus == 'paid') {
        $invoice->paymentDate = now(); // Set paymentDate to the current date and time
    }
 
    $invoice->save();

    //notify user
    $user = User::where('userTag', $clientTag)->first();

        if ($user) {
            // Send a notification to the user
            $user->notify(new invoiceIssued($invoice));
        }

    return redirect()->route('admin.invoice.create')->with('message', 'Invoice created successfully!');
}


public function index(Request $request)
{
    if ($request->ajax()) {
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
        ->get();

        return DataTables::of($invoices)->toJson();
    }

    return view('admin.invoice.index');
}

public function update(Request $request, Invoice $invoice)
{
    // Validate the form data
    $validatedData = $request->validate([
        'totalPayable' => 'required|numeric',
        'dueDate' => 'required|date',
        'paymentStatus' => 'nullable|string',
        'amountPaid' => 'nullable|numeric',
        'paymentMethod' => 'nullable|string',
        'paymentDate' =>'nullable'
    ]);

    $request->validate([
        'paymentStatus' => function ($attribute, $value, $fail) use ($request) {
            if ($request->amountPaid < $request->totalPayable && $value == 'paid') {
                $fail('If "Amount Paid" is less than "Total Payable", "Payment Status" cannot be set to "Paid".');
            }
        },
    ]);


    // Check if paymentStatus is changing from 'pending' to 'paid'
    $statusChangedToPaid = $invoice->paymentStatus === 'pending' && $validatedData['paymentStatus'] === 'paid';

    // Update the invoice's attributes
    $invoice->totalPayable = $validatedData['totalPayable'];
    $invoice->invoiceDueDate = $validatedData['dueDate'];
    $invoice->paymentStatus = $validatedData['paymentStatus'];
    $invoice->paymentAmount = $validatedData['amountPaid'];
    $invoice->paymentMethod = $validatedData['paymentMethod'];

    if ($statusChangedToPaid) {
        $invoice->paymentDate = now(); // Set paymentDate to the current date and time
    }


    // Save the changes
    $invoice->save();

    // Redirect back with a success message
    return redirect()->route('admin.invoice.edit', ['invoice' => $invoice])
        ->with('message', 'Invoice details updated successfully.');
}


    public function destroy(Request $request)
    {
        $selectedIds = $request->input('selectedIds');
        
        // Ensure selectedIds is an array and not empty
        if (!is_array($selectedIds) || count($selectedIds) === 0) {
            return response()->json(['message' => 'No records selected for deletion.'], 400);
        }

        // Delete the selected records from the database
        Invoice::whereIn('invoiceID', $selectedIds)->delete();

        return response()->json(['message' => 'Selected records have been deleted successfully.'], 200);
    }




public function generateUniqueInvoiceID()
    {
        $prefix = 'IN';
        
        if ($prefix) {
            $unique = false;
            $count = 1;
            
            while (!$unique) {
                $invoiceID = $prefix . str_pad($count, 3, '0', STR_PAD_LEFT);
                
                if (!Invoice::where('invoiceID', $invoiceID)->exists()) {
                    $unique = true;
                }
                
                $count++;
            }
    
            return $invoiceID;
        }
    
        return '';
    }
}
