<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonstersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monsters', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->integer('ankama_id');
            $table->string('type');
            $table->string('img_url');
            $table->string('infos_url');
            $table->integer('pv_min')->nullable();
            $table->integer('pv_max')->nullable();
            $table->integer('pa');
            $table->integer('pm');
            $table->integer('res_air');
            $table->integer('res_feu');
            $table->integer('res_eau');
            $table->integer('res_terre');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monsters');
    }
}
