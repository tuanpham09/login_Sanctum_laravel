<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/send-emails', [\App\Http\Controllers\EmailController::class, 'sendEmails'])->name('send.emails');