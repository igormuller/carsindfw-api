<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBodyTypeIdOnCarModelDescriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('car_model_descriptions', function (Blueprint $table) {
            $table->unsignedBigInteger('body_type_id')->after('year')->nullable();
            $table->foreign('body_type_id')->references('id')->on('body_types');
            $table->dropColumn('body_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
