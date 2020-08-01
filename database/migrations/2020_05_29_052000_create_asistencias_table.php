<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            $table->boolean('asistencia')->nullable()->default(false);
            $table->boolean('acredita')->nullable()->default(false);
            $table->bigInteger('constancia')->nullable();
            $table->bigInteger('libro')->nullable();
            $table->unsignedBigInteger('event_id');
            $table->Integer('personal_id');

            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('personal_id')->references('IdPersonal')->on('tblpersonal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asistencias');
    }
}
