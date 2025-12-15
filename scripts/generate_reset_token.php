<?php

use App\Models\User;

require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$email = $argv[1] ?? null;
if (! $email) {
    fwrite(STDERR, "Usage: php generate_reset_token.php user@example.com" . PHP_EOL);
    exit(1);
}

if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
    fwrite(STDERR, "Invalid email address: {$email}" . PHP_EOL);
    exit(1);
}

$user = User::where('email', $email)->first();
if (! $user) {
    fwrite(STDERR, "USER_NOT_FOUND: {$email}" . PHP_EOL);
    exit(1);
}

try {
    $token = app('auth.password.broker')->createToken($user);
} catch (Throwable $e) {
    fwrite(STDERR, 'Failed to create token: ' . $e->getMessage() . PHP_EOL);
    exit(1);
}

if (empty($token)) {
    fwrite(STDERR, "Failed to generate a non-empty token for {$email}" . PHP_EOL);
    exit(1);
}

echo $token . PHP_EOL;
