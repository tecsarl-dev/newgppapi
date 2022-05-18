<?php

namespace App\Http\Controllers\Api\V1;

use App\Gpp\Depots\Depot;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Gpp\Depots\Repositories\DepotRepository;
use App\Gpp\Depots\Requests\CreateRequest;
use App\Http\Resources\DepotCollection;
use App\Http\Resources\DepotResource;

class DepotController extends Controller
{
    private $depotRepo;
    public function __construct(DepotRepository $depotRepo)
    {
        $this->depotRepo = $depotRepo;
        $this->middleware(['auth:sanctum']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize("viewAny", Depot::class);

        $depot = $this->depotRepo->findAll();
        return response()->json([
            'data' => new DepotCollection($depot),
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
        $this->authorize("create", Depot::class);

        $depot = $this->depotRepo->save($request->all());
        return response()->json([
            'message'=>"Depot sauvegardé",
            'data' => new DepotResource($depot)
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
        $this->authorize("view", Depot::class);

        $depot = $this->depotRepo->find($id);
        return response()->json([
            'data' => $depot,
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
        $this->authorize("update", Depot::class);

        $depot = $this->depotRepo->update($request->all(),$id);
        return response()->json([
            'message'=>"Depot sauvegardé",
            'data' => new DepotResource($depot)
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
        $this->authorize("delete", Depot::class);

        $depot = $this->depotRepo->destroy($id);
        return response()->json([
            'message' => "Depot supprimé"
        ],200);
    }
}
