<?php
namespace App\Gpp\Communes\Repositories;

use App\Gpp\Communes\Commune;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Collection;

class CommuneRepository
{
    private $model;
    /**
     * Constructeur
     * @return void
     */
    public function __construct(Commune $commune)
    {
        $this->model = $commune;
        return;
    }

    public function findAll(): Collection
    {
        $communes = $this->model->get()->sortDesc();
        return $communes;
    }

    public function findBySearch($search): Collection
    {
        $communes = $this->model->where('name','like',"%$search%")->orderBy('name','asc')->get();
        return $communes;
    }

    public function find()
    {
        # code...
    }

    public function save(Array $data)
    {
        try {
            $commune = $this->model->create($data);
            return $commune->fresh();
        } catch (QueryException $th) {
            throw $th;
        }
    }

    public function update(Array $data,int $id)
    {
        try {
            $commune = $this->model->findOrFail($id);
            $commune->update($data);
            return $commune->fresh();
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }


    public function destroy($id)
    {
        try {
            $commune = $this->model->findOrFail($id);
            $commune->delete();
            return true;
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }
}
