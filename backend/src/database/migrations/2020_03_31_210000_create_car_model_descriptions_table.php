<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarModelDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_model_descriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('car_model_id');
            $table->string("trim");
            $table->string('year', 4);
            $table->enum('body_type', ['convertible','coupe','hatchback','minivan','sedan','suv','truck','van','wagon']);
            $table->integer('seats')->nullable();
            $table->integer('cylinder')->nullable();
            $table->enum('cylinder_type', ['l','v','w','flat','rotary','i','inline'])->nullable();
            $table->decimal('engine_size', 2,1)->nullable();
            $table->integer('horsepower')->nullable();
            $table->enum('drive_type', ['AWD','4WD','FWD','RWD'])->nullable();
            $table->integer('transmission')->nullable();
            $table->enum('transmission_type',['manual','automatic','cvt','evt','direct_drive','shiftable_automatic','automated_manual'])->nullable();
            $table->enum('fuel_type',['gas','diesel','electric','hybrid','flex_fuel','natural_gas']);
            $table->integer('epa_mileage_city')->nullable();
            $table->integer('epa_mileage_street')->nullable();
            $table->timestamps();
            $table->foreign('car_model_id')->references('id')->on('car_models');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_model_descriptions');
    }
}
