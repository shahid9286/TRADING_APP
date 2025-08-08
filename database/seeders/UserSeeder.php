<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {

        $admin_role = Role::create(['name' => 'admin']);
        $user_role  = Role::create(['name' => 'user']);

        $admin = User::create([
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'phone' => '+923758365729',
            'status' => 'approved',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        UserProfile::create([
            'user_id'      => $admin->id,
            'first_name'   => 'Admin',
            'last_name'    => 'User',
            'profile_image' => null,
            'whatsapp_no'  => '+923758365729',
            'address'      => 'Gujranwala',
        ]);

        $admin->assignRole($admin_role);

        $user = User::create([
            'username' => 'user',
            'email' => 'user@user.com',
            'phone' => '+923758365729',
            'status' => 'approved',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        UserProfile::create([
            'user_id'      => $user->id,
            'first_name'   => 'Regular',
            'last_name'    => 'User',
            'profile_image' => null,
            'whatsapp_no'  => '+923758365729',
            'address'      => 'Gujranwala',
        ]);

        $user->assignRole($user_role);
    }
}
