<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('email_templates')->insert([
            [
                'title' => 'Investment Submitted (User)',
                'subject' => 'Your investment has been submitted successfully',
                'slug' => 'investment_submitted_user',
                'body' => '
                    Hello {{user_name}},<br><br>
                    Thank you for submitting your investment request.<br>
                    <strong>Investment Details:</strong><br>
                    Amount: {{investment_amount}}<br>
                    Date: {{investment_date}}<br><br>
                    We will review your request and notify you once it has been approved.<br><br>
                    Regards,<br>
                    {{company_name}}
                ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Investment Submitted (Admin)',
                'subject' => 'A new investment has been submitted',
                'slug' => 'investment_submitted_admin',
                'body' => '
                    Hello Admin,<br><br>
                    A new investment request has been submitted.<br>
                    <strong>User:</strong> {{user_name}}<br>
                    <strong>Email:</strong> {{user_email}}<br>
                    <strong>Amount:</strong> {{investment_amount}}<br>
                    <strong>Date:</strong> {{investment_date}}<br><br>
                    Please review and take the necessary action.<br><br>
                    Regards,<br>
                    {{company_name}}
                ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Investment Approved (User)',
                'subject' => 'Your investment has been approved',
                'slug' => 'investment_approved_user',
                'body' => '
                    Hello {{user_name}},<br><br>
                    Good news! Your investment request has been <strong>approved</strong>.<br>
                    <strong>Investment Details:</strong><br>
                    Amount: {{investment_amount}}<br>
                    Date: {{investment_date}}<br>
                    Approved By: {{admin_name}}<br><br>
                    Thank you for trusting us.<br><br>
                    Regards,<br>
                    {{company_name}}
                ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Investment Approved (Admin)',
                'subject' => 'An investment has been approved',
                'slug' => 'investment_approved_admin',
                'body' => '
                    Hello Admin,<br><br>
                    An investment request has been approved.<br>
                    <strong>User:</strong> {{user_name}}<br>
                    <strong>Email:</strong> {{user_email}}<br>
                    <strong>Amount:</strong> {{investment_amount}}<br>
                    <strong>Date:</strong> {{investment_date}}<br>
                    Approved By: {{admin_name}}<br><br>
                    Regards,<br>
                    {{company_name}}
                ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
