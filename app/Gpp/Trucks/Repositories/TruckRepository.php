<?php
namespace App\Gpp\Trucks\Repositories;

use App\Gpp\Trucks\Truck;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Collection;

class TruckRepository
{
    private $model;
    /**
     * Constructeur
     * @return void
     */
    public function __construct(Truck $depot)
    {
        $this->model = $depot;
        return;
    }

    public function findAll()
    {
        if (request('transporter_id') == null) {
            return [];
        }

        $trucks = $this->model->when(request('transporter_id'),function ($query) {
            $query->whereHas('transporter',function ($query)  {
                $query->where('id',request('transporter_id'));
            });
        })
        ->get()->sortDesc();

        return $trucks;
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
