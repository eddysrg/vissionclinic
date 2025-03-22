<?php

namespace App\Livewire\Forms;

use App\Models\Appointment;
use App\Rules\UniqueAppointmentTime;
use Livewire\Attributes\Validate;
use Livewire\Form;

class AppointmentForm extends Form
{
    public $date;

    public $time;

    public $type;

    public $comments;

    public $status;

    public $patient_id;

    public $doctor_id;

    public $appointmentId;

    protected function rules()
    {
        return [
            'date' => 'required|date',
            'time' => ['required', 'date_format:H:i', new UniqueAppointmentTime($this->appointmentId)],
            'type' => 'required|in:chronic,healthy,planning,communicable_diseases,other_diseases,pregnancy_control,nutritional_control',
            'comments' => 'required',
            'status' => 'required|in:confirm,unconfirm',
            'patient_id' => 'required|numeric',
            'doctor_id' => 'required|numeric',
        ];
    }
}
