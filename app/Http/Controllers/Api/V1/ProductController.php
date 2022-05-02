<?php

namespace App\Http\Controllers\Api\V1;

use App\Gpp\Packages\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Gpp\Products\Repositories\ProductRepository;
use App\Gpp\Products\Requests\CreateRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    private $productRepo;
    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = $this->productRepo->findAll();
        return response()->json([
            'data' => new ProductCollection($product),
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
        $product = $this->productRepo->save($request->all());
        return response()->json([
            'message'=>"Produit sauvegardé",
            'data' => new ProductResource($product)
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
        $product = $this->productRepo->find($id);
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
        $product = $this->productRepo->update($request->all(),$id);
        return response()->json([
            'message'=>"Produit sauvegardé",
            'data' => new ProductResource($product)
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
        $product = $this->productRepo->destroy($id);

        return response()->json([
            'message' => "Produit supprimé"
        ],200);
    }
}
