<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registered_user_id')->unique();
            $table->foreignId('sede_ppal')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('registered_user_id')
                ->references('id')->on('registered_users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('sede_ppal')
                ->references('id')->on('addrs')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producers');
    }
}
