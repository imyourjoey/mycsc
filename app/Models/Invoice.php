<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    public $table = 'invoice';
    public $incrementing = false;
    protected $primaryKey = 'invoiceID';

    protected $fillable = [
        'orderID',
        'totalPayable',
        'invoiceDueDate',
        'paymentStatus',
        'paymentAmount',
        'paymentMethod'
    ];
}
