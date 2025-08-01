<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    protected $fillable = ['code','description'];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
