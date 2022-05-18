<?php
namespace App\Gpp\Features\Repositories;

use App\Gpp\Companies\Company;
use App\Gpp\Features\Feature;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Collection;

class FeatureRepository
{
    private $model;
 
    public function __construct(Feature $feature)
    {
        $this->model = $feature;
        return;
    }

    public function findAll(): Collection
    {
        $companyConnected = Company::find(request()->user()->company_id)->first("type_company");
        
        if ($companyConnected->type_company === 'super-c') {
            $features = $this->model->orderBy("name", "asc")->get();
            return $features;
        }
        
        $features = $this->model->whereTypeCompany("all")->orWhere("type_company",$companyConnected->type_company)->orderBy("name", "asc")->get();
        return $features;
    }

    public function find()
    {
        # code...
    }

    public function save(Array $data)
    {
        try {
            $feature = $this->model->create($data);
            return $feature->fresh();
        } catch (QueryException $th) {
            throw $th;
        }
    }

    public function update(Array $data,int $id)
    {
        try {
            $feature = $this->model->findOrFail($id);
            $feature->update($data);
            return $feature->fresh();
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }

    public function destroy($id)
    {
        try {
            $feature = $this->model->findOrFail($id);
            $feature->delete();
            return true;
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }
}
