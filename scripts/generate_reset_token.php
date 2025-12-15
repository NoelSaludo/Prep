<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;

$email = $argv[1] ?? 'carranza.timothy12@gmail.com';
$user = User::where('email', $email)->first();
if (! $user) {
    echo "USER_NOT_FOUND" . PHP_EOL;
    exit(1);
}

$token = app('auth.password.broker')->createToken($user);
echo $token . PHP_EOL;
