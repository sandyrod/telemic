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
        Schema::create('claim_attentions', function (Blueprint $table) {
            $table->id();
            $table->string('ciudad')->nullable();
            $table->string('abonado')->nullable();
            $table->string('servicio')->nullable();
            $table->string('subnodo')->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->time('hora_inicio')->nullable();
            $table->date('fecha_finalizacion')->nullable();
            $table->time('hora_final')->nullable();
            $table->string('tiempo_atencion')->nullable();
            $table->text('causa_falla')->nullable();
            $table->string('tecnicos')->nullable();
            $table->text('observacion')->nullable();
            $table->string('tipo_orden')->nullable();
            $table->enum('descarga_materiales', ['si', 'no'])->nullable();
            $table->string('nap')->nullable();
            $table->string('puerto')->nullable();
            $table->string('feeder')->nullable();
            $table->enum('tipo_reclamo', [
                'Fibrahogar', 
                'Instalaciones/Reconexiones', 
                'Morosidad/Bajas Voluntarias'
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claim_attentions');
    }
};
