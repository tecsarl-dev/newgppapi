<?php
namespace App\Gpp\Departments\Repositories;

use App\Gpp\Departments\Department;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Collection;

class DepartmentRepository
{
    private $model;
    /**
     * Constructeur
     * @return void
     */
    public function __construct(Department $department)
    {
        $this->model = $department;
        return;
    }

    public function findAll(): Collection
    {
        $departments = $this->model->all()->sortDesc();
        return $departments;
    }

    public function find()
    {
        # code...
    }

    public function save(Array $data)
    {
        try {
            $department = $this->model->create($data);
            return $department->fresh();
        } catch (QueryException $th) {
            throw $th;
        }
    }

    public function update(Array $data,int $id)
    {
        try {
            $department = $this->model->findOrFail($id);
            $department->update($data);
            return $department->fresh();
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }

    public function destroy($id)
    {
        try {
            $department = $this->model->findOrFail($id);
            $department->delete();
            return true;
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }
}
