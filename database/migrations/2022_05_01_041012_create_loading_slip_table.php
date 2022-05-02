 <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoadingSlipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loading_slips', function (Blueprint $table) {
            $table->id();
            $table->uuid('code');
            $table->string('qr_code');
            $table->string('loading_type');
            $table->string('driver_name');
            $table->string('driver_tel');
            $table->string('ref_avd')->nullable();
            $table->string('ref_other')->nullable();
            $table->boolean('is_published')->default(0);
            $table->foreignId("depot_id")
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId("transporter_id")
                ->constrained("companies","id")
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId("truck_id")->constrained("trucks","id")
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId("truck_trailer_id")->nullable()->constrained("trucks")
                ->restrictOnDelete()
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
        Schema::dropIfExists('loading_slips');
    }
}
