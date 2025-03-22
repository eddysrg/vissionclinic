<?php

namespace App\Repositories;

use App\Interfaces\DashboardRepositoryInterface;
use App\Models\Record;

class RecordRepository implements DashboardRepositoryInterface
{
    public function create(array $data)
    {
        return Record::create($data);
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
