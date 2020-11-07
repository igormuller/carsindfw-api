<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->dateTime('started_at');
            $table->dateTime('finished_at');
            $table->enum('status', ['opened', 'warning', 'waiting_payment', 'encerred']);
            $table->unsignedBigInteger('plan_type_id');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('plan_type_id')->references('id')->on('plan_types');
        });
    }

    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
