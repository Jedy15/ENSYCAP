<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('event_id');

            $table->unsignedBigInteger('curso_id');

            $table->unsignedBigInteger('ponente_id');

            $table->foreign('event_id')->references('id')->on('events');

            $table->foreign('curso_id')->references('id')->on('cursos');

            $table->foreign('ponente_id')->references('id')->on('ponentes');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temas');
    }
}
