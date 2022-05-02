<?php

namespace App\Http\Controllers\Api\V1;

use App\Gpp\Traits\UploadableTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\CompanyCollection;
use App\Gpp\Companies\Requests\CreateRequest;
use App\Gpp\Companies\Repositories\CompanyRepository;

class CompanyController extends Controller
{
    use UploadableTrait;
    private $companyRepo;
    public function __construct(CompanyRepository $companyRepo)
    {
        $this->companyRepo = $companyRepo;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = $this->companyRepo->findAll();
        return response()->json([
            'data' => new CompanyCollection($companies),
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
        $company = $this->companyRepo->save($request->all());
        return response()->json([
            'message'=>"Entreprise sauvegardée",
            'data' => new CompanyResource($company)
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
        $company = $this->companyRepo->find($id);
        return response()->json([
            'data' => new CompanyResource($company),
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
        $company = $this->companyRepo->update($request->all(),$id);
        return response()->json([
            'message'=>"Entreprise sauvegardée",
            'data' => new CompanyResource($company)
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
        $company = $this->companyRepo->destroy($id);

        return response()->json([
            'message' => "Entreprise supprimée"
        ],200);
    }
}
