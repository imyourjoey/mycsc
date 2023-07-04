<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{



    use HasFactory;

    protected $primaryKey = 'inquiryID';


    protected $table = 'inquiry';


    protected $fillable =['inquiryID','clientID','inquiryName','inquiryMessage','inquiryReply','inquiryContactEmail'];

    
}
