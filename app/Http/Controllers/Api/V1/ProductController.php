<?php

namespace App\Http\Controllers\Api\V1;

use App\Gpp\Packages\Package;
use App\Gpp\Products\Product;
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
        $this->middleware(['auth:sanctum']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize("viewAny", Product::class);

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
        $this->authorize("create", Product::class);

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
        $this->authorize("view", Product::class);

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
        $this->authorize("update", Product::class);

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
        $this->authorize("delete", Product::class);

        $product = $this->productRepo->destroy($id);

        return response()->json([
            'message' => "Produit supprimé"
        ],200);
    }
}
