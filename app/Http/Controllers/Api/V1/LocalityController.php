<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LocalityResource;
use App\Http\Resources\LocalityCollection;
use App\Gpp\Products\Requests\CreateRequest;
use App\Http\Resources\LocalitySearchCollection;
use App\Gpp\Localities\Repositories\LocalityRepository;

class LocalityController extends Controller
{
    private $localityRepo;
    public function __construct(LocalityRepository $localityRepo)
    {
        $this->localityRepo = $localityRepo;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locality = $this->localityRepo->findAll();
        return response()->json([
            'data' =>new LocalitySearchCollection($locality),
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
        $locality = $this->localityRepo->save($request->all());
        return response()->json([
            'message'=>"Localité sauvegardée",
            'data' => new LocalityResource($locality)
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
        $locality = $this->localityRepo->find($id);
        return response()->json([
            'data' => $locality,
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
        $locality = $this->localityRepo->update($request->all(),$id);
        return response()->json([
            'message'=>"Localité sauvegardée",
            'data' => new LocalityResource($locality)
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
        $locality = $this->localityRepo->destroy($id);

        return response()->json([
            'message' => "Localité supprimée"
        ],200);
    }
}
