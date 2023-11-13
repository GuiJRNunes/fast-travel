<?php

use App\Models\User;
use App\Enum\UserTypeEnum;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('create-admin {email=admin@test.com} {password=12345678}', function(string $email, string $password) {
    User::create([
        'name' => 'Admin',
        'email' => $email,
        'password' => Hash::make($password),
        'user_type' => UserTypeEnum::ADMIN,
    ]);
})->purpose('Creates an admin user record on the database');
