<?php
namespace App\Gpp\Localities\Repositories;

use App\Gpp\Localities\Locality;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use App\Gpp\Communes\Commune;

class LocalityRepository
{
    private $model;
    /**
     * Constructeur
     * @return void
     */
    public function __construct(Locality $loaclity,Commune $commune)
    {
        $this->model = $loaclity;
        $this->commune = $commune;
        return;
    }

    public function findAll()
    {
        $result = $this->model->when(request('s'),function($query) {
            $query->where('localities.name','like',"%".request('s')."%")
            ->when(request('groupBy') === 'districts', function ($query) {
                $query->leftJoin('districts','districts.id', '=', 'localities.district_id');
            });
        })
        ->when(request('commune') != null,function ($query){
            $query->whereHas('district',function($query) {
                $query->whereHas('commune', function ($query)
                {
                  $query->where('id','=',request('commune'));
                });
            });
        });

        if (request('s')) {
            if (request('commune') == null) {
               return [];
            }
            if (request('groupBy')) {
                $result = $result->get(['localities.*',request('groupBy').'.name as districts'])->toArray();
                $result = collect($result)->groupBy(request('groupBy'));
            }else{
                return $result->get()->sortDesc();
            }
            return $result;
        } else {
            return $result->get()->sortDesc();
        }
        
    }

    public function find()
    {
        # code...
    }

    public function save(Array $data)
    {
        try {
            $loaclity = $this->model->create($data);
            return $loaclity->fresh();
        } catch (QueryException $th) {
            throw $th;
        }
    }

    public function update(Array $data,int $id)
    {
        try {
            $loaclity = $this->model->findOrFail($id);
            $loaclity->update($data);
            return $loaclity->fresh();
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }


    public function destroy($id)
    {
        try {
            $loaclity = $this->model->findOrFail($id);
            $loaclity->delete();
            return true;
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }
}
