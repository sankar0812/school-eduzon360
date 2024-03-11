<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Hashpass;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuperadminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            $userData = [

                'name' => 'Superadmin',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('IdeauxITcompany@2022'),
                'superadmin' => 1,
                'type' => 1,
                'status' => 1,
                'delete' => 1,

            ];
            $user =  User::insertGetId($userData);


            $hashData = [
                'loginid' => $user,
                'ha_name' => 'IdeauxITcompany@2022',
                'ha_status' => 1,
                'ha_delete' => 1,

            ];
            
            Hashpass::create($hashData);
            echo "Records inserted successfully!";
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
