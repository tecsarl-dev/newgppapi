<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Gpp\Stations\Repositories\StationRepository;
use App\Gpp\Stations\Requests\CreateRequest;
use App\Http\Resources\LoadingSlipCollection;
use App\Http\Resources\LoadingSlipResource;

class LoadingSlipController extends Controller
{
    private $loadingRepo;
    public function __construct(StationRepository $loadingRepo)
    {
        $this->loadingRepo = $loadingRepo;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $station = $this->loadingRepo->findAll();
        return response()->json([
            'data' => new LoadingSlipCollection($station),
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
        $station = $this->loadingRepo->save($request->all());
        return response()->json([
            'message'=>"Bon de chargement sauvegardé",
            'data' => new LoadingSlipResource($station)
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
        $station = $this->loadingRepo->find($id);
        return response()->json([
            'data' => $station,
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
        $station = $this->loadingRepo->update($request->all(),$id);
        return response()->json([
            'message'=>"Bon de chargement sauvegardé",
            'data' => new LoadingSlipResource($station)
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
        $station = $this->loadingRepo->destroy($id);
        return response()->json([
            'message' => "Bon de chargement supprimé"
        ],200);
    }
}
