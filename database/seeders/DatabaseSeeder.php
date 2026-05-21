<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = \App\Models\User::updateOrCreate(
            ['email' => 'admin@agritrek.test'],
            [
                'name' => 'System Admin',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        $farmer = \App\Models\User::updateOrCreate(
            ['email' => 'farmer@agritrek.test'],
            [
                'name' => 'John Doe',
                'password' => bcrypt('password'),
                'role' => 'farmer',
                'email_verified_at' => now(),
            ]
        );

        \App\Models\Farmer::updateOrCreate(
            ['user_id' => $farmer->id],
            [
                'aadhaar_no' => '123456789012',
                'phone' => '9876543210',
                'address' => 'Demo Farm Road, Plot 12',
                'village' => 'Shivpura',
                'district' => 'Indore',
            ]
        );

        $this->call(SchemeSeeder::class);
    }
}
