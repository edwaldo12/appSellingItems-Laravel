<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SendingItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sending_items', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->enum('jenis', ['fcp', 'hk', 'sa'])->nullable();
            $table->bigInteger('no_container')->nullable();
            $table->bigInteger('plat_nomor')->nullable();
            $table->bigInteger('po')->nullable();
            $table->foreignId('good_id')->nullable();
            $table->foreign("good_id")->references('id')->on('goods')->nullable();
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
        //
    }
}
