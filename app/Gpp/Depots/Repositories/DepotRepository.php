<?php
namespace App\Gpp\Depots\Repositories;

use App\Gpp\Depots\Depot;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Collection;

class DepotRepository
{
    private $model;
    /**
     * Constructeur
     * @return void
     */
    public function __construct(Depot $depot)
    {
        $this->model = $depot;
        return;
    }

    public function findAll(): Collection
    {
        $depots = $this->model->get()->sortDesc();
        return $depots;
    }

    public function find()
    {
        # code...
    }

    public function save(Array $data)
    {
        try {
            $depot = $this->model->create($data);
            return $depot->fresh();
        } catch (QueryException $th) {
            throw $th;
        }
    }

    public function update(Array $data,int $id)
    {
        try {
            $depot = $this->model->findOrFail($id);
            $depot->update($data);
            return $depot->fresh();
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }

    public function destroy($id)
    {
        try {
            $depot = $this->model->findOrFail($id);
            $depot->delete();
            return true;
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }
}
