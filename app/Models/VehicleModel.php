<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    protected $table = 'models';
    protected $fillable = [
        'modelo',
        'description',
    ];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'model_id');
    }
}
