<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTruckTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trucks', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['tractor','trailer','all-in-one']);
            $table->string('capacity')->nullable();
            $table->string('registration_number')->unique();
            $table->string('taxation')->nullable();
            $table->date('taxation_date_validity')->nullable();
            $table->boolean('is_active')->default(1);
            $table->boolean('is_submit')->default(0);
            $table->foreignId('transporter_id')->constrained('companies');
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
        Schema::dropIfExists('trucks');
    }
}
