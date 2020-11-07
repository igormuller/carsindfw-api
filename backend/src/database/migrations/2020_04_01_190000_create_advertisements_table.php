<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementsTable extends Migration
{
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('car_make_id');
            $table->unsignedBigInteger('car_model_id');
            $table->unsignedBigInteger('car_model_description_id');
            $table->enum('type', ['new', 'used'])->default('used');
            $table->string('year',9);
            $table->string('trim');
            $table->enum('body_type', ['convertible','coupe','hatchback','minivan','sedan','suv','truck','van','wagon']);
            $table->integer('transmission')->nullable();
            $table->enum('transmission_type',['manual','automatic','cvt','evt','direct_drive','shiftable_automatic','automated_manual'])->nullable();
            $table->enum('drive_type', ['AWD','4WD','FWD','RWD'])->nullable();
            $table->string('color_ext',30)->nullable();
            $table->string('color_int', 30)->nullable();
            $table->enum('fuel_type',['gas','diesel','electric','hybrid','flex_fuel','natural_gas']);
            $table->string('engine');
            $table->integer('seats')->nullable();
            $table->integer('doors')->nullable();
            $table->string('features')->nullable();
            $table->decimal('value_estimate', 10,2)->nullable();
            $table->string('vin_number', 17);
            $table->string('miles', 35);
            $table->text('description')->nullable();
            $table->decimal('value', 10,2);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('car_make_id')->references('id')->on('car_makes');
            $table->foreign('car_model_id')->references('id')->on('car_models');
            $table->foreign('car_model_description_id')->references('id')->on('car_model_descriptions');
            $table->index(['car_model_id','year']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('advertisements');
    }
}
