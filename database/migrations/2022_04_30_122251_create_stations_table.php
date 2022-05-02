<?php

use App\Gpp\Communes\Commune;
use App\Gpp\Localities\Locality;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stations', function (Blueprint $table) {
            $table->id();
            $table->string("code_company")->unique();
            $table->string("code");
            $table->string("name");
            $table->date("date_commissioning_station");
            $table->string("reference_authorization_construction");
            $table->foreignIdFor(Commune::class,"commune_id");
            $table->foreignIdFor(Locality::class,"locality_id");
            $table->boolean("is_active")->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stations');
    }
}
