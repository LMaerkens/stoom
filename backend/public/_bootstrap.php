<?php

declare(strict_types=1);

// Sessions for login state
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Autoloader for App namespace (same idea as api.php)
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/../src/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

function redirect(string $path): void {
    header('Location: ' . $path);
    exit;
}

function is_logged_in(): bool {
    return isset($_SESSION['user']) && is_array($_SESSION['user']) && isset($_SESSION['user']['id']);
}

function require_login(): void {
    if (!is_logged_in()) {
        redirect('/login.php');
    }
}

function current_user(): ?array {
    return is_logged_in() ? $_SESSION['user'] : null;
}

