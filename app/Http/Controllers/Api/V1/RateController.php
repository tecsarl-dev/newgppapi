<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Gpp\Rates\Repositories\RateRepository;
use App\Gpp\Rates\Requests\CreateRequest;
use App\Http\Resources\RateCollection;
use App\Http\Resources\RateResource;

class RateController extends Controller
{
    private $rateRepo;
    public function __construct(RateRepository $rateRepo)
    {
        $this->rateRepo = $rateRepo;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = $this->rateRepo->findAll();
        return response()->json([
            'data' => new RateCollection($product),
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
        $product = $this->rateRepo->save($request->all());
        return response()->json([
            'message'=>"Tarif sauvegardé",
            'data' => new RateResource($product)
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
        $product = $this->rateRepo->find($id);
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
        $product = $this->rateRepo->update($request->all(),$id);
        return response()->json([
            'message'=>"Tarif sauvegardé",
            'data' => new RateResource($product)
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
        $product = $this->rateRepo->destroy($id);
        return response()->json([
            'message' => "Tarif supprimé"
        ],200);
    }
}
