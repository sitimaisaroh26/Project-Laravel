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
        Schema::create('lulusan', function (Blueprint $table) {
            $table->id();
            $table->string('gambar');
            $table->string('NIM')->unique();
            $table->string('Nama');
            $table->string('ProgramStudi');
            $table->string('IPK');
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
        Schema::dropIfExists('lulusan');
    }
};