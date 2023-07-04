<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'client';

    protected $fillable = [
        'clientUsername',
        'clientName',
        'clientPhone',
        'clientEmail',
        'clientPassword'
    ];
}
