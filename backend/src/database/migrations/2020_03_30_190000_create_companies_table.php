<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('type', ['person', 'dealer', 'broker'])->default('dealer');
            $table->unsignedBigInteger('plan_type_id');
            $table->boolean('blocked')->nullable();
            $table->string('stripe_id', 50)->nullable();
            $table->timestamps();
            $table->foreign('plan_type_id')->references('id')->on('plan_types');
        });
    }

    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
