<?php

namespace App\Http\Controllers\Api\V1;

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
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = $this->depotRepo->findAll();
        return response()->json([
            'data' => new DepotCollection($product),
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
        $product = $this->depotRepo->save($request->all());
        return response()->json([
            'message'=>"Depot sauvegardé",
            'data' => new DepotResource($product)
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
        $product = $this->depotRepo->find($id);
        return response()->json([
            'data' => $product,
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
        $product = $this->depotRepo->update($request->all(),$id);
        return response()->json([
            'message'=>"Depot sauvegardé",
            'data' => new DepotResource($product)
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
        $product = $this->depotRepo->destroy($id);
        return response()->json([
            'message' => "Depot supprimé"
        ],200);
    }
}
