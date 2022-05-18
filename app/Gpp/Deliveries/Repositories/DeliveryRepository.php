<?php
namespace App\Gpp\Deliveries\Repositories;

use App\Gpp\Deliveries\Delivery;
use App\Http\Resources\DeliveryCollection;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Collection;

class DeliveryRepository
{
    private $model;

    public function __construct(Delivery $delivery)
    {
        $this->model = $delivery;
        return;
    }

    public function findAll()
    {
        $result = $this->model->when(request('s'),function($query) {
            $query->where('deliveries.delivery_number','like',"%".request('s')."%");
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
            $delivery = $this->model->findOrFail($id);
            $delivery->loading_type = json_decode($delivery->loading_type);
            return $delivery;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function save(Array $data)
    {
        try {
            $delivery = $this->model->create($data);
            $delivery->listProducts()->createMany($data['list_products']);
            return $delivery->fresh();
        } catch (QueryException $th) {
            throw $th;
        }
    }

    public function update(Array $data,int $id)
    {
        try {
            $delivery = $this->model->findOrFail($id);
            $delivery->update($data);
            $delivery->removeDiff($data['list_products']);
            $productl = $this->setLoadingId($data['list_products'],$id);

            foreach ($productl as $index => $value) {
                $delivery->listProducts()->updateOrCreate($value);
            }
            return $delivery->fresh();
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }

    private function setLoadingId($data, $deliveryId): Array
    {
        try {
            $collection = collect($data);
            $result = $collection->map(function ($item, $key) use($deliveryId) {
                $idex = explode('-',$item['id']);
                if ($idex[0] == 'add') {
                    unset($item['id']);
                    $item['delivery_id'] = $deliveryId;
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
            $delivery = $this->model->findOrFail($id);
            $delivery->delete();
            return true;
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }
}
