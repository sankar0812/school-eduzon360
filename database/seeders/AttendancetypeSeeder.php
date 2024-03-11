<?php

namespace Database\Seeders;

use App\Models\Attendancetype;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AttendancetypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('attendancetypes')->delete();
        $attendance = [
            ['tt_id' => 1, 'tt_name' => 'Present'],
            ['tt_id' => 2, 'tt_name' => 'Absent'],
            // ['tt_id' => 3, 'tt_name' => 'First_Half'],
            // ['tt_id' => 4, 'tt_name' => 'Second_Half'],
        ];
        Attendancetype::insert($attendance);
    }
}
