<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommuneResource;
use App\Http\Resources\CommuneCollection;
use App\Gpp\Products\Requests\CreateRequest;
use App\Gpp\Communes\Repositories\CommuneRepository;

class CommuneController extends Controller
{
    private $communeRepo;
    public function __construct(CommuneRepository $communeRepo)
    {
        $this->communeRepo = $communeRepo;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->query('s')){
            $communeSearched = $this->communeRepo->findBySearch(request()->query('s'));
            return response()->json([
                'data' => new CommuneCollection($communeSearched)
            ],200);
        }

        $commune = $this->communeRepo->findAll();
        return response()->json([
            'data' => new CommuneCollection($commune),
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
        $commune = $this->communeRepo->save($request->all());
        return response()->json([
            'message'=>"Commune sauvegardé",
            'data' => new CommuneResource($commune)
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
        $commune = $this->communeRepo->find($id);
        return response()->json([
            'data' => $commune,
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
        $commune = $this->communeRepo->update($request->all(),$id);
        return response()->json([
            'message'=>"Commune sauvegardé",
            'data' => new CommuneResource($commune)
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
        $commune = $this->communeRepo->destroy($id);

        return response()->json([
            'message' => "Commune supprimé"
        ],200);
    }
}
