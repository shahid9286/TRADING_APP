<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserProfile;

class UserProfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserProfile::updateOrCreate(
            ['user_id' => 1], // condition: ek user ka ek hi profile
            [
                'first_name' => 'ali',
                'last_name' => 'ahmed',
                'profile_image' => 'default.png',
                'whatsapp_no' => '+923001234567',
                'country' => 'Pakistan',
                'city' => 'Lahore',
                'address' => 'Johar Town, Lahore'
            ]
        );

        UserProfile::updateOrCreate(
            ['user_id' => 2],
            [
                'first_name' => 'Admin',
                'last_name' => 'User',
                'profile_image' => 'admin.png',
                'whatsapp_no' => '+923001112233',
                'country' => 'Pakistan',
                'city' => 'Karachi',
                'address' => 'Clifton, Karachi'
            ]
        );
    }
}
