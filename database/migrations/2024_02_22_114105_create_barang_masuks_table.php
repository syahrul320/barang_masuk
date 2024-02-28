<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangMasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_masuks', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah_barang_masuk');
            $table->date('tanggal_masuk');
            $table->foreignId('id_produk')->references('id')->on('produks')->onDelete('cascade');
            $table->foreignId('id_kategori')->references('id')->on('kategoris')->onDelete('cascade')->nullable();
            $table->foreignId('id_rasa')->references('id')->on('rasas')->onDelete('cascade')->nullable();
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
        Schema::dropIfExists('barang_masuks');
    }
}
