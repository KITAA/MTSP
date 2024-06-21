<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aktivitis', function (Blueprint $table) {
            $table->id();
            $table->string('tajuk_aktiviti');
            $table->string('gambar_aktiviti');
            $table->date('tarikh_aktiviti');
            $table->string('masa_mula');
            $table->string('masa_tamat');
            $table->string('tempat_aktiviti');
            $table->longText('deskripsi_aktiviti');
            $table->foreignId('user_id')->constrained(); //untuk tengok siapa post aktiviti ni
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktivitis');
    }
};
