<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    public $table = 'inquiry';
    public $incrementing = false;
    protected $primaryKey = 'inquiryID';

    protected $fillable = [
        'inquiryName',
        'inquiryMessage',
        'inquiryReply',
        'inquiryContactEmail'
    ];
}
