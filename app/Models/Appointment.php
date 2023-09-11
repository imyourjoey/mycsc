<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{

    use HasFactory;
    

    public $table = 'appointment';

    public $incrementing = false;
    protected $primaryKey = 'appointmentID';
    
    protected $fillable = [
        'appointmentID',
        'clientID',
        'appointmentDateTime',
        'appointmentStatus',
        'remarks',
        'created_at',
        'updated_at'
    ];
}
