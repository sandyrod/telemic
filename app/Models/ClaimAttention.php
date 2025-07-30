<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClaimAttention extends Model
{
    protected $table = 'claim_attentions';

    protected $fillable = [
        'ciudad',
        'abonado',
        'servicio',
        'subnodo',
        'fecha_ingreso',
        'hora_inicio',
        'fecha_finalizacion',
        'hora_final',
        'tiempo_atencion',
        'causa_falla',
        'tecnicos',
        'observacion',
        'tipo_orden',
        'descarga_materiales',
        'nap',
        'puerto',
        'feeder',
        'tipo_reclamo',
    ];

    protected $casts = [
        'fecha_ingreso' => 'date',
        'fecha_finalizacion' => 'date',
        'hora_inicio' => 'datetime',
        'hora_final' => 'datetime',
    ];
}
