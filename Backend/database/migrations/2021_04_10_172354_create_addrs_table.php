<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addrs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registered_user_id');
            $table->string('country', 50)->default('Colombia');
            $table->string('province', 50);
            $table->string('city', 50);
            $table->string('street', 50);
            $table->string('location', 50)->nullable();
            $table->string('etiqueta', 50)->nullable();
            $table->timestamps();

            $table->foreign('registered_user_id')
                ->references('id')->on('registered_users')
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
        Schema::dropIfExists('addrs');
    }
}
