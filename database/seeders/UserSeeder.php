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
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@hudsonfurnishing.com',
                'password' => Hash::make('Admin123!'),
                'role' => 'admin',
            ],
            [
                'name' => 'Le Tan Buu',
                'email' => 'buu.le@gmail.com',
                'password' => Hash::make('Password123!'),
                'role' => 'user',
            ],
            [
                'name' => 'Nguyen Thi Kim Thi',
                'email' => 'thi.nguyen@gmail.com',
                'password' => Hash::make('Password123!'),
                'role' => 'user',
            ],
            [
                'name' => 'Nguyen Phuc Duy Anh',
                'email' => 'duyanh@gmail.com',
                'password' => Hash::make('Password123!'),
                'role' => 'user',
            ]            
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }
    }
}
