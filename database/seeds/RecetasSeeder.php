<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecetasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recetas')->insert([
            'titulo' => 'Pollo al Horno',
            'ingredientes' => 'Pollo, pasta de ajo, agual, sal, etc...',
            'preparacion' => 'calentar el horno a 180° Celcius por 7 minutos',
            'imagen' => 'pollo.jpg',
            'user_id' => '1',
            'categoria_id' => '3',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('recetas')->insert([
            'titulo' => 'Papas Asadas',
            'ingredientes' => 'Papas, pasta de ajo, agual, sal, etc...',
            'preparacion' => 'calentar el horno a 120° Celcius por 4 minutos',
            'imagen' => 'papas.jpg',
            'user_id' => '1',
            'categoria_id' => '2',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('recetas')->insert([
            'titulo' => 'Pescado frito',
            'ingredientes' => 'cualquier tipo de pescado , pasta de ajo, agual, sal, etc...',
            'preparacion' => 'calentar el aceite a 180° Celcius por 7 minutos',
            'imagen' => 'pescado-frito.jpg',
            'user_id' => '1',
            'categoria_id' => '4',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('recetas')->insert([
            'titulo' => 'Res a la cacerola',
            'ingredientes' => 'cualquier corte de res, pasta de ajo, agual, sal, etc...',
            'preparacion' => 'calentar el agua a 180° Celcius por 7 minutos',
            'imagen' => 'res.jpg',
            'user_id' => '1',
            'categoria_id' => '2',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
