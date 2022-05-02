<?php
namespace App\Gpp\Measures\Repositories;

use App\Gpp\Measures\Measure;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Collection;

class MeasureRepository
{
    private $model;
    /**
     * Constructeur
     * @return void
     */
    public function __construct(Measure $measure)
    {
        $this->model = $measure;
        return;
    }

    public function findAll(): Collection
    {
        $measures = $this->model->all()->sortDesc();
        return $measures;
    }

    public function find()
    {
        # code...
    }

    public function save(Array $data)
    {
        try {
            $measure = $this->model->create($data);
            return $measure;
        } catch (QueryException $th) {
            throw $th;
        }
    }

    public function update(Array $data,int $id)
    {
        try {
            $measure = $this->model->findOrFail($id);
            $updated =  $measure->update($data);
            return $measure->fresh();
        } catch (QueryException $th) {
            throw $th;
        }
    }

    public function destroy()
    {
        # code...
    }
}