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
        Schema::create('tanggungans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('membership_id')->constrained('memberships');
            $table->string('fullname');
            $table->string('ic');
            $table->string('relationship');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanggungans');
    }
};
