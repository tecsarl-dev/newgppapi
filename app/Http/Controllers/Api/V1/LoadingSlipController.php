<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\LoadingSlipResource;
use App\Http\Resources\LoadingSlipCollection;
use App\Gpp\LoadingSlips\Repositories\LoadingSlipRepository;
use App\Gpp\LoadingSlips\Requests\CreateRequest;
use App\Gpp\LoadingSlips\Requests\UpdateRequest;

class LoadingSlipController extends Controller
{
    private $loadingRepo;
    public function __construct(LoadingSlipRepository $loadingRepo)
    {
        $this->loadingRepo = $loadingRepo;
        $this->middleware(['auth:sanctum']);
        $this->middleware(['ability:loadingslip-view'])->only(["index","show"]);
        $this->middleware(['ability:loadingslip-create'])->only(["store"]);
        $this->middleware(['ability:loadingslip-update'])->only(["update"]);
        $this->middleware(['ability:loadingslip-delete'])->only(["destroy"]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loadingSlip = $this->loadingRepo->findAll();
        dd($loadingSlip);
        return response()->json([
            'data' => new LoadingSlipCollection($loadingSlip),
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
        $loadingSlip = $this->loadingRepo->save($request->all());
        return response()->json([
            'message'=>"Bon de chargement sauvegardé",
            'data' => new LoadingSlipResource($loadingSlip)
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
        $loadingSlip = $this->loadingRepo->find($id);
        return response()->json([
            'data' => new LoadingSlipResource($loadingSlip)
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $loadingSlip = $this->loadingRepo->update($request->all(),$id);
        return response()->json([
            'message'=>"Bon de chargement sauvegardé",
            'data' => new LoadingSlipResource($loadingSlip)
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
        $loadingSlip = $this->loadingRepo->destroy($id);
        return response()->json([
            'message' => "Bon de chargement supprimé"
        ],200);
    }
}
