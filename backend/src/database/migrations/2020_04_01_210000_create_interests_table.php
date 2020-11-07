<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterestsTable extends Migration
{
    public function up()
    {
        Schema::create('interests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('advertisement_id');
            $table->string('name', 100);
            $table->string('email', 100);
            $table->string('phone', 20);
            $table->text('description');
            $table->enum('status', ['wait_answer', 'answered'])->default('wait_answer');
            $table->timestamps();
            $table->foreign('advertisement_id')->references('id')->on('advertisements');
        });
    }

    public function down()
    {
        Schema::dropIfExists('interests');
    }
}
