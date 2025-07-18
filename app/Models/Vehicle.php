<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'brand_id',
        'model_id',
        'placa',
        'anio',
    ];

    public function brand()
{
    return $this->belongsTo(Brand::class);
}

    public function model()
    {
        return $this->belongsTo(VehicleModel::class);
    }
}
