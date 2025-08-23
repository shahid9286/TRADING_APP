<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use App\Models\EmailTemplate;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class EmailService
{
    /**
     * Send email to all users of a specific type using a template
     */
    public function sendEmailsToAllAdmins(string $templateSlug, array $variables, string $roleName): bool
    {
        try {
            $emailTemplate = $this->getEmailTemplate($templateSlug);
            if (!$emailTemplate) return false;

            $recipients = User::role($roleName)
            ->whereNotNull('email')
            ->pluck('email')
            ->toArray();

            if (empty($recipients)) {
                Log::warning("No recipients found for user type: {$roleName}");
                return false;
            }

            return $this->sendBulkEmails($emailTemplate, $variables, $recipients);
        } catch (\Exception $e) {
            Log::error("Failed to send emails to admins: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Send email to a single user using a template
     */
    public function sendEmailToSingleUser(string $templateSlug, array $variables, string $recipient): bool
    {
        try {
            $emailTemplate = $this->getEmailTemplate($templateSlug);
            if (!$emailTemplate) return false;

            if (empty($recipient)) {
                Log::warning("No recipient email provided");
                return false;
            }

            return $this->sendSingleEmail($emailTemplate, $variables, $recipient);
        } catch (\Exception $e) {
            Log::error("Failed to send email to single user: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get email template from database
     */
    protected function getEmailTemplate(string $slug): ?EmailTemplate
    {
        return EmailTemplate::where('slug', $slug)
            ->where('is_active', true)
            ->first();
    }

    /**
     * Send bulk emails to multiple recipients
     */
    protected function sendBulkEmails(EmailTemplate $template, array $variables, array $recipients): bool
    {
        $subject = $this->replaceVariables($template->subject, $variables);
        $body = $this->replaceVariables($template->body, $variables);

        foreach ($recipients as $recipient) {
            Mail::send([], [], function ($message) use ($recipient, $subject, $body) {
                $message->to($recipient)
                    ->subject($subject)
                    ->html($body);
            });
        }

        return true;
    }

    /**
     * Send single email
     */
    protected function sendSingleEmail(EmailTemplate $template, array $variables, string $recipient): bool
    {
        $subject = $this->replaceVariables($template->subject, $variables);
        $body = $this->replaceVariables($template->body, $variables);

        Mail::send([], [], function ($message) use ($recipient, $subject, $body) {
            $message->to($recipient)
                ->subject($subject)
                ->html($body);
        });

        return true;
    }

    /**
     * Replace variables in content
     */
    protected function replaceVariables(string $content, array $variables): string
    {
        foreach ($variables as $key => $value) {
            $content = str_replace("{{{$key}}}", $value, $content);
        }
        return $content;
    }
}