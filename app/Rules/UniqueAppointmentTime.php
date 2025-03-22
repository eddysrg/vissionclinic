<?php

namespace App\Rules;

use App\Models\Appointment;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueAppointmentTime implements DataAwareRule, ValidationRule
{
    protected $data = [];

    protected $appointmentId;

    public function __construct($appointmentId = null)
    {
        $this->appointmentId = $appointmentId;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $query = Appointment::where('date', $this->data['date'])->where('time', $value);
        
        if($this->appointmentId) {
            $query->where('id', '!=', $this->appointmentId);
        }

        $appointmentDatetimeExists = $query->exists();

        if($appointmentDatetimeExists) {
            $fail('La hora seleccionada ya está ocupada para este día');
        }
    }

    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }
    
}
