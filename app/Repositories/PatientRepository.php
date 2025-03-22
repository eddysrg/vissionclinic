<?php

namespace App\Repositories;

use App\Interfaces\PatientRepositoryInterface;
use App\Models\MedicalRecord;
use App\Models\PathologicalHistory;
use App\Models\Patient;
use App\Models\Record;
use Illuminate\Support\Facades\DB;

class PatientRepository implements PatientRepositoryInterface
{
    protected $model;

    public function __construct(Patient $patient)
    {
        $this->model = $patient;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function update($id, array $data)
    {
        $this->model->find($id)->update($data);
    }
}
