<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Cruder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cruder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generer les dossiers et le model dune table';

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
        $name = $this->ask('Quel est le nom de votre modèle?');
        $mainFolder = $this->ask('Quel est le dossier principale de l\'application?');

        // Creation du dossier de la table dans le dossier principale
        $main = $mainFolder."/".Str::ucfirst(Str::plural(strtolower($name)));
        mkdir(app_path($main));
        mkdir(app_path($main."/Requests"));
        mkdir(app_path($main."/Repositories"));

        // Creation du model de la table avec migration dans le dossier respectif
        $modelFile = "App/".$main."/".Str::ucfirst($name);
        Artisan::call("make:model $modelFile -m");

        // Creation de la resource et de la collection du model
        Artisan::call("make:resource ".Str::ucfirst($name)."Resource");
        Artisan::call("make:resource ".Str::ucfirst($name)."Collection");

        // 
        $createRequest = "App/".$main."/".Str::ucfirst($name)."/Requests/CreateRequest";
        Artisan::call("make:request $createRequest");

        $this->newLine();
        $this->line('Crud Successfuly');
        return 0;
    }
}
