<?php

header("Content-Type: application/json");

// Eenvoudige autoloader voor de App namespace
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

// Route bepaling
$request_uri = $_SERVER['REQUEST_URI'];
$base_path = dirname($_SERVER['SCRIPT_NAME']);
$route = str_replace($base_path, '', $request_uri);
$route = strtok($route, '?'); // Verwijder query string

$routes = require __DIR__ . '/../src/api/routes.php';

// Route dispatching
if (isset($routes[$route])) {
    $handler = $routes[$route];
    echo json_encode($handler());
} else {
    http_response_code(404);
    echo json_encode(["error" => "Route niet gevonden", "path" => $route]);
}
