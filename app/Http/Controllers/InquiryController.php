<?php

namespace App\Http\Controllers;

use session;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;




class InquiryController extends Controller
{
    
    //store inquiry data
    public function store(Request $request){


        $highestInquiry = DB::table('inquiry')
        ->select('inquiryID')
        ->orderBy('inquiryID', 'desc')
        ->first();

    if ($highestInquiry) {
        $currentNumber = substr($highestInquiry->inquiryID, 3);
        $nextNumber = intval($currentNumber) + 1;
        $nextInquiryId = 'IR_' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
    } else {
        $nextInquiryId = 'IR_00001';
    }

        $request->validate([
            'inquiryName' => 'required',
            'inquiryContactEmail' => 'required',
            'inquiryMessage' => 'required'
        ]);

        DB::table('inquiry')->insert([
            'inquiryID' => $nextInquiryId,
            'inquiryContactEmail' => $request->input('inquiryContactEmail'),
            'inquiryName' => $request->input('inquiryName'),
            'inquiryMessage' => $request->input('inquiryMessage')
        ]);

        return redirect('/')->with('message','Inquiry created successfully');
        
}


public function showDataTable()
{
    $inquiries = DB::table('inquiry')
    ->select('inquiryID', 'inquiryName', 'inquiryMessage' ,'inquiryReply', 'inquiryContactEmail' ,'created_at', 'updated_at')
    ->get();

    $inquiries= DB::table('inquiry')->paginate(10);
    
    return view('inquirydatatable', compact('inquiries'));
}

    //delete inquiry
    public function destroy(Inquiry $inquiry){

        $inquiry->delete();

        return redirect()->back()->with('message', 'inquiry deleted successfully');
    }

    //show edit form
    public function edit($inquiryID){
    $inquiry = DB::table('inquiry')->where('inquiryID', $inquiryID)->first();

    if (!$inquiryID) {
        return redirect('/inquirydatatable')->with('error', 'inquiry');
    }

    return view('inquiryupdate', compact('inquiry'));
    }   


    public function update(Request $request, $inquiryID){
    $request->validate([
        'inquiryID' => 'required',
        'inquiryMessage' => 'required',
        'inquiryName' => 'required'
    ]);

    DB::table('inquiry')->where('inquiryID', $inquiryID)->update([
        'inquiryID' => $request->input('inquiryID'),
        'inquiryName'=>$request->input('inquiryName'),
        'inquiryMessage'=>$request->input('inquiryMessage'),
        'inquiryReply'=>$request->input('inquiryReply'),
        'inquiryContactEmail'=>$request->input('inquiryContactEmail'),
    ]);

    return redirect('/inquirydatatable')->with('message', 'inquiry updated successfully');
    }

    public function view(Request $request, $inquiryID){
       
    
        $inquiry = DB::table('inquiry')->where('inquiryID', $inquiryID)->first();
    
        return view('inquiryview', compact('inquiry'));
        }
    
   
}