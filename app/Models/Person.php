<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'persons';
    
    protected $fillable = ['code','cedula','apellidos', 'nombres', 'telefono', 'direccion', 'email'];
}
