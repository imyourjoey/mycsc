<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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
}
