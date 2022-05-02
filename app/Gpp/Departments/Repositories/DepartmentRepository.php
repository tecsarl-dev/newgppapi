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

class DepartmentRepository
{
    private $model;
    /**
     * Constructeur
     * @return void
     */
    public function __construct(Department $department)
    {
        $this->model = $department;
        return;
    }

    public function findAll(): Collection
    {
        $departments = $this->model->all()->sortDesc();
        return $departments;
    }

    public function find()
    {
        # code...
    }

    public function save(Array $data)
    {
        try {
            $department = $this->model->create($data);
            return $department->fresh();
        } catch (QueryException $th) {
            throw $th;
        }
    }

    public function importFile(string $file)
    {
        try {
            DB::beginTransaction();
            $departments = FastExcel::import(storage_path('/app/public/imports/'.$file),function($line){
                $department =  Department::firstOrCreate([
                    "name" => strtolower($line["Departements"]),
                ]);

                $commune = Commune::firstOrCreate([
                    "name" => strtolower($line["Communes"]),
                    "department_id" =>$department->id,
                ]);

                $district = District::firstOrCreate([
                    "code" => strtolower($line["Arrondissements"]).'-'.$commune->id,
                    "name" => strtolower($line["Arrondissements"]),
                    "commune_id" =>$commune->id,
                ]);

                $dataLocality = explode(',', $line["Villages ou quartiers de ville"]);

                foreach ($dataLocality as $key => $value) {
                    $locality = Locality::firstOrCreate([
                        "code" => strtolower($value).'-'.$district->id,
                        "name" => strtolower($value),
                        "district_id" =>$district->id,
                    ]);
                }

            });
            DB::commit();
            return $departments;
        } catch (QueryException $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            throw $th;
        }
    }

    public function update(Array $data,int $id)
    {
        try {
            $department = $this->model->findOrFail($id);
            $department->update($data);
            return $department->fresh();
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }

    public function destroy($id)
    {
        try {
            $department = $this->model->findOrFail($id);
            $department->delete();
            return true;
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }
}
