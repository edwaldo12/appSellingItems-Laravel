<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk')->nullable();
            $table->string('nomor_produk')->nullable();
            $table->string('satuan')->nullable();
            $table->date('tanggal')->nullable();
            $table->enum('jenis', ['FCP', 'HK', 'SA'])->nullable();
            $table->string('batch')->nullable();
            $table->bigInteger('po')->nullable();
            $table->bigInteger('bs')->nullable();
            $table->enum('priority_check', ['1', '2', '3'])->nullable();
            $table->bigInteger('sampling')->nullable();
            $table->bigInteger('release')->nullable();
            $table->bigInteger('rejected')->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('goods');
    }
}
