<?php
namespace App\Gpp\Geo\Repositories;

use Illuminate\Support\Str;
use App\Gpp\Communes\Commune;
use App\Gpp\Countries\Country;
use App\Gpp\Districts\District;
use App\Gpp\Localities\Locality;
use Illuminate\Support\Facades\DB;
use App\Gpp\Departments\Department;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Rap2hpoutre\FastExcel\Facades\FastExcel;

class GeoRepository
{
    public function importFile(string $file)
    {
        try {
            DB::beginTransaction();
            $search  = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ');
            $replace = array('A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 'a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y');
            // $MaChaine = str_replace($search, $replace, $MaChaine);
            
            $import = FastExcel::import(storage_path('/app/public/imports/'.$file),function($line) use($search,$replace){
                $country =  Country::firstOrCreate([
                  "name" =>str_replace($search,$replace,strtolower($line["Pays"])),
                ]);
                
                $department =  Department::firstOrCreate([
                    "code" => str_replace(' ', '',str_replace($search,$replace,strtolower($line["Departements"])).'-'.$country->id),
                    "name" => str_replace($search,$replace,strtolower($line["Departements"])),
                    "country_id" =>$country->id,
                ]);

                $commune = Commune::firstOrCreate([
                    "code" => str_replace(' ', '',str_replace($search,$replace,strtolower($line["Communes"])).'-'.$department->id),
                    "name" => str_replace($search,$replace,strtolower($line["Communes"])),
                    "department_id" =>$department->id,
                ]);

                $district = District::firstOrCreate([
                    "code" => str_replace(' ', '',str_replace($search,$replace,strtolower($line["Arrondissements"])).'-'.$commune->id),
                    "name" => str_replace($search,$replace,strtolower($line["Arrondissements"])),
                    "commune_id" =>$commune->id,
                ]);

                $dataLocality = explode(',', $line["Localités"]);

                foreach ($dataLocality as $key => $value) {
                    $locality = Locality::firstOrCreate([
                        "code" => str_replace(' ', '',str_replace($search,$replace,strtolower($value)).'-'.$district->id),
                        "name" => str_replace($search,$replace,strtolower($value)),
                        "district_id" =>$district->id,
                    ]);
                }
            });
            DB::commit();
            return true;
        } catch (QueryException $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            throw $th;
        }
    }
}
