<?php

namespace App\Http\Controllers\Api\V1;

use App\Gpp\Packages\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Gpp\Roles\Repositories\RoleRepository;
use App\Gpp\Roles\Requests\CreateRequest;
use App\Http\Resources\RoleCollection;
use App\Http\Resources\RoleResource;

class RoleController extends Controller
{
    private $roleRepo;
    public function __construct(RoleRepository $roleRepo)
    {
        $this->roleRepo = $roleRepo;

        $this->middleware(['auth:sanctum']);
        $this->middleware(['ability:role-view'])->only(["index","show"]);
        $this->middleware(['ability:role-create'])->only(["store"]);
        $this->middleware(['ability:role-update'])->only(["update"]);
        $this->middleware(['ability:role-delete'])->only(["destroy"]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = $this->roleRepo->findAll();
        return response()->json([
            'data' => new RoleCollection($role),
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
        $role = $this->roleRepo->save($request->all());
        return response()->json([
            'message'=>"Role sauvegardé",
            'data' => new RoleResource($role)
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
        $role = $this->roleRepo->find($id);
        return response()->json([
            'data' => new RoleResource($role),
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
        $role = $this->roleRepo->update($request->all(),$id);
        return response()->json([
            'message'=>"Role sauvegardé",
            'data' => new RoleResource($role)
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
        $role = $this->roleRepo->destroy($id);

        return response()->json([
            'message' => "Role supprimé"
        ],200);
    }
}
