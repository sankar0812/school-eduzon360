<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StaffpositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('staffpositions')->delete();
        $postion = [
            ['sp_id' => 1, 'sp_name' => 'Teaching Staff'],
            ['sp_id' => 2, 'sp_name' => 'NON Teaching Staff'],
            ['sp_id' => 3, 'sp_name' => 'Cleaning Staff'],
            ['sp_id' => 4, 'sp_name' => 'Driver Staff'],
        ];
        DB::table('staffpositions')->insert($postion);
    }
}
