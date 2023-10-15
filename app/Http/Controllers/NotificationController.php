<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead()
{
    $user = auth()->user();
    $user->unreadNotifications->markAsRead();
}
}
