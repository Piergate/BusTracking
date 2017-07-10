<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('line_id')->index()->nullable();
            $table->string('number')->unique();
            $table->string('license')->unique();
            $table->integer('capacity');
            $table->boolean('complete')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->foreign('line_id')->references('id')->on('lines')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buses');
    }
}
