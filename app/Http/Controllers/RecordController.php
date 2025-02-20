<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Http\Request;

class RecordController extends Controller
{

    public function digitalFile($id) 
    {
        $patient = Patient::findOrFail($id);

        $this->authorize('viewRecord', $patient);

        return view('record.digital_file', compact('patient')); 
    }
}
