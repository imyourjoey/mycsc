<?php

namespace App\Http\Controllers\Admin;

use App\Models\Inquiry;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminInquiryController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $inquiries = DB::table('inquiry')
                ->select([
                    'inquiry.inquiryID',
                    'inquiry.inquiryName as clientName',
                    'inquiry.userTag',
                    'inquiry.inquiryMessage',
                    'inquiry.inquiryContactEmail as contactEmail',
                    'inquiry.created_at',
                    'inquiry.updated_at',
                ])
                ->get();

            return DataTables::of($inquiries)->toJson();
        }

        return view('inquiry.index');
    }
    public function create(){
        return view('inquiry.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'inquiryMessage' => 'required|string',
        ]);

        $inquiry = new Inquiry();

        // Update properties using the $inquiry variable
        $inquiry->userTag = auth()->user()->userTag;
        $inquiry->inquiryID = self::generateUniqueInquiryID();
        $inquiry->inquiryName = auth()->user()->name; 
        $inquiry->inquiryMessage = $request->inquiryMessage;
        $inquiry->inquiryContactEmail = auth()->user()->email; 

        $inquiry->save();

        return redirect()->back()->with('message', 'Inquiry created successfully!');
    }

    public function edit(Inquiry $inquiry)
{
    return view('inquiry.edit', ['inquiry' => $inquiry]);
   
}


public function update(Request $request, Inquiry $inquiry)
{
    // Validate the form data
    $validatedData = $request->validate([
        'inquiryMessage' => 'required|string',
    ]);

    // Update the inquiry attributes
    $inquiry->inquiryMessage = $validatedData['inquiryMessage'];

    // Save the changes
    $inquiry->save();

    // Redirect back with a success message
    return redirect()->route('inquiry.edit', ['inquiry' => $inquiry])
        ->with('message', 'Inquiry details updated successfully.');
}

public function destroy(Request $request)
{
    $selectedIds = $request->input('selectedIds');

    // Ensure selectedIds is an array and not empty
    if (!is_array($selectedIds) || count($selectedIds) === 0) {
        return response()->json(['message' => 'No records selected for deletion.'], 400);
    }

    // Delete the selected records from the database
    Inquiry::whereIn('inquiryID', $selectedIds)->delete();

    return response()->json(['message' => 'Selected records have been deleted successfully.'], 200);
}




    public function generateUniqueInquiryID()
{
    $prefix = 'IN';

    if ($prefix) {
        $unique = false;
        $count = 1;

        while (!$unique) {
            $inquiryID = $prefix . str_pad($count, 3, '0', STR_PAD_LEFT);

            if (!Inquiry::where('inquiryID', $inquiryID)->exists()) {
                $unique = true;
            }

            $count++;
        }

        return $inquiryID;
    }

    return '';
}
}
