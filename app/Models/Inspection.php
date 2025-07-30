<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    protected $fillable = [
        'vehicle_id',
        'tire_front_right',
        'tire_front_left',
        'tire_rear_right',
        'tire_rear_left',
        'fluid_motor',
        'fluid_steering',
        'fluid_coolant',
        'fluid_brake',
        'km_departure',
        'km_traveled',
        'fuel_current_liters',
        'fuel_consumed',
        'fuel_supplied',
        'fuel_total',
        'provider_id',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
}
