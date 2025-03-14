<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DisableTwoFactorAuth extends Command
{
    protected string $name = 'disable';
    protected string $description = 'Disable Two-Factor Authentication via Telegram';

    public function handle(): void
    {
        $chatId = $this->getUpdate()->getMessage()->getChat()->getId();

        Log::info("User with chat_id $chatId executed 2FA disable command");

        $user = DB::table('users')->where('chat_id', $chatId)->first();

        if ($user) {
            DB::table('users')->where('chat_id', $chatId)->update([
                'chat_id' => null,
            ]);
            $message = '*2FA has been disabled!*';
        } else {
            $message = '*2FA is already disabled.*';
        }

        $this->replyWithMessage([
            'parse_mode' => 'Markdown',
            'text' => $message,
        ]);

        Log::info("2FA Disabled by User with chat_id $chatId");
    }
}

