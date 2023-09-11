<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    public $table = 'announcement';
    public $incrementing = false;
    protected $primaryKey = 'announcementID';

    protected $fillable = [
        'announcementTitle',
        'announcementContent',
        'announcementPic'
    ];
}
