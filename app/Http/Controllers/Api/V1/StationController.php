<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Gpp\Stations\Repositories\StationRepository;
use App\Gpp\Stations\Requests\CreateRequest;
use App\Gpp\Stations\Station;
use App\Http\Resources\StationCollection;
use App\Http\Resources\StationResource;
use Illuminate\Support\Facades\Auth;

class StationController extends Controller
{
    private $stationRepo;
    public function __construct(StationRepository $stationRepo)
    {
        $this->stationRepo = $stationRepo;
        $this->middleware(['auth:sanctum']); 
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $this->authorize("viewAny", Station::class);

        $station = $this->stationRepo->findAll();
        return response()->json([
            'data' => new StationCollection($station),
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
        $this->authorize("create", Station::class);

        $station = $this->stationRepo->save($request->all());
        return response()->json([
            'message'=>"Station sauvegardé",
            'data' => new StationResource($station)
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
        $this->authorize("view", Station::class);

        $station = $this->stationRepo->find($id);
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
        $this->authorize("update", Station::class);

        $station = $this->stationRepo->update($request->all(),$id);
        return response()->json([
            'message'=>"Station sauvegardé",
            'data' => new StationResource($station)
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
        $this->authorize("delete", Station::class);

        $station = $this->stationRepo->destroy($id);
        return response()->json([
            'message' => "Station supprimé"
        ],200);
    }
}
