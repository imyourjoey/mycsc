<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $table = 'order';

    protected $fillable = [
        'clientTag',
        'serviceID',
        'technicianTag',
        'deviceType',
        'hardwareManufacturer',
        'partNo',
        'serialNo',
        'diskCapacity',
        'capacityRestored',
        'othersIncluded',
        'orderStatus',
        'orderStatusPic',
        'orderRemarks'
    ];
}
