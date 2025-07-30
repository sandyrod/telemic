<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inspections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicle_id');
            $table->enum('tire_front_right', ['bueno', 'regular', 'malo']);
            $table->enum('tire_front_left', ['bueno', 'regular', 'malo']);
            $table->enum('tire_rear_right', ['bueno', 'regular', 'malo']);
            $table->enum('tire_rear_left', ['bueno', 'regular', 'malo']);
            $table->enum('fluid_motor', ['bueno', 'regular', 'malo']);
            $table->enum('fluid_steering', ['bueno', 'regular', 'malo']);
            $table->enum('fluid_coolant', ['bueno', 'regular', 'malo']);
            $table->enum('fluid_brake', ['bueno', 'regular', 'malo']);
            $table->integer('km_departure')->nullable();
            $table->integer('km_traveled')->nullable();
            $table->decimal('fuel_current_liters', 8, 2)->nullable();
            $table->decimal('fuel_consumed', 8, 2)->nullable();
            $table->decimal('fuel_supplied', 8, 2)->nullable();
            $table->decimal('fuel_total', 8, 2)->nullable();
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->timestamps();
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            $table->foreign('provider_id')->references('id')->on('providers')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inspections');
    }
};
