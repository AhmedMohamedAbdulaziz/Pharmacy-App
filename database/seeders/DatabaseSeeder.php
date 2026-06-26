<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Auth\Models\User;
use App\Modules\Category\Models\Category;
use App\Modules\Supplier\Models\Supplier;
use App\Modules\Medicine\Models\Medicine;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin User
        User::firstOrCreate(
            ['email' => 'admin@pharma.com'],
            [
                'name' => 'Admin Boss',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // 2. Create Regular Customer User
        User::firstOrCreate(
            ['email' => 'user@pharma.com'],
            [
                'name' => 'Regular User',
                'password' => Hash::make('user123'),
                'role' => 'user',
            ]
        );
       
    }
}
