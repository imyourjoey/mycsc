<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Feedback;

class ClientFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $clientFeedbacks = DB::table('feedback')
            ->select([
                'feedback.feedbackID',
                'feedback.feedbackMessage',
                'feedback.feedbackRating'
            ])
            ->where('feedback.userTag', '=', auth()->user()->userTag)
            ->get();

            $clientFeedbacks = $clientFeedbacks->map(function ($inquiry, $index) {
                $inquiry->rowNumber = $index + 1;
                return $inquiry;
            });

            return DataTables::of($clientFeedbacks)->toJson();
        }

        return view('client.feedback.index');
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
        $request->validate([
            'feedbackMessage' => 'required|string',
            'rating' => 'required|in:1,2,3,4,5', 
        ]);
    
        $feedback = new Feedback(); // Assuming your Feedback model is named Feedback
    
        // Update properties using the $feedback variable
        $feedback->userTag=auth()->user()->userTag;
        $feedback->feedbackID = ClientFeedbackController::generateUniqueFeedbackID();
        $feedback->feedbackMessage = $request->feedbackMessage;
        $feedback->feedbackRating = $request->rating;
    
        $feedback->save();
    
        return redirect()->back()->with('message', 'Feedback submitted successfully!');
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
        Feedback::whereIn('feedbackID', $selectedIds)->delete();
    
        return response()->json(['message' => 'Selected records have been deleted successfully.'], 200);
    }



    public function generateUniqueFeedbackID()
{
    $prefix = 'FE';

    if ($prefix) {
        $unique = false;
        $count = 1;

        while (!$unique) {
            $feedbackID = $prefix . str_pad($count, 3, '0', STR_PAD_LEFT);

            if (!Feedback::where('feedbackID', $feedbackID)->exists()) {
                $unique = true;
            }

            $count++;
        }

        return $feedbackID;
    }

    return '';
}
}
