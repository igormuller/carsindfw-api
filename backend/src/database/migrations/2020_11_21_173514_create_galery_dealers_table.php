<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGaleryDealersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galery_dealers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('dealer_id');
            $table->string('name', 50)->nullable();
            $table->string('path');
            $table->string('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('dealer_id')->references('id')->on('dealers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('galery_dealers');
    }
}
