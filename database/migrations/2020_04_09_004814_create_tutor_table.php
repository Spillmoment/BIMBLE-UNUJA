<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutor', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tutor', 100);
            $table->text('alamat');
            $table->string('email', 100);
            $table->string('foto', 100)->nullable();
            $table->string('username', 100);
            $table->string('password', 100);
            $table->enum('status', ['1', '0']);
            $table->text('keahlian');
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
        Schema::dropIfExists('tutor');
    }
}
