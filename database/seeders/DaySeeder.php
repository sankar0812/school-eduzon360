<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $days = [
            ['day_name' => 'Monday', 'day_status' => 1, 'day_delete' => 1],
            ['day_name' => 'Tuesday', 'day_status' => 1, 'day_delete' => 1],
            ['day_name' => 'Wednesday', 'day_status' => 1, 'day_delete' => 1],
            ['day_name' => 'Thursday', 'day_status' => 1, 'day_delete' => 1],
            ['day_name' => 'Friday', 'day_status' => 1, 'day_delete' => 1],
            ['day_name' => 'Saturday', 'day_status' => 0, 'day_delete' => 1],
            ['day_name' => 'Sunday', 'day_status' => 0, 'day_delete' => 1],
        ];
        DB::table('days')->insert($days);
    }
}
