<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Operator',
                'email' => 'Operator@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'), // Gunakan bcrypt
                'role' => 'Operator',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kordinator Lapangan',
                'email' => 'KordinatorLapangan@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'), // Gunakan bcrypt
                'role' => 'Kordinator Lapangan',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kepala Bagian',
                'email' => 'KepalaBagian@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'), // Gunakan bcrypt
                'role' => 'Kepala Bagian',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
           
        ]);
    }
}
