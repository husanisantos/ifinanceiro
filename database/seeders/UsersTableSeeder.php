<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'fullname'  => 'Jhon Doe',
            'username'  => 'admin',
            'password'  => Hash::make('admin'),
            'email'     => 'no@email.com',
            'phone'     => '16 90000 0000'
        ]);
    }
}
