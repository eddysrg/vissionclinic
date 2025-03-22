<?php

namespace App\Repositories;

use App\Interfaces\DashboardRepositoryInterface;
use Illuminate\Support\Facades\DB;

class OtherHistoryRepository implements DashboardRepositoryInterface
{

    public function create(array $data)
    {
        DB::table('other_histories')->insert($data);
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
