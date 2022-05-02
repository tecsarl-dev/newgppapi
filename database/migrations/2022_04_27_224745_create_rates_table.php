<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('unit_price');
            $table->boolean('is_active')->default(0);
            $table->foreignId('product_id');
            $table->foreignId('locality_start_id')->constrained('localities');
            $table->foreignId('commune_end_id')->constrained('communes');
            $table->foreignId('locality_end_id')->constrained('localities');
            $table->foreignId('commune_start_id')->constrained('communes');
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
        Schema::dropIfExists('rates');
    }
}
