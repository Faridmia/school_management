<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsService
{
    /**
     * Send SMS using the configured gateway.
     *
     * @param string $to Recipient phone number
     * @param string $message The message body
     * @return bool
     */
    public static function send($to, $message)
    {
        $status = Setting::get('sms_status', 'no');
        if ($status !== 'yes') {
            return false;
        }

        $gateway = Setting::get('sms_gateway', 'twilio');
        $apiKey = Setting::get('sms_api_key');
        $senderId = Setting::get('sms_sender_id');
        $usernameOrSid = Setting::get('sms_username_or_sid');

        if (empty($to) || empty($message)) {
            return false;
        }

        try {
            if ($gateway === 'twilio') {
                return self::sendTwilio($to, $message, $usernameOrSid, $apiKey, $senderId);
            } elseif ($gateway === 'bulksmsbd') {
                return self::sendBulkSmsBd($to, $message, $apiKey, $usernameOrSid, $senderId);
            } elseif ($gateway === 'greenweb') {
                return self::sendGreenweb($to, $message, $apiKey);
            }
        } catch (\Exception $e) {
            Log::error('SMS sending exception: ' . $e->getMessage());
        }

        return false;
    }

    /**
     * Send SMS via Twilio.
     */
    private static function sendTwilio($to, $message, $sid, $token, $from)
    {
        if (empty($sid) || empty($token) || empty($from)) {
            Log::error('Twilio credentials missing in settings.');
            return false;
        }

        // Format recipient to E.164
        if (!str_starts_with($to, '+')) {
            if (str_starts_with($to, '880')) {
                $to = '+' . $to;
            } elseif (str_starts_with($to, '0')) {
                $to = '+88' . $to;
            } else {
                $to = '+880' . $to; // Default to BD country code
            }
        }

        $url = "https://api.twilio.com/2010-04-01/Accounts/{$sid}/Messages.json";
        
        $response = Http::asForm()
            ->withBasicAuth($sid, $token)
            ->post($url, [
                'To' => $to,
                'From' => $from,
                'Body' => $message
            ]);

        if ($response->successful()) {
            return true;
        }

        Log::error('Twilio SMS error: ' . $response->body());
        return false;
    }

    /**
     * Send SMS via BulkSMS BD (gtsms.net / Bulk SMS BD API).
     */
    private static function sendBulkSmsBd($to, $message, $apiKey, $username, $senderId)
    {
        if (empty($apiKey)) {
            Log::error('BulkSMS BD API Key missing.');
            return false;
        }

        // Clean recipient number
        $to = preg_replace('/[^0-9]/', '', $to);
        if (strlen($to) === 10 && str_starts_with($to, '1')) {
            $to = '880' . $to;
        } elseif (strlen($to) === 11 && str_starts_with($to, '01')) {
            $to = '88' . $to;
        }

        // Typical BulkSMS BD API endpoint URL
        $response = Http::get("https://gtsms.net/api/v3/sendsms", [
            'api_key' => $apiKey,
            'to' => $to,
            'message' => $message,
            'sender_id' => $senderId
        ]);

        if ($response->successful()) {
            return true;
        }

        Log::error('BulkSMS BD error: ' . $response->body());
        return false;
    }

    /**
     * Send SMS via Greenweb.
     */
    private static function sendGreenweb($to, $message, $token)
    {
        if (empty($token)) {
            Log::error('Greenweb Token missing.');
            return false;
        }

        // Clean recipient number
        $to = preg_replace('/[^0-9]/', '', $to);
        if (strlen($to) === 11 && str_starts_with($to, '01')) {
            $to = '88' . $to;
        }

        $response = Http::get("https://api.greenweb.com.bd/api.php", [
            'token' => $token,
            'to' => $to,
            'message' => $message
        ]);

        if ($response->successful() && str_contains($response->body(), 'Ok')) {
            return true;
        }

        Log::error('Greenweb SMS error: ' . $response->body());
        return false;
    }
}
