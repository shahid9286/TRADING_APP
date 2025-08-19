<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Announcement;

class AnnouncementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Announcement::updateOrCreate(
            ['id' => 1],
            [
                'title' => 'Welcome to our Investment Platform',
                'message' => 'Daily 0.5% return on your investments for one year.',
                'link_text' => 'Learn More',
                'link_url' => 'https://example.com/details',
                'status' => 'active',
                'order_no' => 1,
            ]
        );

        Announcement::updateOrCreate(
            ['id' => 2],
            [
                'title' => 'Referral Program',
                'message' => 'Earn commission up to 7 levels by referring your friends.',
                'link_text' => 'View Program',
                'link_url' => 'https://example.com/referrals',
                'status' => 'active',
                'order_no' => 2,
            ]
        );
    }
}
