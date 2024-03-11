<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MonthSeeder extends Seeder
{
    public function run()
    {
        //
        DB::table('months')->delete();
        $months = [
            ['month' => 1, 'monthName' => 'January'],
            ['month' => 2, 'monthName' => 'February'],
            ['month' => 3, 'monthName' => 'March'],
            ['month' => 4, 'monthName' => 'April'],
            ['month' => 5, 'monthName' => 'May'],
            ['month' => 6, 'monthName' => 'June'],
            ['month' => 7, 'monthName' => 'July'],
            ['month' => 8, 'monthName' => 'August'],
            ['month' => 9, 'monthName' => 'September'],
            ['month' => 10, 'monthName' => 'October'],
            ['month' => 11, 'monthName' => 'November'],
            ['month' => 12, 'monthName' => 'December'],
        ];
        DB::table('months')->insert($months);
    }
}
