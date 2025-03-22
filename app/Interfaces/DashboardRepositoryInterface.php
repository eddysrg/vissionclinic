<?php
namespace App\Interfaces;

/* All CRUD for different dashboard models */

interface DashboardRepositoryInterface
{
    public function create(array $data);
    public function all();
    public function update($id, array $data);
}