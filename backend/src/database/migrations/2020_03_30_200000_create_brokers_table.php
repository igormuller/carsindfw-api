<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrokersTable extends Migration
{
    public function up()
    {
        Schema::create('brokers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->string('name', 100);
            $table->string('document', 20);
            $table->string('phone', 20);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    public function down()
    {
        Schema::dropIfExists('brokers');
    }
}
