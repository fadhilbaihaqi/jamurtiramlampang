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
        Schema::create('kelola_pemesanan', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah_pemesanan');
            $table->text('alamat');
            $table->string('no_hp');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('stok_bibit_id');
            $table->foreign('stok_bibit_id')->references('id')->on('stok_bibit');
            $table->integer('status')->default(0);
            $table->string('upload')->nullable();
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
        Schema::dropIfExists('kelola_pemesanan');
    }
};
