<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Gpp\LegalForms\LegalForm as LF;
class LegalForm extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'legalform:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Les formes juridiques";

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
            new LF([
                "name"=> "SARL",
                "sigle" => "sarl"
            ]),
            new LF([
                "name"=> "SA",
                "sigle" => "sa"
            ])
        ];

        foreach ($data as $item) {
            $item->save();
        }
        return 0;
    }
}
