<?php

namespace App\Repositories;

use App\Interfaces\DashboardRepositoryInterface;
use App\Models\PathologicalHistory;

class PathologicalHistoryRepository implements DashboardRepositoryInterface
{

    public function create(array $data)
    {
        return PathologicalHistory::create($data);
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
