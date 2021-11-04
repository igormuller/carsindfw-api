<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdTeolidaInCarModelDescriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('car_model_descriptions', function (Blueprint $table) {
            $table->integer('id_teolida')->after('car_model_id')->nullable();
            $table->index(['car_model_id', 'trim', 'year']);
            $table->index('id_teolida');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('car_model_descriptions', function (Blueprint $table) {
            $table->dropColumn('id_teolida');
            $table->dropIndex('id_teolida');
        });
    }
}
