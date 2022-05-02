<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->enum('type_company',['transporter','petroleum','gpp','super-c']);
            $table->string('name');
            $table->string('ifu');
            $table->string('rccm');
            $table->string('social_capital')->nullable();
            $table->foreignId('legal_form_id')->constrained('legal_forms');
            $table->string('email');
            $table->string('phone');
            $table->string('address_physical')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
