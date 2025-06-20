<?php

use App\Http\Controllers\AIChatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
//    return view('welcome');
    return view('chats');
});
// api.php
Route::post('/chat', [AIChatController::class, 'chat']);

