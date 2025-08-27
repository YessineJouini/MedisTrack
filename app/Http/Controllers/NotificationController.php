<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user(); // get logged-in user

        if (!$user) {
            abort(403, 'Unauthorized');
        }

        $notifications = $user->notifications()->latest()->get(); // all notifications

        return view('notifications.index', compact('notifications'));
    }
}
