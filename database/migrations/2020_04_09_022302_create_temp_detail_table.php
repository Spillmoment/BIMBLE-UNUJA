<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_order', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_pendaftar');
            $table->foreign('id_pendaftar')->references('id')->on('pendaftar')->onDelete('cascade');
            
            $table->integer('total_tagihan');
            $table->string('bukti_pembayaran', 100)->nullable();
            $table->enum('status', ['PENDING', 'SUCCESS' , 'PROCESS', 'CANCEL' ,'FAILED']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temp_detail');
    }
}
