<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContainerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('containers', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->enum('jenis', ['fcp', 'hk', 'sa'])->nullable();
            $table->foreignId('sending_id')->nullable();
            $table->foreign("sending_id")->references('id')->on('sending_items')->nullable();
            $table->string('no_seal_container')->nullable();
            $table->enum('type_container', ['dry', 'freeze'])->nullable();
            $table->integer('suhu_sebelum_loading')->nullable();
            $table->integer('suhu_sesudah_loading')->nullable();
            $table->enum('kondisi_fisik', ['baik', 'tidak'])->nullable();
            $table->enum('tidak_berbau_menyengat', ['ya', 'tidak'])->nullable();
            $table->enum('tidak_kotor', ['ya', 'tidak'])->nullable();
            $table->enum('tidak_terdapat_bocor', ['ya', 'tidak'])->nullable();
            $table->enum('status_container', ['release', 'rejected'])->nullable();
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
        Schema::dropIfExists('container');
    }
}
