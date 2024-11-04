<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // $clinicInfo = DB::table('clinics')->join('users', 'clinics.id', '=', 'users.clinic_id')->select('clinics.id', 'clinics.name')->where('clinics.id', '=', auth()->user()->clinic_id)->get();
        // $listDoctors = DB::table('users')->join('doctors', 'users.id', '=', 'doctors.user_id')->select('id', 'name')->where('clinic_id', '=', auth()->user()->clinic_id)->get();
        // return view('dashboard', ['clinics' => $clinicInfo, 'doctors' => $listDoctors]);

        $appointments = Appointment::get();

        return view('dashboard', ['appointments' => $appointments]);
    }
}
