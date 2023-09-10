<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    public $table = 'feedback';
    public $incrementing = false;
    protected $primaryKey = 'feedbackID';

    protected $fillable = [
        'feedbackMessage',
        'feedbackRating'
    ];
}
