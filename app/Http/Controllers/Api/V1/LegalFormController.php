<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Gpp\LegalForms\Repositories\LegalFormRepository;
use App\Gpp\LegalForms\Requests\CreateRequest;
use App\Http\Resources\LegalFormCollection;
use App\Http\Resources\LegalFormResource;

class LegalFormController extends Controller
{
    private $legalFormRepo;
    public function __construct(LegalFormRepository $legalFormRepo)
    {
        $this->legalFormRepo = $legalFormRepo;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = $this->legalFormRepo->findAll();
        return response()->json([
            'data' => new LegalFormCollection($product),
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
        $product = $this->legalFormRepo->save($request->all());
        return response()->json([
            'message'=>"Forme juridique sauvegardée",
            'data' => new LegalFormResource($product)
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
        $product = $this->legalFormRepo->find($id);
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
        $product = $this->legalFormRepo->update($request->all(),$id);
        return response()->json([
            'message'=>"Forme juridique sauvegardée",
            'data' => new LegalFormResource($product)
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
        $product = $this->legalFormRepo->destroy($id);
        return response()->json([
            'message' => "Forme juridique supprimée"
        ],200);
    }
}
