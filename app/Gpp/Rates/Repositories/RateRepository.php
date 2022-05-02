<?php
namespace App\Gpp\Rates\Repositories;

use App\Gpp\Rates\Rate;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Collection;

class RateRepository
{
    private $model;
    /**
     * Constructeur
     * @return void
     */
    public function __construct(Rate $rate)
    {
        $this->model = $rate;
        return;
    }

    public function findAll(): Collection
    {
        $rates = $this->model->get()->sortDesc();
        return $rates;
    }

    public function find()
    {
        # code...
    }

    public function save(Array $data)
    {
        try {
            $rate = $this->model->create($data);
            return $rate->fresh();
        } catch (QueryException $th) {
            throw $th;
        }
    }

    public function update(Array $data,int $id)
    {
        try {
            $rate = $this->model->findOrFail($id);
            $rate->update($data);
            return $rate->fresh();
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }

    public function destroy($id)
    {
        try {
            $rate = $this->model->findOrFail($id);
            $rate->delete();
            return true;
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }
}
