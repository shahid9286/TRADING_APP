<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('settings')->insert([
            'logo' => 'uploads/logo.png',
            'home_beadcrum_img' => 'uploads/home_breadcrumb.jpg',
            'footer_logo' => 'uploads/footer_logo.png',
            'fav_icon' => 'uploads/favicon.ico',
            'phone_no' => '0544560046',
            'phone_no_2' => '+971544560046 ',
            'whatsapp_no' => '+971544560046 ',
            'email' => 'info@tahzeel.com',
            'address' => 'Dubai, United Arab Emirates',
            'fb_link' => 'https://facebook.com/example',
            'insta_link' => 'https://instagram.com/example',
            'yt_link' => 'https://youtube.com/example',
            'tiktok_link' => 'https://tiktok.com/@example',
            'whatsapp_link' => 'https://wa.me/971544560046 ',
            'pinterest_link' => 'https://pinterest.com/@example ',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
