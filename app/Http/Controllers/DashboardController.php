<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\DashboardNotification;

class DashboardController extends Controller
{
    public function index()
    {
        $appointments = Appointment::whereDate('date', Carbon::now()->format('Y-m-d'))->whereHas('patient', function ($query) {
            $query->where('clinic_id', auth()->user()->clinic_id);
        })->get();

        $user = Auth::user();
        $currentDate = Carbon::today();
        $notifications = $user->notifications()
                              ->whereDate('created_at', $currentDate)
                              ->get();
        return view('dashboard', ['appointments' => $appointments, 'notifications' => $notifications]);
    }
}
