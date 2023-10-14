<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
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
    public function edit()
    {
        $user = auth()->user();
        return view('my-profile',['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phoneNo' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email,'.$user->id, 
        ]);

        
        

        // Update the user's attributes
        $user->name = $validatedData['name'];
        $user->phoneNo = $validatedData['phoneNo'];
        $user->email = $validatedData['email'];

        // Save the changes
        $user->save();

        // Redirect back with a success message
        return redirect()
        ->route('profile.edit', ['user' => $user])
        ->with('message', 'User details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
