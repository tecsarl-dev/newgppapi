<?php
namespace App\Gpp\Companies\Repositories;

use App\Gpp\Communes\Commune;
use Illuminate\Support\Facades\DB;
use App\Gpp\Companies\Company;
use App\Gpp\Districts\District;
use App\Gpp\Localities\Locality;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Collection;
use Rap2hpoutre\FastExcel\Facades\FastExcel;

class CompanyRepository
{
    private $model;
    /**
     * Constructeur
     * @return void
     */
    public function __construct(Company $company)
    {
        $this->model = $company;
        return;
    }

    public function findAll(): Collection
    {
        $companies = $this->model->all()->sortDesc();
        return $companies;
    }

    public function find(int $id)
    {
        try { 
            $companies = $this->model->findOrFail($id);
            return $companies;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function save(Array $data)
    {
        try {
            $company = $this->model->create($data);
            return $company->fresh();
        } catch (QueryException $th) {
            throw $th;
        }
    }
    public function update(Array $data,int $id)
    {
        try {
            $company = $this->model->findOrFail($id);
            $company->update($data);
            return $company->fresh();
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }

    public function destroy($id)
    {
        try {
            $company = $this->model->findOrFail($id);
            $company->delete();
            return true;
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }
}
