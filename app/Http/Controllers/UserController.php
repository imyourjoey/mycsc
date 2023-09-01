<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;


class UserController extends Controller
{
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
            $users = User::query();

            return DataTables::of($users)
                ->addColumn('action', function ($user) {
                    // Add action buttons if needed
                    return '<button>Edit</button>';
                })
                ->make(true);
        }

        return view('user.index');
    }


}



