<?php
namespace App\Gpp\Users\Repositories;

use App\Gpp\Users\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    private $model;
    /**
     * Constructeur
     * @return void
     */
    public function __construct(User $user)
    {
        $this->model = $user;
        return;
    }

    public function findAll()
    {
        return [];
    }

    public function find()
    {
        # code...
    }

    public function save(Array $data)
    {
        try {
            $user = $this->model->create($data);
            return $user->fresh();
        } catch (QueryException $th) {
            throw $th;
        }
    }

    public function update(Array $data,int $id)
    {
        try {
            $user = $this->model->findOrFail($id);
            $user->update($data);
            return $user->fresh();
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }

    public function destroy($id)
    {
        try {
            $user = $this->model->findOrFail($id);
            $user->delete();
            return true;
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }
}
