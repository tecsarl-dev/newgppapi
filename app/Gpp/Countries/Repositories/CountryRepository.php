<?php
namespace App\Gpp\Departments\Repositories;

use App\Gpp\Communes\Commune;
use Illuminate\Support\Facades\DB;
use App\Gpp\Departments\Department;
use App\Gpp\Districts\District;
use App\Gpp\Localities\Locality;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Collection;
use Rap2hpoutre\FastExcel\Facades\FastExcel;

class CountryRepository
{
    private $model;
    /**
     * Constructeur
     * @return void
     */
    public function __construct(Department $country)
    {
        $this->model = $country;
        return;
    }

    public function findAll(): Collection
    {
        $countries = $this->model->all()->sortDesc();
        return $countries;
    }

    public function find()
    {
        # code...
    }

    public function save(Array $data)
    {
        try {
            $country = $this->model->create($data);
            return $country->fresh();
        } catch (QueryException $th) {
            throw $th;
        }
    }

    public function update(Array $data,int $id)
    {
        try {
            $country = $this->model->findOrFail($id);
            $country->update($data);
            return $country->fresh();
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }

    public function destroy($id)
    {
        try {
            $country = $this->model->findOrFail($id);
            $country->delete();
            return true;
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }
}
