<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\MeasureCollection;
use App\Gpp\Measures\Requests\CreateRequest;
use App\Gpp\Measures\Repositories\MeasureRepository;

class MeasureController extends Controller
{
    private $measureRepo;
    public function __construct(MeasureRepository $measureRepo)
    {
        $this->measureRepo = $measureRepo;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $measure = $this->measureRepo->findAll();
        return response()->json([
            'data' => new MeasureCollection($measure),
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
        $measure = $this->measureRepo->save($request->all());
        return response()->json([
            'message'=>"Unité de mesure sauvegardée",
            'data' => $measure
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
        $measure = $this->measureRepo->find($id);
        return response()->json([
            'data' => $measure,
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
        $measure = $this->measureRepo->update($request->all(),$id);
        return response()->json([
            'message'=>"Unité de mesure sauvegardée",
            'data' => $measure
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
        $measure = $this->measureRepo->destroy($id);

        return response()->json([
            'message' => "Unité de mesure supprimée"
        ],200);
    }
}
