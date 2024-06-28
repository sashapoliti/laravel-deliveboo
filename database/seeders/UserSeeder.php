<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $users = config('User_db.users');
        foreach ($users as $user) {
           $new_user = new User();
           $new_user->name = $user['name'];
           $new_user->email = $user['email'];
           $new_user->password = Hash::make($user['password']);
           $new_user->save();
        }
    }
}