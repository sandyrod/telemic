<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class vehicleexpense extends Model
{
    protected $fillable = [
        'gasto',
        'descripcion',
        'vehicle_system_id',
    ];

    public function vehicleSystem()
    {
        return $this->belongsTo(VehicleSystem::class);
    }
}   
