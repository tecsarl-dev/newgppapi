<?php
namespace App\Gpp\Stations\Repositories;

use App\Gpp\Stations\Station;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Collection;

class StationRepository
{
    private $model;
    /**
     * Constructeur
     * @return void
     */
    public function __construct(Station $station)
    {
        $this->model = $station;
        return;
    }

    public function findAll(): Collection
    {
        $stations = $this->model->get()->sortDesc();
        return $stations;
    }

    public function find()
    {
        # code...
    }

    public function save(Array $data)
    {
        try {
            $station = $this->model->create($data);
            return $station->fresh();
        } catch (QueryException $th) {
            throw $th;
        }
    }

    public function update(Array $data,int $id)
    {
        try {
            $station = $this->model->findOrFail($id);
            $station->update($data);
            return $station->fresh();
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }

    public function destroy($id)
    {
        try {
            $station = $this->model->findOrFail($id);
            $station->delete();
            return true;
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }
}
