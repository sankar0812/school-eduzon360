<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Hashpass;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            $userData = [
                'name' => 'Admin',
                'email' => 'schooladmin@gmail.com',
                'password' => Hash::make('963963963'),
                'superadmin' => 0,
                'type' => 1,
                'status' => 1,
                'delete' => 1,
            ];

            // Insert user data
            $user = User::create($userData);

            $hashData = [
                'loginid' => $user->id,
                'ha_name' => '963963963',
                'ha_status' => 1,
                'ha_delete' => 1, // Corrected the column name to 'ha_delete'
            ];

            // Insert hash data
            Hashpass::create($hashData);

            echo "Records inserted successfully!";
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
