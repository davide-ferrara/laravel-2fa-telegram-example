<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TwoFactorAuth extends Command
{
    protected string $name = 'enable';
    protected string $pattern = '{email}';
    protected string $description = 'Enable Two-Factor Authentication via Telegram';

    public function handle(): void
    {
        $chatId = $this->getUpdate()->getMessage()->getChat()->getId();

        $user = DB::table('users')->where('chat_id', $chatId)->first();

        if ($user) {
            $message = '*2FA is already enabled*';
        } else {
            $email = $this->argument('email');

            $query = DB::table('users')->where('email', $email)->update(['chat_id' => $chatId]);

            // if 0 means no rows were updated so email wasn't valid!
            Log::info("Checking provided email {$email}, query res: {$query}");
            if(!$query) $message = 'Provided email is not valid!';
            else $message = 'Congratulations! You have successfully enabled 2FA 🚀';
        }

        $this->replyWithMessage([
            'parse_mode' => 'Markdown',
            'text' => $message,
        ]);
    }
}

