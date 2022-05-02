<?php
namespace App\Gpp\LegalForms\Repositories;

use App\Gpp\LegalForms\LegalForm;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Collection;

class LegalFormRepository
{
    private $model;
    /**
     * Constructeur
     * @return void
     */
    public function __construct(LegalForm $legalForm)
    {
        $this->model = $legalForm;
        return;
    }

    public function findAll(): Collection
    {
        $legalForms = $this->model->get()->sortDesc();
        return $legalForms;
    }

    public function find()
    {
        # code...
    }

    public function save(Array $data)
    {
        try {
            $legalForm = $this->model->create($data);
            return $legalForm->fresh();
        } catch (QueryException $th) {
            throw $th;
        }
    }

    public function update(Array $data,int $id)
    {
        try {
            $legalForm = $this->model->findOrFail($id);
            $legalForm->update($data);
            return $legalForm->fresh();
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }

    public function destroy($id)
    {
        try {
            $legalForm = $this->model->findOrFail($id);
            $legalForm->delete();
            return true;
        } catch (QueryException $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }
}
