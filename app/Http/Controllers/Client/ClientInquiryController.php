<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Inquiry;

class ClientInquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $clientInquiries = DB::table('inquiry')
            ->select([
                'inquiry.inquiryID',
                'inquiry.inquiryMessage',
                'inquiry.inquiryReply'
            ])
            ->where('inquiry.userTag', '=', auth()->user()->userTag)
            ->get();

            $clientInquiries = $clientInquiries->map(function ($inquiry, $index) {
                $inquiry->rowNumber = $index + 1;
                return $inquiry;
            });

            return DataTables::of($clientInquiries)->toJson();
        }

        return view('client.inquiry.index');
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
}
