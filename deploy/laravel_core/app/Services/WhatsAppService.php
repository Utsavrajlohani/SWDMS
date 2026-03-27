<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    /**
     * Send a mock WhatsApp message.
     *
     * @param string $phone
     * @param string $message
     * @return bool
     */
    public static function sendMessage($phone, $message)
    {
        // Mock WhatsApp Message Sending: Log the message instead of sending it.
        Log::info("Mock WhatsApp Message sent to {$phone}: {$message}");
        
        return true;
    }
}
