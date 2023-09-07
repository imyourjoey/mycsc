<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    public $table = 'invoice';

    protected $fillable = [
        'orderID',
        'totalPayable',
        'invoiceDueDate',
        'paymentStatus',
        'paymentAmount',
        'paymentMethod'
    ];
}
