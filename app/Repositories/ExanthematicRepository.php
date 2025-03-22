<?php

namespace App\Repositories;

use App\Interfaces\DashboardRepositoryInterface;
use App\Models\Exanthematic;
use Illuminate\Support\Facades\DB;

class ExanthematicRepository implements DashboardRepositoryInterface
{

    public function create(array $data)
    {
        DB::table('exanthematics')->insert($data);
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
