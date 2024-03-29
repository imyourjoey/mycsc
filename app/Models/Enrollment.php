<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    public $table = 'training_enrollment';

    public $incrementing = false;
    protected $primaryKey = 'enrollmentID';

    protected $fillable = [
        'trainingID',
        'applicantName',
        'announcementPic',
        'applicantEmail',
        'applicantContact',
        'enrollStatus'
    ];
}
