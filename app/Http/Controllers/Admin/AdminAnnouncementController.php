<?php

namespace App\Http\Controllers\Admin;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminAnnouncementController extends Controller
{
    public function index(Request $request)
{
    if ($request->ajax()) {
        $announcements = DB::table('announcement')
            ->select([
                'announcement.announcementID',
                'users.name as adminName', // Assuming you have a 'name' column in the 'users' table
                'announcement.announcementTitle',
                'announcement.announcementContent',
                'announcement.announcementPic',
                'announcement.created_at',
                'announcement.updated_at',
            ])
            ->leftJoin('users', 'announcement.userTag', '=', 'users.userTag')
            ->get();

        return DataTables::of($announcements)->toJson();
    }

    return view('announcement.index'); // Replace 'announcement.index' with your actual view name
}


    public function create(){
        return view('announcement.create');
    }

    public function store(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:100000', 
    ]);

    // Create a new Announcement model instance and fill it with the validated data
    $announcement = new Announcement();
    $announcement->announcementID = AdminAnnouncementController::generateUniqueAnnouncementID(); // You can define a function to generate a unique ID
    $announcement->userTag = auth()->user()->userTag; // Replace with the actual userTag
    $announcement->announcementTitle = $request->input('title');
    $announcement->announcementContent = $request->input('description');

    // Handle image upload if an image is provided
    if ($request->hasFile('picture')) {
        $imgPath = $request->file('picture')->store('announcements', 'public');
        $announcement->announcementPic = $imgPath;
    }

    // Save the announcement to the database
    $announcement->save();

    // Redirect back with a success message
    return redirect()->back()->with('message', 'Announcement created successfully!');
}

public function edit(Announcement $announcement)
    {
        // $user = User::findOrFail($id);
        // return view('user.update', compact('user'));
        return view('announcement.edit', ['announcement' => $announcement]);
    }


    public function update(Request $request, Announcement $announcement)
{
    // Validate the form data
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // You can adjust the image validation rules
    ]);

    // Update the announcement's attributes
    $announcement->announcementTitle = $validatedData['title'];
    $announcement->announcementContent = $validatedData['description'];

    // Handle image upload if a new image is provided
    if ($request->hasFile('picture')) {
        // Store the new image and update the announcement's image path
        $imgPath = $request->file('picture')->store('announcements', 'public');
        $announcement->announcementPic = $imgPath;
    }

    // Save the changes
    $announcement->save();

    // Redirect back with a success message
    return redirect()->route('announcement.edit', ['announcement' => $announcement])
        ->with('message', 'Announcement details updated successfully.');
}

public function destroy(Request $request)
{
    $selectedIds = $request->input('selectedIds');
    
    // Ensure selectedIds is an array and not empty
    if (!is_array($selectedIds) || count($selectedIds) === 0) {
        return response()->json(['message' => 'No records selected for deletion.'], 400);
    }

    // Delete the selected records from the database
    Announcement::whereIn('announcementID', $selectedIds)->delete();

    return response()->json(['message' => 'Selected records have been deleted successfully.'], 200);
}


public function generateUniqueAnnouncementID()
{
    $prefix = 'TR';

    if ($prefix) {
        $unique = false;
        $count = 1;

        while (!$unique) {
            $announcementID = $prefix . str_pad($count, 3, '0', STR_PAD_LEFT);

            if (!Announcement::where('announcementID', $announcementID)->exists()) {
                $unique = true;
            }

            $count++;
        }

        return $announcementID;
    }

    return '';
}

}
