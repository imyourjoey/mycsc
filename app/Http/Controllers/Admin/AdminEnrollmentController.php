<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Training;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Enrollment;

class AdminEnrollmentController extends Controller
{
    public function index(Request $request)
{
    if ($request->ajax()) {
        $enrollments = DB::table('training_enrollment')
            ->join('training', 'training_enrollment.trainingID', '=', 'training.trainingID')
            ->select([
                'training_enrollment.enrollmentID',
                'training.trainingTitle',
                'training_enrollment.applicantName',
                'training_enrollment.applicantEmail',
                'training_enrollment.applicantContact',
                'training_enrollment.userTag',
                'training_enrollment.enrollStatus',
                'training_enrollment.created_at',
                'training_enrollment.updated_at'
            ])
            ->get();

        return DataTables::of($enrollments)->toJson();
    }

    return view('admin.enrollment.index'); // Replace 'enrollment.index' with your actual view name
}


    public function create(){
        $trainings = Training::all();
        $users = User::where('role','client')->get();
        return view('admin.enrollment.create', compact('trainings', 'users'));
    }


    public function store(Request $request){
        $request->validate([
            'trainingTitle' => 'required', 
            'userTag' => 'required'
        ],
        [
            'userTag.required' => 'The Client ID field is required.' // Customize the validation message
        ]);

        // Find the training ID based on the selected training title
        $trainingTitle = $request->trainingTitle;
        $training = Training::where('trainingTitle', $trainingTitle)->first();
        $trainingID = $training->trainingID;


        $enrollmentsCount = Enrollment::where('trainingID', $trainingID)->count();
        $trainingCapacity = Training::where('trainingID',  $trainingID)->value('trainingCapacity');
        
        if ($enrollmentsCount >= $trainingCapacity) {
                    // The training is at maximum capacity
                    return redirect()->back()->with('error', 'This training is already at its maximum capacity.');
        }
        $existingEnrollment = Enrollment::where('userTag', $request->userTag)
        ->where('trainingID', $trainingID)
        ->first();

        if ($existingEnrollment) {
        // The user has already enrolled in this training
        return redirect()->back()->with('error', 'You have already enrolled in this training.');
        }

        // Retrieve applicant information using the usertag
        $user = User::where('userTag', $request->userTag)->first();

        $enrollment = new Enrollment();
        $enrollment->enrollmentID = AdminEnrollmentController::generateUniqueEnrollmentID();
        $enrollment->userTag = $request->userTag;
        $enrollment->trainingID = $trainingID;
        $enrollment->applicantName = $user->name;
        $enrollment->applicantEmail = $user->email;
        $enrollment->applicantContact = $user->phoneNo;
        $enrollment->enrollStatus = 'Approved';
        $enrollment->save();

        return redirect()->back()->with('message', 'Training Program Enrolled Successfully');


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
