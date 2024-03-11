<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClasstimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classtime = [
            ['classsection' => 'FN', 'classname' => '9.00 to 9.45',],
            ['classsection' => 'FN', 'classname' => '9.45 to 10.30',],
            ['classsection' => 'FN', 'classname' => '10.45.00 to 11.30',],
            ['classsection' => 'FN', 'classname' => '11.30 to 12.15',],
            ['classsection' => 'AN', 'classname' => '1.00 to 1.45',],
            ['classsection' => 'AN', 'classname' => '1.45 to 2.30',],
            ['classsection' => 'AN', 'classname' => '2.30 to 3.00',],
            ['classsection' => 'AN', 'classname' => '3.00 to 3.30',],

        ];
        DB::table('dailyclasstimes')->insert($classtime);
    }
}
