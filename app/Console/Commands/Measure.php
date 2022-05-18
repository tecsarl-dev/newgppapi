<?php

namespace App\Console\Commands;

use App\Gpp\Measures\Measure as M;
use Illuminate\Console\Command;

class Measure extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'measure:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Les unites de mesures';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data =[
            new M([
                "name"=> "Metre cube",
                "symbol" => "m3"
            ]),
            new M([
                "name"=> "Litre",
                "symbol" => "l"
            ]),
            new M([
                "name"=> "Kilogramme",
                "symbol" => "kg"
            ])
        ];

        foreach($data as $item){
            $item->save();
        }
        return 0;
    }
}
