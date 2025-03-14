<?php

use App\Http\Controllers\TelegramController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/webhook-telegram', [TelegramController::class, 'webhook']);
