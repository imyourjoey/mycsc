<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;


class UserController extends Controller
{


    public function showCreate(){
        return view('user.create');
    }


    public function create(Request $request)
    {
        $request->validate([
            'role' => 'required|in:client,technician,admin',
            'username' => 'required|unique:users,username',
            'name' => 'required',
            'phoneNo' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = new User();
        $user->role = $request->role;
        $user->username = $request->username;
        $user->name = $request->name;
        $user->phoneNo = $request->phoneNo;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();



        return redirect()->route('admin.index')->with('message', 'User created successfully!');
    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::select(['id', 'name', 'email', 'created_at', 'updated_at']);
            
            return DataTables::of($users)->toJson();
        }
    
        return view('user.index'); 

    }

    public function showUpdate($id)
    {
        $user = User::findOrFail($id);
        return view('user.update', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phoneNo' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email,'.$id, // Unique rule, but exclude the current user's email
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update the user's attributes
        $user->name = $validatedData['name'];
        $user->phoneNo = $validatedData['phoneNo'];
        $user->email = $validatedData['email'];

        // Save the changes
        $user->save();

        // Redirect back with a success message
        return redirect()->route('user.index', ['id' => $id])->with('message', 'User details updated successfully');
    }


    // public function destroy(Request $request)
    // {
    //     $ids = $request->input('ids');
    
    //     // Assuming your user model is named 'User'
    //     User::whereIn('id', $ids)->delete();
    
    //     return response()->json(['message' => 'Users deleted successfully']);
    // }

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



