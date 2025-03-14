<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{

    public function webhook(Request $request): JsonResponse
    {
        $chatId = $request->message['from']['id'];
        $command = $request->message['text'];

        Log::info('Received message from: ' . $chatId);
        Log::info('Command: ' . $command);

        Telegram::commandsHandler(true);

        return response()->json(['message' => 'Webhook received!']);
    }

    public static function isTwoFactorEnabled($email): bool
    {
        $user = DB::table('users')->where('email', $email)->first();

        if (!$user->chat_id)
            return false;
        return true;
    }

    public static function sendOtp($email): int
    {
        Log::debug("Verifying OTP code");
        $user = DB::table('users')->where('email', $email)->first();

        if (!$user || !$user->chat_id) {
            $message = "OTP request failed: 2FA not enabled for email $email";
            Log::warning($message);
            return 0;
        }

        $otp = rand(100000, 999999);

        $message = 'You OTP code is: *' . $otp . '*';

        Telegram::sendMessage([
           'chat_id' => $user->chat_id  ,
           'parse_mode' => 'Markdown',
           'text' => $message,
        ]);

        return $otp;
    }
}
