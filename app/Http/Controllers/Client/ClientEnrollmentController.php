<?php

namespace App\Http\Controllers\Client;

use App\Models\Training;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ClientEnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //  public function index(Request $request)
    //  {
    //      if ($request->ajax()) {
    //          $clientEnrollments = DB::table('training_enrollment')
    //              ->join('trainings', 'training_enrollment.trainingID', '=', 'trainings.trainingID')
    //              ->select([
    //                  'training_enrollment.enrollmentID',
    //                  'trainings.trainingTitle',
    //                  'training_enrollment.enrollStatus',
    //              ])
    //              ->where('training_enrollment.userTag', '=', auth()->user()->userTag)
    //              ->get();
     
    //          return DataTables::of($clientEnrollments)
    //              ->toJson();
    //      }
     
    //      $trainings = Training::all();
    //     return view('client.enrollment.index' ,compact('trainings'));
    //  }

    public function index(Request $request)
    {
        if ($request->ajax()) {
             $clientEnrollments = DB::table('training_enrollment')
                 ->join('training', 'training_enrollment.trainingID', '=', 'training.trainingID')
                 ->select([
                     'training_enrollment.enrollmentID',
                     'training.trainingTitle',
                     'training.trainingDesc',
                     'training.startDateTime',
                     'training.endDateTime',
                     'training.trainingVenue',
                     'training.trainerName',
                     'training_enrollment.enrollStatus',
                 ])
                 ->where('training_enrollment.userTag', '=', auth()->user()->userTag)
                 ->get();
     
             return DataTables::of($clientEnrollments)
                 ->toJson();
        }

        $trainings = Training::all();
        return view('client.enrollment.index' ,compact('trainings'));
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


        // Count the number of enrollments for this training
        $enrollmentsCount = Enrollment::where('trainingID', $request->input('trainingID'))->count();
        $trainingCapacity = Training::where('trainingID', $request->input('trainingID'))->value('trainingCapacity');
        
        if ($enrollmentsCount >= $trainingCapacity) {
                    // The training is at maximum capacity
                    return redirect()->back()->with('error', 'This training is already at its maximum capacity.');
        }
        $existingEnrollment = Enrollment::where('userTag', auth()->user()->userTag)
        ->where('trainingID', $request->input('trainingID'))
        ->first();

        if ($existingEnrollment) {
        // The user has already enrolled in this training
        return redirect()->back()->with('error', 'You have already enrolled in this training.');
    }



    
        $enrollment = new Enrollment();
        $enrollment->enrollmentID = ClientEnrollmentController::generateUniqueEnrollmentID(); // You can generate a unique enrollment ID as per your requirement
        $enrollment->userTag = auth()->user()->userTag; // Assuming you're using user authentication
        $enrollment->trainingID = $request->input('trainingID'); // Assuming you pass 'training_id' from your AJAX request
        $enrollment->applicantName = auth()->user()->name;
        $enrollment->applicantEmail = auth()->user()->email;
        $enrollment->applicantContact = auth()->user()->phoneNo;
        $enrollment->enrollStatus = 'Approved'; // Set the initial status
        
        $enrollment->save();
        

        return redirect()->back()->with('message', 'Training Enrolled Successfully');

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
        Enrollment::whereIn('enrollmentID', $selectedIds)->delete();
    
        return response()->json(['message' => 'Selected records have been deleted successfully.'], 200);
    }


    public function generateUniqueEnrollmentID()
    {
        $prefix = 'EN';
    
        if ($prefix) {
        $unique = false;
        $count = 1;
        
        while (!$unique) {
            $enrollmentID = $prefix . str_pad($count, 3, '0', STR_PAD_LEFT);
            
            if (!Enrollment::where('enrollmentID', $enrollmentID)->exists()) {
                $unique = true;
            }
            
            $count++;
        }

        return $enrollmentID;
        }

        return '';
    }
}
