<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     DB::table('classes')->insert([  
        'nom' => 'SIL',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
     DB::table('classes')->insert([
        'nom' => 'CP',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    DB::table('classes')->insert([
        'nom' => 'CE1',
         'created_at' => now(),
         'updated_at' => now(),
     ]);
     DB::table('classes')->insert([
        'nom' => 'CE2',
         'created_at' => now(),
         'updated_at' => now(),
     ]);
     DB::table('classes')->insert([
        'nom' => 'CM1',
         'created_at' => now(),
         'updated_at' => now(),
     ]);
     DB::table('classes')->insert([
        'nom' => 'CM2',
         'created_at' => now(),
         'updated_at' => now(),
     ]);
    }
}
