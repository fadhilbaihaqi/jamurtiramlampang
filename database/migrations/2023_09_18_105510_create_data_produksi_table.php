<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_produksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stok_bibit_id');
            $table->foreign('stok_bibit_id')->references('id')->on('stok_bibit');
            $table->integer('hasil_produksi');
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
        Schema::dropIfExists('data_produksi');
    }
};
