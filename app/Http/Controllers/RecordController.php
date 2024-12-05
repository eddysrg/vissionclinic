<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function records()
    {
        return view('record.records');
    }

    public function show($id)
    {
        $patient = Patient::findOrFail($id);

        $this->authorize('viewRecord', $patient);

        return view('record.show', compact('patient'));
    }

    public function summary($id)
    {
        $patient = Patient::findOrFail($id);

        $this->authorize('viewRecord', $patient);

        return view('record.summary', compact('patient'));
    }

    public function medicalRecord($id)
    {
        $patient = Patient::findOrFail($id);

        $this->authorize('viewRecord', $patient);
        return view('record.medical-record', compact('patient'));
    }

    public function identificationCard($id)
    {
        $patient = Patient::findOrFail($id);

        $this->authorize('viewRecord', $patient);
        return view('record.medical_record.identification-card', compact('patient'));
    }

    public function familyMedicalHistory($id)
    {
        $patient = Patient::findOrFail($id);

        $this->authorize('viewRecord', $patient);
        return view('record.medical_record.family_medical_history', compact('patient'));
    }

    public function pathologicalHistory($id)
    {
        $patient = Patient::findOrFail($id);

        $this->authorize('viewRecord', $patient);
        return view('record.medical_record.pathological_history', compact('patient'));
    }

    public function noPathologicalHistory($id)
    {
        $patient = Patient::findOrFail($id);

        $this->authorize('viewRecord', $patient);
        return view('record.medical_record.no_pathological_history', compact('patient'));
    }
}
