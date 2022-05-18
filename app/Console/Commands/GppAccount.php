<?php

namespace App\Console\Commands;

use App\Gpp\Companies\Company;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GppAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gpp:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creer le compte GPP et son administrateur';

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
       try {
            DB::beginTransaction();
            $data =[
                'type_company' => "gpp",
                'name' => "GPP",
                'ifu' => "0 0000 0000 0000",
                'rccm' => "RB/TEST/55 B 4444",
                'legal_form_id' => 1,
                'email' => "gpp@gpp.com",
                'phone' => "+ (229) 00 000 000",
                'address_physical' => "Adresse de GPP",
            ];
            $userData = [
                'firstname' =>"Admin",
                'lastname' =>"Admin",
                'email' =>"admin@gpp.com",
                'password' => "password",
            ];
            
            $company = Company::create($data);
            $user = $company->users()->create($userData);
            $user->markEmailAsVerified();

            $role = $company->roles()->where("name","administrateur")->first();
        
            $user->roles()->sync([$role->id]);

            DB::commit();
            return 0;
       } catch (\Throwable $th) {
           DB::rollBack();
           throw $th;
       }
    }
}
