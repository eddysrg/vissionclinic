<?php

namespace App\Livewire\Forms;

use Closure;
use Livewire\Form;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;

class PatientForm extends Form
{
    public $medical_unit_id;

    public $name;

    #[Validate]
    public $last_name; 

    public $gender;

    public $birthdate; 

    public $birthplace;

    public $phone_number;

    public $curp;

    public $patientId;


    protected function rules()
    {
        return [
            'medical_unit_id' => 'required|numeric',
            'name' => 'required|string',
            'last_name' => [
                'required',
                'string',
                function (string $attribute, mixed $value, Closure $fail) {
                    $words = explode(' ', $value);

                    if(count($words) != 2) {
                        $fail('Debe colocar sus apellidos completos');
                    }
                },
            ],
            'gender' => 'required|in:Hombre,Mujer',
            'birthdate' => 'required|date',
            'birthplace' => 'required|string',
            'phone_number' => 'required|string|min:10',
            'curp' => ['required', 'min:18', Rule::unique('patients', 'curp')->ignore($this->patientId)],
        ];
    }

    protected function messages() {
        return [
            'curp.unique' => 'El CURP introducido ya se encuentra registrado',
        ];
    }
}
