<?php

namespace App\Repositories;

use App\Interfaces\DashboardRepositoryInterface;
use App\Models\MedicalRecord;

class MedicalRecordRepository implements DashboardRepositoryInterface
{

    public function create(array $data)
    {
        return MedicalRecord::create($data);
    }

    public function all()
    {
        // TODO: Implement all() method.
    }

    public function update($id, array $data)
    {
        // TODO: Implement update() method.
    }
}
