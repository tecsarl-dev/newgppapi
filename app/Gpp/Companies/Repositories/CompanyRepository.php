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
use Illuminate\Support\Facades\Auth;
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

    public function findAll()
    {
        $companyConnected = Company::findOrFail(Auth::user()->company_id);

        $companies = $this->model->when(request('s'), function ($query) {
            $query->where('name','like',"%".request('s')."%");
        })
        ->when(request("type"), function ($query) {
            $query->where("type_company",request("type"));
        })
        ->when(!request("type") && $companyConnected->type_company == 'petroleum', function ($query) {
            $query->where("type_company",'transporter');
        })
        ->orderBy('name','ASC');

        if (request('s')) {
            if (request("trucks")) {
                $companies = $companies->with("active_trucks");
            }
            return $companies->select('id as id','name',"ifu","rccm")->get();
        } else {
            return $companies->get()->sortDesc();
        }
       
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
            $companyConnected = Company::findOrFail(Auth::user()->company_id);
            if ($companyConnected->type_company == 'petroleum') {
                $data["type_company"] = "transporter";
            }
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
