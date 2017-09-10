<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNategasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nategas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('studentNum');
            $table->string('studentName');
            $table->float('Arabic');
            $table->float('English');
            $table->float('French');
            $table->float('Spanish');
            $table->float('Math');
            $table->float('Geometry');
            $table->float('Science');
            $table->float('Computers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nategas');
    }
}
