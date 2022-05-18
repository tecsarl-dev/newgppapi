<?php
namespace App\Gpp\Permissions\Repositories;

use App\Gpp\Permissions\Permission;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Collection;

class PermisisonRepository
{
    private $model;
 
    public function __construct(Permission $permission)
    {
        $this->model = $permission;
        return;
    }

    public function findAll(): Collection
    {
        $permissions = $this->model->get()->sortDesc();
        return $permissions;
    }

    public function find()
    {
        # code...
    }

    public function save(Array $data)
    {
        try {
            $permission = $this->model->create($data);
            return $permission->fresh();
        } catch (QueryException $th) {
            throw $th;
        }
    }

    public function update(Array $data,int $id)
    {
        try {
            $permission = $this->model->findOrFail($id);
            $permission->update($data);
            return $permission->fresh();
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }

    public function destroy($id)
    {
        try {
            $permission = $this->model->findOrFail($id);
            $permission->delete();
            return true;
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }
}
