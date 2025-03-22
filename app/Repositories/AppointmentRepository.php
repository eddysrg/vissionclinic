<?php 
namespace App\Repositories;

use App\Interfaces\DashboardRepositoryInterface;
use App\Models\Appointment;

class AppointmentRepository implements DashboardRepositoryInterface
{

    protected $model;

    public function __construct(Appointment $appointment)
    {
        $this->model = $appointment;
    }

    public function create(array $data)
    {
        $this->model->create($data);
    }

    public function all()
    {

    }

    public function update($id, array $data)
    {
        $this->model->find($id)->update($data);
    }
}