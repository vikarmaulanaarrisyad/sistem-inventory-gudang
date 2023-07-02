<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new User;
        $admin->name = 'Administrator';
        $admin->username = 'administrator';
        $admin->email = 'admin@gmail.com';
        $admin->password = Hash::make('123456');
        $admin->avatar = 'default.jpg';
        $admin->role_id = 1;
        $admin->save();

        $user = new User;
        $user->name = 'User';
        $user->username = 'user';
        $user->email = 'user@gmail.com';
        $user->password = Hash::make('123456');
        $user->avatar = 'default.jpg';
        $user->role_id = 2;
        $user->save();
    }
}
