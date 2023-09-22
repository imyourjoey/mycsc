<?php

namespace App\Http\Controllers\Admin;

use App\Models\Training;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminTrainingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $trainings = DB::table('training')
                ->select([
                    'training.trainingID',
                    'users.name as adminName', 
                    'training.trainingTitle',
                    'training.trainingCapacity',
                    'training.trainingVenue',
                    'training.trainingDesc',
                    'training.startDateTime',
                    'training.endDateTime',
                    'training.trainerName',
                    'training.regisDeadline',
                    'training.created_at',
                    'training.updated_at'
                ])
                ->leftJoin('users', 'training.userTag', '=', 'users.userTag')
                ->get();

            return DataTables::of($trainings)->toJson();
        }

        return view('training.index'); // Replace 'training.index' with your actual view name
    }

    public function create(){
        return view('training.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'trainingTitle' => 'required|string|max:255',
            'trainingDesc' => 'required|string',
            'trainingVenue' => 'required|string|max:255',
            'trainerName' => 'required|string|max:255',
            'trainingCapacity' => 'required|integer',
            'startDateTime' => 'required|date',
            'endDateTime' => 'required|date|after:startDateTime',
            'regisDeadline' => 'required|date|before:startDateTime',
        ]);

        // Create a new Training model instance and fill it with the validated data
        $training = new Training();
        $training->trainingID = AdminTrainingController::generateUniqueTrainingID(); // You can define a function to generate a unique ID
        $training->userTag = $request->userTag; // Replace with the actual userTag
        $training->trainingTitle = $request->input('trainingTitle');
        $training->trainingCapacity = $request->input('trainingCapacity');
        $training->trainingVenue = $request->input('trainingVenue');
        $training->trainingDesc = $request->input('trainingDesc');
        $training->startDateTime = $request->input('startDateTime');
        $training->endDateTime = $request->input('endDateTime');
        $training->trainerName = $request->input('trainerName');
        $training->regisDeadline = $request->input('regisDeadline');
        $training->userTag = auth()->user()->userTag;
        

        // Save the training program to the database
        $training->save();

        // Redirect back with a success message
        return redirect()->back()->with('message', 'Training programme created successfully!');
    }

    public function edit(Training $training)
    {
        
        return view('training.edit', ['training' => $training]);
    }



    public function update(Request $request, Training $training)
{
    // Validate the form data
    $validatedData = $request->validate([
        'trainingTitle' => 'required',
        'trainingDesc' => 'required',
        'trainingVenue' => 'required',
        'trainerName' => 'required',
        'trainingCapacity' => 'required|integer|min:1', 
        'startDateTime' => 'required|date',
        'endDateTime' => 'required|date|after:startDateTime',
        'regisDeadline' => 'required|date|before:startDateTime', 
    ]);


    $training->trainingTitle = $validatedData['trainingTitle'];
    $training->trainingDesc = $validatedData['trainingDesc'];
    $training->trainingVenue = $validatedData['trainingVenue'];
    $training->trainerName = $validatedData['trainerName'];
    $training->trainingCapacity = $validatedData['trainingCapacity'];
    $training->startDateTime = $validatedData['startDateTime'];
    $training->endDateTime = $validatedData['endDateTime'];
    $training->regisDeadline = $validatedData['regisDeadline'];

    // Save the changes
    $training->save();

    // Redirect back with a success message
    return redirect()->route('training.edit', ['training' => $training])
        ->with('message', 'Training program details updated successfully.');
}


public function destroy(Request $request)
{
    $selectedIds = $request->input('selectedIds');
    
    // Ensure selectedIds is an array and not empty
    if (!is_array($selectedIds) || count($selectedIds) === 0) {
        return response()->json(['message' => 'No records selected for deletion.'], 400);
    }

    // Delete the selected records from the database
    Training::whereIn('trainingID', $selectedIds)->delete();

    return response()->json(['message' => 'Selected records have been deleted successfully.'], 200);
}


    // You can define a function to generate a unique training ID here
    public function generateUniqueTrainingID()
{
    $prefix = 'TR';

    if ($prefix) {
        $unique = false;
        $count = 1;

        while (!$unique) {
            $trainingID = $prefix . str_pad($count, 3, '0', STR_PAD_LEFT);

            if (!Training::where('trainingID', $trainingID)->exists()) {
                $unique = true;
            }

            $count++;
        }

        return $trainingID;
    }

    return '';
}

    
}
