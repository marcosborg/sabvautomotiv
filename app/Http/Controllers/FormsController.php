<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\ContactNotification;
use Illuminate\Support\Facades\Notification;

use Illuminate\Http\Request;

class FormsController extends Controller
{
    public function contact(Request $request)
    {

        Notification::route('mail', 'info@sabvautomotive.com')
            ->notify(new ContactNotification($request));
    }
}
