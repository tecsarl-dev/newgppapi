<?php
namespace App\Gpp\LoadingSlips\Repositories;

use App\Gpp\LoadingSlips\LoadingSlip;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Collection;

class LoadingSlipRepository
{
    private $model;
    /**
     * Constructeur
     * @return void
     */
    public function __construct(LoadingSlip $loadingSlip)
    {
        $this->model = $loadingSlip;
        return;
    }

    public function findAll(): Collection
    {
        $loadingSlips = $this->model->get()->sortDesc();
        return $loadingSlips;
    }

    public function find()
    {
        # code...
    }

    public function save(Array $data)
    {
        try {
            $loadingSlip = $this->model->create($data);
            return $loadingSlip->fresh();
        } catch (QueryException $th) {
            throw $th;
        }
    }

    public function update(Array $data,int $id)
    {
        try {
            $loadingSlip = $this->model->findOrFail($id);
            $loadingSlip->update($data);
            return $loadingSlip->fresh();
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }

    public function destroy($id)
    {
        try {
            $loadingSlip = $this->model->findOrFail($id);
            $loadingSlip->delete();
            return true;
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }
}
