<?php
namespace App\Tba\Traits;

use SimpleQrCode\Facades\QrCode;

trait UtilsTrait{
    /**
     * Generate Numbers and shuffle the result 
     * @param Integer $n
     * @return Integer
     */
    public function generateNumbers(int $n):Int
    {
        $numbers = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        $numbersGenerateArray = [];

        for ($i = 0; $i < $n; $i++) {
            $nombre = random_int(1, 9);
            $numbersGenerateArray[$i] = $numbers[$nombre];
        }

        $numbersGenerateString = implode($numbersGenerateArray);
        $result = str_shuffle(trim($numbersGenerateString));

        return $result;
    }


    public function generateQrcode($data):string
    {
        $name = $data['filename'].'.svg';

        QrCode::format('svg')
                ->backgroundColor(255, 255, 255, 0)
                ->size(500)
                ->style('round')
                ->encoding('UTF-8')
                ->generate($data['qr_code'],storage_path('/app/public/qrcodes/'.$name));
     
        return $name;
    }

    
}
