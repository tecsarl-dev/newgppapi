<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->uuid('code')->unique();
            $table->string('qr_code')->nullable();
            $table->string('delivery_type');
            $table->string('delivery_number');
            $table->string('delivery_number_code')->unique();
            $table->boolean('is_published')->default(0);
            $table->string('delivery_receiver');
            $table->string('customer_name')->nullable();
            $table->foreignId("commune_start_id")->constrained("communes");
            $table->foreignId("commune_end_id")->constrained("communes");
            $table->foreignId("locality_start_id")->constrained("localities");
            $table->foreignId("locality_end_id")->constrained("localities");
            $table->foreignId("loading_slip_id")->constrained("loading_slips");
            $table->foreignId("station_id")->nullable()->constrained("stations");
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
        Schema::dropIfExists('deliveries');
    }
}
