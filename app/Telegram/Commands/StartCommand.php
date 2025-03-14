<?php
namespace App\Telegram\Commands;

use Illuminate\Support\Facades\Log;
use Telegram\Bot\Commands\Command;

class StartCommand extends Command
{
    protected string $name = 'start';
    protected string $pattern = '{username}';
    protected string $description = 'This command is triggered when the user sends /start';

    public function handle(): void
    {
        Log::info('Start command triggered');

        $fallbackUsername = $this->getUpdate()->getMessage()->from->username;

        $username = $this->argument(
            'username',
            $fallbackUsername
        );

        $message = "Welcome {$username}! Tipe /enable yourEmail to enable 2FA 🚀";
        // Invia un messaggio all'utente
        $this->replyWithMessage([
            'text' => $message,
        ]);
    }
}
