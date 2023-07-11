<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //show register/create form
    public function create(){
        return view('admincreateuser');
    }

    //Create New Admin
    public function store(Request $request){

        $highestAdmin = DB::table('admin')
        ->select('adminID')
        ->orderBy('adminID', 'desc')
        ->first();

    if ($highestAdmin) {
        $currentNumber = substr($highestAdmin->adminID, 3);
        $nextNumber = intval($currentNumber) + 1;
        $nextAdminID = 'AD_' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
    } else {
        $nextAdminID = 'AD_00001';
    }


        $request->validate([
            'role' => ['required'],
            'adminUsername' => ['required', Rule::unique('admin','adminUsername')],
            'adminName' => ['required'],
            'adminPhone' => ['required'],
            'adminEmail' => ['required'],
            'adminPassword' => 'required|confirmed',
            'adminPassword_confirmation' =>'required'
        ]);
        
        //hash password
        $request['adminPassword']= bcrypt($request['adminPassword']);

        DB::table('admin')->insert([
            'adminID' => $nextAdminID,
            'adminUsername' => $request->input('adminUsername'),
            'adminName' => $request->input('adminName'),
            'adminPhone' => $request->input('adminPhone'),
            'adminEmail' => $request->input('adminEmail'),
            'adminPassword' => $request->input('adminPassword'),
            
        ]);

        return redirect()->back()->with('message', 'New admin account created!');
    }


    //authenticate admin
    public function authenticate(Request $request) {

        $request->validate([
            'adminUsername' => ['required'],
            'adminPassword' => ['required']
        ]);

    $credentials = $request->only('adminUsername', 'adminPassword');

    $admin = Admin::where('adminUsername', $credentials['adminUsername'])->first();

    if ($admin && password_verify($credentials['adminPassword'], $admin->adminPassword)) {
        // Authentication successful
        auth()->login($admin);

        $today = date('Y-m-d');
        $inquiryCount = DB::table('inquiry')->whereDate('created_at', $today)->count();

        session(['inquiryCount' => $inquiryCount]);
        session(['admin' => $admin]);

        
        return redirect('admindash')->with('message','Logged in successfully');

        
    }

    // Authentication failed
    return redirect('adminlogin')->with('warning', 'Login unsuccessful. Try again with correct credentials');
}
public function logout(){
    auth()->logout();

    return redirect('adminlogin')->with('message','Logged out successfully');
}





}
