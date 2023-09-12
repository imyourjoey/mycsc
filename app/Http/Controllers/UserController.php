<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;


class UserController extends Controller
{


    public function generateUniqueUserTag($role)
{
    $prefix = '';

    switch ($role) {
        case 'client':
            $prefix = 'CL';
            break;
        case 'admin':
            $prefix = 'AD';
            break;
        case 'technician':
            $prefix = 'TE';
            break;
        default:
            // Handle other roles or throw an error
            break;
    }

    if ($prefix) {
        $unique = false;
        $count = 1;
        
        while (!$unique) {
            $userTag = $prefix . str_pad($count, 3, '0', STR_PAD_LEFT);
            
            if (!User::where('userTag', $userTag)->exists()) {
                $unique = true;
            }
            
            $count++;
        }

        return $userTag;
    }

    return abort(422, 'Please Try again later');
}


    public function create(){
        return view('user.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'role' => 'required|in:client,technician,admin',
            'phoneNo' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ],
        [
            // 'phoneNo.required' => 'The phone number field is required'
        ]);

        $userTag = UserController::generateUniqueUserTag($request->role);

        $user = new User();
        $user->name = $request->name;
        $user->userTag = $userTag;
        $user->role = $request->role;
        $user->phoneNo = $request->phoneNo;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();



        return redirect()->back()->with('message', 'User created successfully!');
    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::select(['userTag', 'name', 'email', 'phoneNo', 'role',  'created_at', 'updated_at']);
            
            return DataTables::of($users)->toJson();
        }
    
        return view('user.index'); 

    }

    public function edit(User $user)
    {
        return view('user.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phoneNo' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email,'.$user->id, // Unique rule, but exclude the current user's email
        ]);

        
        

        // Update the user's attributes
        $user->name = $validatedData['name'];
        $user->phoneNo = $validatedData['phoneNo'];
        $user->email = $validatedData['email'];

        // Save the changes
        $user->save();

        // Redirect back with a success message
        return redirect()->route('user.index', ['user' => $user])->with('message', 'User details updated successfully');
    }



    public function destroy(Request $request)
{
    $selectedIds = $request->input('selectedIds');
    
    // Ensure selectedIds is an array and not empty
    if (!is_array($selectedIds) || count($selectedIds) === 0) {
        return response()->json(['message' => 'No records selected for deletion.'], 400);
    }

    // Delete the selected records from the database
    User::whereIn('id', $selectedIds)->delete();

    return response()->json(['message' => 'Selected records have been deleted successfully.'], 200);
}






}
