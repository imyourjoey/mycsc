<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminFeedbackController extends Controller
{
    public function create(){
        return view('feedback.create');
    }


    public function index(Request $request)
{
    if ($request->ajax()) {
        $feedback = DB::table('feedback')
            ->select([
                'feedback.feedbackID',
                'users.name as clientName',
                'feedback.feedbackMessage',
                'feedback.feedbackRating',
                'feedback.created_at',
                'feedback.updated_at',
            ])
            ->leftJoin('users', 'feedback.userTag', '=', 'users.userTag')
            ->get();

        return DataTables::of($feedback)->toJson();
    }

    return view('feedback.index');
}

    public function store(Request $request)
{
    $request->validate([
        'feedbackMessage' => 'required|string',
        'rating' => 'required|in:1,2,3,4,5', 
    ]);

    $feedback = new Feedback(); // Assuming your Feedback model is named Feedback

    // Update properties using the $feedback variable
    $feedback->userTag=auth()->user()->userTag;
    $feedback->feedbackID = AdminFeedbackController::generateUniqueFeedbackID();
    $feedback->feedbackMessage = $request->feedbackMessage;
    $feedback->feedbackRating = $request->rating;

    $feedback->save();

    return redirect()->back()->with('message', 'Feedback created successfully!');
}

public function edit(Feedback $feedback)
{
    $user = User::where('userTag', $feedback->userTag)->first();
    return view('feedback.edit', ['feedback' => $feedback , 'user' => $user]);
   
}

public function update(Request $request, Feedback $feedback)
{
    // Validate the form data
    $validatedData = $request->validate([
        'feedbackMessage' => 'required',
        'rating' => 'required|integer|between:1,5',
    ]);

    // Update the feedback attributes
    $feedback->feedbackMessage = $validatedData['feedbackMessage'];
    $feedback->feedbackRating = $validatedData['rating'];

    // Save the changes
    $feedback->save();

    // Redirect back with a success message
    return redirect()->route('feedback.edit', ['feedback' => $feedback])
        ->with('message', 'Feedback details updated successfully.');
}


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
