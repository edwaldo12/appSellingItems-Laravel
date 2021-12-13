<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailSendingItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_sending_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('detail_id')->nullable();
            $table->foreign("detail_id")->references('id')->on('sending_items')->nullable();
            $table->string("photo")->nullable();
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
        Schema::dropIfExists('detail_sending_items');
    }
}
