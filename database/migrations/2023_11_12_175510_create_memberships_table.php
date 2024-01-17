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
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('fullname');
            $table->string('email');
            $table->foreign('email')->references('email')->on('users');
            $table->string('ic');
            $table->text('address');
            $table->string('phone');
            $table->string('emergency_no');
            $table->enum('status', ['Aktif', 'Tamat tempoh', 'Dalam proses', 'Dilucutkan'])->default('Dalam proses');
            $table->double('membershipDuration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
