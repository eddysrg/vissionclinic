<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Appointment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $appointments = Appointment::whereDate('date', Carbon::now()->format('Y-m-d'))->whereHas('patient', function ($query) {
            $query->where('clinic_id', auth()->user()->clinic_id);
        })->get();

        return view('dashboard', ['appointments' => $appointments]);
    }
}
