<?php
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

echo "Checking Admin User...\n";
$user = User::where('email', 'admin@simpur.desa.id')->first();

if (!$user) {
    echo "ERROR: Admin user NOT FOUND in database.\n";
    
    // Attempt to create it again strictly
    echo "Re-creating Admin user...\n";
    $user = new User();
    $user->name = 'Admin Desa';
    $user->email = 'admin@simpur.desa.id';
    $user->password = Hash::make('password');
    $user->save();
    echo "Admin created with ID: " . $user->id . "\n";
} else {
    echo "User FOUND: " . $user->email . "\n";
    echo "Current Hash: " . $user->password . "\n";
}

// Test Password
if (Hash::check('password', $user->password)) {
    echo "SUCCESS: Password 'password' matches the hash.\n";
} else {
    echo "FAIL: Password 'password' DOES NOT match. Resetting...\n";
    $user->password = Hash::make('password');
    $user->save();
    echo "Password has been reset to 'password'.\n";
}

// Test Auth Attempt simulation
if (auth()->attempt(['email' => 'admin@simpur.desa.id', 'password' => 'password'])) {
     echo "Auth::attempt(['email' => 'admin@simpur.desa.id', 'password' => 'password']) SUCCEEDED.\n";
} else {
     echo "Auth::attempt FAILED.\n";
}
