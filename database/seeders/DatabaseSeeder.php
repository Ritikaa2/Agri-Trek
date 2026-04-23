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
        $admin = new \App\Models\User();
        $admin->name = 'System Admin';
        $admin->email = 'admin@agritrek.test';
        $admin->password = bcrypt('password');
        $admin->role = 'admin';
        $admin->save();

        $farmer = new \App\Models\User();
        $farmer->name = 'John Doe';
        $farmer->email = 'farmer@agritrek.test';
        $farmer->password = bcrypt('password');
        $farmer->role = 'farmer';
        $farmer->save();

        \App\Models\Farmer::create(['user_id' => $farmer->id, 'aadhaar_no' => '123456789012', 'phone' => '9876543210']);

        \App\Models\Scheme::create([
            'title' => 'PM Kisan Samman Nidhi', 
            'description' => 'Financial support for small and marginal farmers.', 
            'eligibility_criteria' => 'Must own less than 2 hectares of land.', 
            'max_beneficiaries' => 1000
        ]);
    }
}
