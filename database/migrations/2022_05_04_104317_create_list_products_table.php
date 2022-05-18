<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_products', function (Blueprint $table) {
            $table->id();
            $table->string("product_name");
            $table->string("quantity");
            $table->string("measure_symbol");
            $table->string("package_quantity");
            $table->foreignId("measure_id")->nullable()->constrained("measures");
            $table->foreignId("package_id")->nullable()->constrained("packages");
            $table->foreignId("product_id")->nullable()->constrained("products");
            $table->foreignId("loading_slip_id")->nullable()->constrained("loading_slips")
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId("delivery_id")->nullable()->constrained("deliveries")
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
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
        Schema::dropIfExists('list_products');
    }
}
