<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Gpp\Trucks\Repositories\TruckRepository;
use App\Gpp\Trucks\Requests\CreateRequest;
use App\Gpp\Trucks\Truck;
use App\Http\Resources\TruckCollection;
use App\Http\Resources\TruckResource;
use Illuminate\Support\Facades\Auth;

class TruckController extends Controller
{
    private $truckRepo;
    public function __construct(TruckRepository $truckRepo)
    {
        $this->truckRepo = $truckRepo;
        $this->middleware(['auth:sanctum']); 

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize("viewAny",Truck::class);

        $product = $this->truckRepo->findAll();
        return response()->json([
            'data' => new TruckCollection($product),
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
        $this->authorize("create", Truck::class);

        $product = $this->truckRepo->save($request->all());
        return response()->json([
            'message'=>"Camion sauvegardé",
            'data' => new TruckResource($product)
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
        $this->authorize("view", Truck::class);

        $product = $this->truckRepo->find($id);
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
        $this->authorize("update", Truck::class);

        $product = $this->truckRepo->update($request->all(),$id);
        return response()->json([
            'message'=>"Camion sauvegardé",
            'data' => new TruckResource($product)
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
        $this->authorize("delete", Truck::class);

        $product = $this->truckRepo->destroy($id);
        return response()->json([
            'message' => "Camion supprimé"
        ],200);
    }
}
