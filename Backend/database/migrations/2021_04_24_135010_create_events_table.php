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
            $table->foreignId('producer_id');
            $table->foreignId('addr_id');
            $table->date('fecha');
            $table->time('hora');
            $table->integer('duracion');
            $table->enum('state', ['pendiente','en_curso','cancelado','terminado'])->default('pendiente');
            $table->timestamps();

            $table->foreign('producer_id')
                ->references('id')->on('producers')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('addr_id')
                ->references('id')->on('addrs')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
