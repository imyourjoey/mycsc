<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public $table = 'service';
    public $incrementing = false;
    protected $primaryKey = 'serviceID';

    protected $fillable = [
        'serviceName',
        'serviceDesc',
        'servicePic',
        'serviceEstDuration'
    ];
}
