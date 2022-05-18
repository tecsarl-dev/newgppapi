<?php

namespace App\Console\Commands;

use App\Gpp\Permissions\Permission;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class Feature extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feature:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Feature create';

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

            $data = [
                [
                    "name" => "Utilisateur",
                    "guard" => "user",
                    "default_create" => 1,
                    "type_company" => null,
                    "permissions" => [
                        new Permission([
                            "name" => "Voir",
                            "guard" => "user-view",
                            "default_create" => 1,
                        ]),
                        new Permission([
                            "name" => "Creer",
                            "guard" => "user-create",
                            "default_create" => 1,
                        ]),
                        new Permission([
                            "name" => "Modifier",
                            "guard" => "user-update",
                            "default_create" => 1,
                        ]),
                        new Permission([
                            "name" => "Supprimer",
                            "guard" => "user-delete",
                            "default_create" => 1,
                        ]),
                    ]
                ],
                [
                    "name" => "Collaborateur",
                    "guard" => "collaborator",
                    "default_create" => 1,
                    "type_company" => "all",
                    "permissions" => [
                        new Permission([
                            "name" => "Voir",
                            "guard" => "collaborator-view",
                            "default_create" => 1,
                        ]),
                        new Permission([
                            "name" => "Inviter",
                            "guard" => "collaborator-create",
                            "default_create" => 1,
                        ]),
                        new Permission([
                            "name" => "Supprimer",
                            "guard" => "collaborator-delete",
                            "default_create" => 1,
                        ]),
                    ]
                ],
                [
                    "name" => "Role",
                    "guard" => "role",
                    "default_create" => 1,
                    "type_company" => "all",
                    "permissions" => [
                        new Permission([
                            "name" => "Voir",
                            "guard" => "role-view",
                            "default_create" => 1,
                        ]),
                        new Permission([
                            "name" => "Creer",
                            "guard" => "role-create",
                            "default_create" => 1,
                        ]),
                        new Permission([
                            "name" => "Modifier",
                            "guard" => "role-update",
                            "default_create" => 1,
                        ]),
                        new Permission([
                            "name" => "Supprimer",
                            "guard" => "role-delete",
                            "default_create" => 1,
                        ]),
                    ]
                ],
                [
                    "name" => "Entreprise",
                    "guard" => "company",
                    "default_create" => 1,
                    "type_company" => null,
                    "permissions" => [
                        new Permission([
                            "name" => "Voir",
                            "guard" => "company-view",
                            "default_create" => 1,
                        ]),
                        new Permission([
                            "name" => "Creer",
                            "guard" => "company-create",
                            "default_create" => 1,
                        ]),
                        new Permission([
                            "name" => "Modifier",
                            "guard" => "company-update",
                            "default_create" => 1,
                        ]),
                        new Permission([
                            "name" => "Supprimer",
                            "guard" => "company-delete",
                            "default_create" => 1,
                        ]),
                    ]
                ],
                [
                    "name" => "Transporteur",
                    "guard" => "transporter",
                    "default_create" => 1,
                    "type_company" => "petroleum",
                    "permissions" => [
                        new Permission([
                            "name" => "Voir",
                            "guard" => "transporter-view",
                            "default_create" => 1,
                        ]),
                        new Permission([
                            "name" => "Creer",
                            "guard" => "transporter-create",
                            "default_create" => 1,
                        ])
                    ]
                ],
                [
                    "name" => "Transporteur Camion",
                    "guard" => "transporter-camion",
                    "default_create" => 1,
                    "type_company" => "petroleum",
                    "permissions" => [
                        new Permission([
                            "name" => "Voir",
                            "guard" => "transporter-camion-view",
                            "default_create" => 1,
                        ]),
                        new Permission([
                            "name" => "Creer",
                            "guard" => "transporter-camion-create",
                            "default_create" => 1,
                        ])
                    ]
                ],
                [
                    "name" => "Produit",
                    "guard" => "product",
                    "default_create" => 1,
                    "type_company" => "gpp",
                    "permissions" => [
                        new Permission([
                            "name" => "Voir",
                            "guard" => "product-view",
                            "default_create" => 1,
                        ]),
                        new Permission([
                            "name" => "Creer",
                            "guard" => "product-create",
                            "default_create" => 1,
                        ]),
                        new Permission([
                            "name" => "Modifier",
                            "guard" => "product-update",
                            "default_create" => 1,
                        ]),
                        new Permission([
                            "name" => "Supprimer",
                            "guard" => "product-delete",
                            "default_create" => 1,
                        ]),
                    ]
                ],
                [
                    "name" => "Depot",
                    "guard" => "depot",
                    "default_create" => 1,
                    "type_company" => "gpp",
                    "permissions" => [
                        new Permission([
                            "name" => "Voir",
                            "guard" => "depot-view",
                            "default_create" => 1,
                        ]),
                        new Permission([
                            "name" => "Creer",
                            "guard" => "depot-create",
                            "default_create" => 1,
                        ]),
                        new Permission([
                            "name" => "Modifier",
                            "guard" => "depot-update",
                            "default_create" => 1,
                        ]),
                        new Permission([
                            "name" => "Supprimer",
                            "guard" => "depot-delete",
                            "default_create" => 1,
                        ]),
                    ]
                ],
                [
                    "name" => "Tarif",
                    "guard" => "rate",
                    "default_create" => 1,
                    "type_company" => "gpp",
                    "permissions" => [
                        new Permission([
                            "name" => "Voir",
                            "guard" => "rate-view",
                            "default_create" => 1,
                        ]),
                        new Permission([
                            "name" => "Creer",
                            "guard" => "rate-create",
                            "default_create" => 1,
                        ]),
                        new Permission([
                            "name" => "Modifier",
                            "guard" => "rate-update",
                            "default_create" => 1,
                        ]),
                        new Permission([
                            "name" => "Supprimer",
                            "guard" => "rate-delete",
                            "default_create" => 1,
                        ]),
                    ]
                ],
                [
                    "name" => "Station",
                    "guard" => "station",
                    "default_create" => 1,
                    "type_company" => "petroleum",
                    "permissions" => [
                        new Permission([
                            "name" => "Voir",
                            "guard" => "station-view",
                            "default_create" => 1,
                        ]),
                        new Permission([
                            "name" => "Creer",
                            "guard" => "station-create",
                            "default_create" => 1,
                        ]),
                        new Permission([
                            "name" => "Modifier",
                            "guard" => "station-update",
                            "default_create" => 1,
                        ]),
                        new Permission([
                            "name" => "Supprimer",
                            "guard" => "station-delete",
                            "default_create" => 1,
                        ]),
                    ]
                ],
                [
                    "name" => "Bon de chargement",
                    "guard" => "loadingslip",
                    "default_create" => 1,
                    "type_company" => "petroleum",
                    "permissions" => [
                        new Permission([
                            "name" => "Voir",
                            "guard" => "loadingslip-view",
                            "default_create" => 1,
                        ]),
                        new Permission([
                            "name" => "Creer",
                            "guard" => "loadingslip-create",
                            "default_create" => 1,
                        ]),
                        new Permission([
                            "name" => "Modifier",
                            "guard" => "loadingslip-update",
                            "default_create" => 1,
                        ]),
                        new Permission([
                            "name" => "Supprimer",
                            "guard" => "loadingslip-delete",
                            "default_create" => 1,
                        ]),
                    ]
                ],
                [
                    "name" => "Livraison",
                    "guard" => "delivery",
                    "default_create" => 1,
                    "type_company" => "petroleum",
                    "permissions" => [
                        new Permission([
                            "name" => "Voir",
                            "guard" => "delivery-view",
                            "default_create" => 1,
                        ]),
                        new Permission([
                            "name" => "Creer",
                            "guard" => "delivery-create",
                            "default_create" => 1,
                        ]),
                        new Permission([
                            "name" => "Modifier",
                            "guard" => "delivery-update",
                            "default_create" => 1,
                        ]),
                        new Permission([
                            "name" => "Supprimer",
                            "guard" => "delivery-delete",
                            "default_create" => 1,
                        ]),
                    ]
                ],
                [
                    "name" => "Camion",
                    "guard" => "truck",
                    "default_create" => 1,
                    "type_company" => "transporter",
                    "permissions" => [
                        new Permission([
                            "name" => "Voir",
                            "guard" => "truck-view",
                            "default_create" => 1,
                        ]),
                        new Permission([
                            "name" => "Creer",
                            "guard" => "truck-create",
                            "default_create" => 1,
                        ]),
                        new Permission([
                            "name" => "Modifier",
                            "guard" => "truck-update",
                            "default_create" => 1,
                        ]),
                        new Permission([
                            "name" => "Supprimer",
                            "guard" => "truck-delete",
                            "default_create" => 1,
                        ]),
                    ]
                ],
            ];
            
            foreach ($data as $item) {
                $feat = \App\Gpp\Features\Feature::create($item);
                $feat->permissions()->saveMany($item["permissions"]);
            }

            DB::commit();
            return 0;
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        } 
    }
}
