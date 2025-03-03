<?php

namespace Database\Seeders\Job;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('albumes')->insert([
            'titulo'        => 'GRADUCIÓN',
            'descripcion'   => 'El momento mas importe de mi linea de estudiante.',
            'usuario_id'    => 1,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
        DB::table('albumes')->insert([
            'titulo'        => 'VACACIONES EN LIMA',
            'descripcion'   => 'Disfrutando de mis vacaciones en Lima.',
            'usuario_id'    => 1,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
        DB::table('albumes')->insert([
            'titulo'        => 'PASANTIA',
            'descripcion'   => 'Disfrutando de mi pasantia.',
            'usuario_id'    => 1,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
    }
}
