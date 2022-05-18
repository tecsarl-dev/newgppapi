<?php
namespace App\Gpp\LoadingSlips\Repositories;

use App\Gpp\LoadingSlips\LoadingSlip;
use App\Http\Resources\LoadingSlipCollection;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

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

    public function findAll()
    {
        $result = $this->model->when(request('s'),function($query) {
            $query->where('loading_slips.loading_number','like',"%".request('s')."%");
        });

        if (request('s')) {
            return $result->get()->sortDesc();
        } else {
            return $result->get()->sortDesc();
        }
    }

    public function find($id)
    {
        try { 
            $loadingSlip = $this->model->findOrFail($id);
            $loadingSlip->loading_type = json_decode($loadingSlip->loading_type);
            return $loadingSlip;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function save(Array $data)
    {
        try {
            $data["loading_type"] = json_encode($data["loading_type"]);
            $loadingSlip = $this->model->create($data);
            $loadingSlip->listProducts()->createMany($data['list_products']);
            return $loadingSlip->fresh();
        } catch (QueryException $th) {
            throw $th;
        }
    }

    public function update(Array $data,int $id)
    {
        try {
            $loadingSlip = $this->model->findOrFail($id);
            $data["loading_type"] = json_encode($data["loading_type"]);
            $loadingSlip->update($data);
            $loadingSlip->removeDiff($data['list_products']);
            $productl = $this->setLoadingId($data['list_products'],$id);

            foreach ($productl as $index => $value) {
                $loadingSlip->listProducts()->updateOrCreate($value);
            }
            return $loadingSlip->fresh();
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }

    private function setLoadingId($data, $loadingSlipId): Array
    {
        try {
            $collection = collect($data);
            $result = $collection->map(function ($item, $key) use($loadingSlipId) {
                $idex = explode('-',$item['id']);
                if ($idex[0] == 'add') {
                    unset($item['id']);
                    $item['loading_slip_id'] = $loadingSlipId;
                }
                return $item;
            });

            return $result->toArray();
        } catch (\Throwable $th) {
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
