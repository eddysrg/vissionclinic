<?php 

namespace App\Interfaces;

interface PatientRepositoryInterface
{
    public function create(array $data);
    public function all();
    public function update($id, array $data);
}