<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Gpp\Traits\UploadableTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\DepartmentResource;
use App\Http\Resources\DepartmentCollection;
use App\Gpp\Departments\Requests\CreateRequest;
use App\Gpp\Departments\Repositories\DepartmentRepository;

class DepartmentController extends Controller
{
    use UploadableTrait;
    private $departmentRepo;
    public function __construct(DepartmentRepository $departmentRepo)
    {
        $this->departmentRepo = $departmentRepo;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = $this->departmentRepo->findAll();
        return response()->json([
            'data' => new DepartmentCollection($departments),
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        
        $departments = $this->departmentRepo->save($request->all());
        return response()->json([
            'message'=>"Departement sauvegardé",
            'data' => new DepartmentResource($departments)
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $departments = $this->departmentRepo->find($id);
        return response()->json([
            'data' => $departments,
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $departments = $this->departmentRepo->update($request->all(),$id);
        return response()->json([
            'message'=>"Departement sauvegardé",
            'data' => new DepartmentResource($departments)
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $departments = $this->departmentRepo->destroy($id);

        return response()->json([
            'message' => "Departement supprimé"
        ],200);
    }
}
