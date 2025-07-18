<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleSystem extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vehicle_systems')->insert([
            'sistema' => 'ENCENDIDO',
            'descripcion' => 'ENCENDIDO',
        ]);
        DB::table('vehicle_systems')->insert([
            'sistema' => 'SUSPENSION',
            'descripcion' => 'SUSPENSION',
        ]);
        DB::table('vehicle_systems')->insert([
            'sistema' => 'DIRECCION',
            'descripcion' => 'DIRECCION',
        ]);
        DB::table('vehicle_systems')->insert([
            'sistema' => 'TRANSMISION',
            'descripcion' => 'TRANSMISION',
        ]);
        DB::table('vehicle_systems')->insert([
            'sistema' => 'FRENOS',
            'descripcion' => 'FRENOS',
        ]);
        DB::table('vehicle_systems')->insert([
            'sistema' => 'REFRIGERACION',
            'descripcion' => 'REFRIGERACION',
        ]);
        DB::table('vehicle_systems')->insert([
            'sistema' => 'SISTEMAS DE MOTOR',
            'descripcion' => 'SISTEMAS DE MOTOR',
        ]);
        DB::table('vehicle_systems')->insert([
            'sistema' => 'INYECCION',
            'descripcion' => 'INYECCION',
        ]);
        DB::table('vehicle_systems')->insert([
            'sistema' => 'LUBRICACION',
            'descripcion' => 'LUBRICACION',
        ]);
        DB::table('vehicle_systems')->insert([
            'sistema' => 'OTRAS COMPRAS Y/O REPARACIONES',
            'descripcion' => 'OTRAS COMPRAS Y/O REPARACIONES',
        ]);
    }
}
