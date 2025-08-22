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
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->string('plate_number')->unique();
            $table->enum('status', ['Active', 'Inactive', 'Maintenance'])->default('Active');
            $table->enum('gps_status', ['Online', 'Offline'])->default('Offline');
            $table->dateTime('last_check')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buses');
    }
};
