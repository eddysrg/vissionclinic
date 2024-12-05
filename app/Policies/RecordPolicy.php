<?php

namespace App\Policies;

use App\Models\Patient;
use App\Models\User;

class RecordPolicy
{
    public function viewRecord(User $user, Patient $patient)
    {
        return $patient->doctor_id === $user->id;
    }
}
