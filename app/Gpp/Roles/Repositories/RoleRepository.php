<?php
namespace App\Gpp\Roles\Repositories;

use App\Gpp\Roles\Role;
use App\Gpp\Companies\Company;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Collection;

class RoleRepository
{
    private $role;
    /**
     * Constructeur
     * @return void
     */
    public function __construct(Role $role)
    {
        $this->role = $role;
        return;
    }

    public function companyConnected(): Company
    {
        try {
            return Company::findOrFail(Auth::user()->company_id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // public function myPermissions(Type $var = null)
    // {
    //     # code...
    // }

    public function findAll(): Collection
    {
        try {
            $roles = $this->companyConnected()->roles->sortDesc();
            return $roles;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function find($id): Role
    {
        try {
            $role = $this->role->findOrFail($id);
            return $role;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function save(Array $data)
    {
        try {
            $role = $this->companyConnected()->roles()->create($data);
            $role->permissions()->sync($data['permissions']);
            return $role->fresh();
        } catch (QueryException $th) {
            throw $th;
        }
    }

    public function update(Array $data,int $id)
    {
        try {
            $role = $this->role->findOrFail($id);
            $role->update($data);
            $role->permissions()->sync($data['permissions']);
            return $role->fresh();
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }

    public function destroy($id)
    {
        try {
            $role = $this->role->findOrFail($id);
            $role->delete();
            return true;
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }
}
