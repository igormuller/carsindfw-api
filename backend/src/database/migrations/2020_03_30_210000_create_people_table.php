<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->string('name', 100);
            $table->string('document');
            $table->string('phone', 20)->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    public function down()
    {
        Schema::dropIfExists('people');
    }
}
