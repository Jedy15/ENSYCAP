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
            $table->unsignedBigInteger('evento_id');
            $table->unsignedBigInteger('personal_id');
            $table->boolean('asistencia')->nullable()->default(false);
            $table->boolean('acredita')->nullable()->default(false);
            $table->string('constancia', 20)->nullable();
            $table->string('libro', 20)->nullable();

            $table->timestamps();
            
            $table->foreign('evento_id')->references('id')->on('events');

            $table->foreign('personal_id')->references('id')->on('tblpersonal');
           
            $table->primary(['evento_id', 'personal_id']);
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
