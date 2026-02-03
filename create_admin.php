<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

if (!User::where('email', 'admin@example.com')->exists()) {
    User::factory()->create([
        'name' => 'Admin',
        'email' => 'admin@example.com',
        'password' => Hash::make('password'),
        'role' => 'admin',
    ]);
    echo "Admin user created.\n";
} else {
    echo "Admin user already exists.\n";
}
