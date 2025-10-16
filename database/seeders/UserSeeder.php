<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // First, create roles if they don't exist
        $adminRole = \App\Models\Role::firstOrCreate(['name' => 'admin']);
        $staffRole = \App\Models\Role::firstOrCreate(['name' => 'staff']);
        $customerRole = \App\Models\Role::firstOrCreate(['name' => 'customer']);

        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@hudsonfurnishing.com',
                'password' => Hash::make('Admin123!'),
                'role_id' => $adminRole->id,
            ],
            [
                'name' => 'Le Tan Buu',
                'email' => 'buu.le@gmail.com',
                'password' => Hash::make('Password123!'),
                'role_id' => $customerRole->id,
            ],
            [
                'name' => 'Nguyen Thi Kim Thi',
                'email' => 'thi.nguyen@gmail.com',
                'password' => Hash::make('Password123!'),
                'role_id' => $customerRole->id,
            ],
            [
                'name' => 'Nguyen Phuc Duy Anh',
                'email' => 'duyanh@gmail.com',
                'password' => Hash::make('Password123!'),
                'role_id' => $customerRole->id,
            ],
            [
                'name' => 'Tran Minh Tuan',
                'email' => 'tuan.tran@gmail.com',
                'password' => Hash::make('password123'),
                'role_id' => $customerRole->id,
            ],           
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }
    }
}
