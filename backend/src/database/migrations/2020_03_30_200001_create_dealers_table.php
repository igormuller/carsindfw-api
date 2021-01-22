<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealersTable extends Migration
{
    public function up()
    {
        Schema::create('dealers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('broker_id')->nullable();
            $table->string('name', 100);
            $table->string('document', 20)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('site', 100)->nullable();
            $table->string('instagram', 100)->nullable();
            $table->string('facebook', 100)->nullable();
            $table->string('profile_path')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('broker_id')->references('id')->on('brokers');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dealers');
    }
}
