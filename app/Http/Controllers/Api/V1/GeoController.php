<?php

namespace App\Http\Controllers\Api\V1;

use App\Gpp\Traits\UploadableTrait;
use App\Http\Controllers\Controller;
use App\Gpp\Geo\Requests\CreateRequest;
use App\Gpp\Geo\Repositories\GeoRepository;

class GeoController extends Controller
{
    private $geoRepo;

    use UploadableTrait;

    public function __construct(GeoRepository $geoRepo)
    {
        $this->geoRepo = $geoRepo;
    }

    public function import(CreateRequest $request)
    {
        if($request['file']){
            $filename = time().'.xlsx';
            $this->uploadOne($request['file'],'/imports', $filename, 'public');
        }
        $geo = $this->geoRepo->importFile($filename);
        return response()->json([
            'message'=>"Geo et autres importé",
        ],201);
    }
}
