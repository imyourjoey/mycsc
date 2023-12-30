<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Training extends Model
{
    use HasFactory;

    public $table = 'training';
    public $incrementing = false;
    protected $primaryKey = 'trainingID';

    protected $fillable = [
        'trainingTitle',
        'trainingCapacity',
        'trainingDesc',
        'startDateTime',
        'endDateTime',
        'trainerName',
        'regisDeadline'
    ];

    protected $casts = [
        'startDateTime' => 'datetime',
        'endDateTime' => 'datetime',
        'regisDeadline' => 'datetime',
        // ... other fields
    ];

}
