<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\VarDumper\Cloner\Data;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * para correr los seeder lo hacermos con CLI de artisan -> php artisan db:seed
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Antonieta',
            'email' => 'antonieta@gmail.cl',
            'password' => Hash::make('12345678'),
            'url' => 'http://www.camila.cl/',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'name' => 'Cristobal',
            'email' => 'Cristobal@gmail.cl',
            'password' => Hash::make('12345678'),
            'url' => 'http://www.cr.cl/',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'name' => 'Camila',
            'email' => 'camila@gmail.cl',
            'password' => Hash::make('12345678'),
            'url' => 'http://www.preciosa-camila.cl/',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
