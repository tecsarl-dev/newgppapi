<?php
namespace App\Gpp\Traits;

use Illuminate\Http\UploadedFile;
trait UploadableTrait{
    
    /**
     * Upload a single file in the server
     *
     * @param UploadedFile $file
     * @param null $folder
     * @param string $disk
     * @param null $filename
     * @return false|string
     */
    public function uploadOne(UploadedFile $file,?string $folder,?string $filename,string $disk = 'uploads')
    {
        $name = !is_null($filename) ? $filename : time().'jpg';

        return $file->storeAs(
            $folder,
            $name,
            $disk
        ); 
    }
    
}
