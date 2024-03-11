<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ExamtimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('examtimes')->delete();
        $months = [
            ['et_id' => 1, 'et_name' => 'FN', 'time' => '9.30am to 12.30pm'],
            ['et_id' => 2, 'et_name' => 'AN', 'time' => '1.30pm to 4.30pm'],

        ];
        DB::table('examtimes')->insert($months);
    }
}
