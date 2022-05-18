<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RateResource;
use App\Http\Resources\FeatureCollection;
use App\Gpp\Rates\Requests\CreateRequest;
use App\Gpp\Features\Repositories\FeatureRepository;

class FeatureController extends Controller
{
    private $featureRepo;
    public function __construct(FeatureRepository $featureRepo)
    {
        $this->featureRepo = $featureRepo;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feature = $this->featureRepo->findAll();
        return response()->json([
            'data' => new FeatureCollection($feature),
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
        $feature = $this->featureRepo->save($request->all());
        return response()->json([
            'message'=>"Fonctionnalité sauvegardée",
            'data' => new RateResource($feature)
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
        $feature = $this->featureRepo->find($id);
        return response()->json([
            'data' => $feature,
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
        $feature = $this->featureRepo->update($request->all(),$id);
        return response()->json([
            'message'=>"Fonctionnalité sauvegardée",
            'data' => new RateResource($feature)
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
        $feature = $this->featureRepo->destroy($id);
        return response()->json([
            'message' => "Fonctionnalité supprimée"
        ],200);
    }
}
