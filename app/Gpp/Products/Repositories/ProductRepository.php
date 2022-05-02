<?php
namespace App\Gpp\Products\Repositories;

use App\Gpp\Products\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository
{
    private $model;
    /**
     * Constructeur
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->model = $product;
        return;
    }

    public function findAll(): Collection
    {
        $products = $this->model->get()->sortDesc();
        return $products;
    }

    public function find()
    {
        # code...
    }

    public function save(Array $data)
    {
        try {
            $product = $this->model->create($data);
            $product->packages()->createMany($data['packages']);
            return $product->fresh();
        } catch (QueryException $th) {
            throw $th;
        }
    }

    public function update(Array $data,int $id)
    {
        try {
            $product = $this->model->findOrFail($id);
            $product->update($data);
            $product->removeDiff($data['packages']);
            $packs = $this->setProductId($data['packages'],$id);
            $product->fresh();
            foreach ($packs as $index => $value) {
                $product->packages()->updateOrCreate($value);
            }
            return $product->fresh();
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }

    private function setProductId($data, $product_id): Array
    {
        try {
            $collection = collect($data);

            $result = $collection->map(function ($item, $key) use($product_id) {
                $idex = explode('-',$item['id']);
                if ($idex[0] == 'add') {
                    unset($item['id']);
                }
                unset($item['measure']);
                $item['product_id'] = $product_id;
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
            $product = $this->model->findOrFail($id);
            $product->delete();
            return true;
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }
}
