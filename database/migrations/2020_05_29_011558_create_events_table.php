<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('place', 150);
            $table->dateTime('start');
            $table->dateTime('end')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->string('color', 45)->nullable()->default('rgb(2, 117, 216)');

            $table->string('CLUES', 11)->collation('latin1_swedish_ci');
            $table->foreign('CLUES')->references('CLUES')->on('t_catalogo_clues');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
