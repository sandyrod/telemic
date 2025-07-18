<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleExpenses extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //ENCENDIDO
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Bobina de Encendido',
            'descripcion' => 'Bobina de Encendido',
            'vehicle_system_id' => 1,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Distribuidor',
            'descripcion' => 'Distribuidor',
            'vehicle_system_id' => 1,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Rotor',
            'descripcion' => 'Rotor',
            'vehicle_system_id' => 1,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Bujias',
            'descripcion' => 'Bujias',
            'vehicle_system_id' => 1,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Alternador',
            'descripcion' => 'Alternador',
            'vehicle_system_id' => 1,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Baterias',
            'descripcion' => 'Baterias',
            'vehicle_system_id' => 1,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Kit de Correa de Tiempo',
            'descripcion' => 'Kit de Correa de Tiempo',
            'vehicle_system_id' => 1,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Arranque',
            'descripcion' => 'Arranque',
            'vehicle_system_id' => 1,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Mano de Obra Sistema de Encendido',
            'descripcion' => 'Mano de Obra Sistema de Encendido',
            'vehicle_system_id' => 1,
        ]);

        // SUSPENSION
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Cauchos',
            'descripcion' => 'Cauchos',
            'vehicle_system_id' => 2,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Barras Estabilizadoras',
            'descripcion' => 'Barras Estabilizadoras',
            'vehicle_system_id' => 2,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Espirales',
            'descripcion' => 'Espirales',
            'vehicle_system_id' => 2,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Amortiguadores',
            'descripcion' => 'Amortiguadores',
            'vehicle_system_id' => 2,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Mano de Obra Sistema de Suspension',
            'descripcion' => 'Mano de Obra Sistema de Suspension',
            'vehicle_system_id' => 2,
        ]);

        // DIRECCION
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Bomba Hidraulica',
            'descripcion' => 'Bomba Hidraulica',
            'vehicle_system_id' => 3,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Terminales',
            'descripcion' => 'Terminales',
            'vehicle_system_id' => 3,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Brazo Pitman',
            'descripcion' => 'Brazo Pitman',
            'vehicle_system_id' => 3,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Barra de Direccion',
            'descripcion' => 'Barra de Direccion',
            'vehicle_system_id' => 3,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Rotulas',
            'descripcion' => 'Rotulas',
            'vehicle_system_id' => 3,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Mesetas',
            'descripcion' => 'Mesetas',
            'vehicle_system_id' => 3,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Bujes de Meseta',
            'descripcion' => 'Bujes de Meseta',
            'vehicle_system_id' => 3,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Rodamientos',
            'descripcion' => 'Rodamientos',
            'vehicle_system_id' => 3,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Mozos',
            'descripcion' => 'Mozos',
            'vehicle_system_id' => 3,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Muñones',
            'descripcion' => 'Muñones',
            'vehicle_system_id' => 3,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Alineacion',
            'descripcion' => 'Alineacion',
            'vehicle_system_id' => 3,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Puntas de Tripoides',
            'descripcion' => 'Puntas de Tripoides',
            'vehicle_system_id' => 3,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Estoperas',
            'descripcion' => 'Estoperas',
            'vehicle_system_id' => 3,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Mano de Obra Sistema de Direccion',
            'descripcion' => 'Mano de Obra Sistema de Direccion',
            'vehicle_system_id' => 3,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Valvulina',
            'descripcion' => 'Valvulina',
            'vehicle_system_id' => 3,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Alineacion Tren delantero',
            'descripcion' => 'Alineacion Tren delantero',
            'vehicle_system_id' => 3,
        ]);
        
        // TRANSMISION
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Baner Kit',
            'descripcion' => 'Baner Kit',
            'vehicle_system_id' => 4,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Banda de Caja',
            'descripcion' => 'Banda de Caja',
            'vehicle_system_id' => 4,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Filtro de Caja',
            'descripcion' => 'Filtro de Caja',
            'vehicle_system_id' => 4,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Bocina de Caja',
            'descripcion' => 'Bocina de Caja',
            'vehicle_system_id' => 4,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Bocina de Casco',
            'descripcion' => 'Bocina de Casco',
            'vehicle_system_id' => 4,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Mano de Obra Sistema de Transmision',
            'descripcion' => 'Mano de Obra Sistema de Transmision',
            'vehicle_system_id' => 4,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Kit de embrague',
            'descripcion' => 'Kit de embrague',
            'vehicle_system_id' => 4,
        ]);
        
        // FRENOS
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Bomba de Frenos',
            'descripcion' => 'Bomba de Frenos',
            'vehicle_system_id' => 5,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Cilindros',
            'descripcion' => 'Cilindros',
            'vehicle_system_id' => 5,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Caliper',
            'descripcion' => 'Caliper',
            'vehicle_system_id' => 5,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Mordaza',
            'descripcion' => 'Mordaza',
            'vehicle_system_id' => 5,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Pastillas',
            'descripcion' => 'Pastillas',
            'vehicle_system_id' => 5,
        ]);

        // INYECCION
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Computadora',
            'descripcion' => 'Computadora',
            'vehicle_system_id' => 6,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Filtro de Combustible',
            'descripcion' => 'Filtro de Combustible',
            'vehicle_system_id' => 6,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Bomba de Combustible',
            'descripcion' => 'Bomba de Combustible',
            'vehicle_system_id' => 6,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Cuerpo de Aceleracion',
            'descripcion' => 'Cuerpo de Aceleracion',
            'vehicle_system_id' => 6,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Inyectores',
            'descripcion' => 'Inyectores',
            'vehicle_system_id' => 6,
        ]);
        
        // LUBRICACION
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Bomba de Aceite Motor',
            'descripcion' => 'Bomba de Aceite Motor',
            'vehicle_system_id' => 7,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Filtro de Aceite Motor',
            'descripcion' => 'Filtro de Aceite Motor',
            'vehicle_system_id' => 7,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Mano de Obra Sistema de Lubricacion',
            'descripcion' => 'Mano de Obra Sistema de Lubricacion',
            'vehicle_system_id' => 7,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Aceite de Motor',
            'descripcion' => 'Aceite de Motor',
            'vehicle_system_id' => 7,
        ]);

        // SISTEMA DE MOTOR
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Rectificacion de motor',
            'descripcion' => 'Rectificacion de motor',
            'vehicle_system_id' => 8,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Rectificacion de camara',
            'descripcion' => 'Rectificacion de camara',
            'vehicle_system_id' => 8,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Rectificacion de cigüeñal',
            'descripcion' => 'Rectificacion de cigüeñal',
            'vehicle_system_id' => 8,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Pistones',
            'descripcion' => 'Pistones',
            'vehicle_system_id' => 8,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Kit empacaduras',
            'descripcion' => 'Kit empacaduras',
            'vehicle_system_id' => 8,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Anillos de motor',
            'descripcion' => 'Anillos de motor',
            'vehicle_system_id' => 8,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Mano de obra reparacion de motor',
            'descripcion' => 'Mano de obra reparacion de motor',
            'vehicle_system_id' => 8,
        ]);
        DB::table('vehicleexpenses')->insert([  
            'gasto' => 'Repuesto Conchas de viela y Bancada',
            'descripcion' => 'Repuesto Conchas de viela y Bancada',
            'vehicle_system_id' => 8,
        ]);
        
        // REFRIGERACION
        DB::table('vehicleexpenses')->insert([
            'gasto' => 'Radiador',
            'descripcion' => 'Radiador',
            'vehicle_system_id' => 9,
        ]);
        DB::table('vehicleexpenses')->insert([
            'gasto' => 'Bomba de Agua',
            'descripcion' => 'Bomba de Agua',
            'vehicle_system_id' => 9,
        ]);
        DB::table('vehicleexpenses')->insert([
            'gasto' => 'Electroventilador',
            'descripcion' => 'Electroventilador',
            'vehicle_system_id' => 9,
        ]);
        DB::table('vehicleexpenses')->insert([
            'gasto' => 'Sensor de Temperatura',
            'descripcion' => 'Sensor de Temperatura',
            'vehicle_system_id' => 9,
        ]);
        DB::table('vehicleexpenses')->insert([
            'gasto' => 'Mano de Obra Sistema de Refrigeracion',
            'descripcion' => 'Mano de Obra Sistema de Refrigeracion',
            'vehicle_system_id' => 9,
        ]);
        
        // OTRAS COMPRAS Y/O REPARACIONES
        DB::table('vehicleexpenses')->insert([
            'gasto' => 'Lavado de Vehiculo',
            'descripcion' => 'Lavado de Vehiculo',  
            'vehicle_system_id' => 10,
        ]);
        DB::table('vehicleexpenses')->insert([
            'gasto' => 'Papel Ahumado',
            'descripcion' => 'Papel Ahumado',  
            'vehicle_system_id' => 10,
        ]);
        DB::table('vehicleexpenses')->insert([
            'gasto' => 'Herramienta Mecánico',
            'descripcion' => 'Herramienta Mecánico',  
            'vehicle_system_id' => 10,
        ]);
        DB::table('vehicleexpenses')->insert([
            'gasto' => 'Reparacion Motor',
            'descripcion' => 'Reparacion Motor',  
            'vehicle_system_id' => 10,
        ]);
        DB::table('vehicleexpenses')->insert([
            'gasto' => 'Latoneria y pintura',
            'descripcion' => 'Latoneria y pintura',  
            'vehicle_system_id' => 10,
        ]);
        DB::table('vehicleexpenses')->insert([
            'gasto' => 'Parabrisas',
            'descripcion' => 'Parabrisas',  
            'vehicle_system_id' => 10,
        ]);
        DB::table('vehicleexpenses')->insert([
            'gasto' => 'Sistema elevacion de vidrios',
            'descripcion' => 'Sistema elevacion de vidrios',  
            'vehicle_system_id' => 10,
        ]);
        DB::table('vehicleexpenses')->insert([
            'gasto' => 'Servicio de traslado en gruas',
            'descripcion' => 'Servicio de traslado en gruas',  
            'vehicle_system_id' => 10,
        ]);
        
        
    }
}
