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
        Schema::create('vehicleexpenses', function (Blueprint $table) {
            $table->id();
            $table->string('gasto');
            $table->string('descripcion');
            $table->unsignedBigInteger('vehicle_system_id');
            $table->foreign('vehicle_system_id')->references('id')->on('vehicle_systems')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicleexpenses');
    }
};
