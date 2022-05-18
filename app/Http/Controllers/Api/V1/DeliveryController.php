<?php

namespace App\Http\Controllers\Api\V1;

use App\Gpp\Deliveries\Delivery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DeliveryResource;
use App\Http\Resources\DeliveryCollection;
use App\Gpp\Deliveries\Requests\CreateRequest;
use App\Gpp\Deliveries\Repositories\DeliveryRepository;

class DeliveryController extends Controller
{
    private $deliveryRepo;
    public function __construct(DeliveryRepository $deliveryRepo)
    {
        $this->deliveryRepo = $deliveryRepo;
        $this->middleware(['auth:sanctum']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize("viewAny", Delivery::class);

        $delivery = $this->deliveryRepo->findAll();
        return response()->json([
            'data' => new DeliveryCollection($delivery),
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
        $this->authorize("create", Delivery::class);

        $delivery = $this->deliveryRepo->save($request->all());
        return response()->json([
            'message'=>"Livraison sauvegardée",
            'data' => new DeliveryResource($delivery)
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
        $this->authorize("view", Delivery::class);

        $delivery = $this->deliveryRepo->find($id);
        return response()->json([
            'data' => new DeliveryResource($delivery)
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
        $this->authorize("update", Delivery::class);

        $delivery = $this->deliveryRepo->update($request->all(),$id);
        return response()->json([
            'message'=>"Livraison sauvegardée",
            'data' => new DeliveryResource($delivery)
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
        $this->authorize("delete", Delivery::class);
        
        $delivery = $this->deliveryRepo->destroy($id);
        return response()->json([
            'message' => "Livraison supprimée"
        ],200);
    }
}
