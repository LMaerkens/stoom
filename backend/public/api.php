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

// Robuuste route bepaling (verwacht routes zoals /api/status, /api/games, ...)
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$script_name = $_SERVER['SCRIPT_NAME'];
$base_path = str_replace('\\', '/', dirname($script_name));

// Verwijder base_path uit de request_uri om de route te krijgen
if ($base_path !== '/' && strpos($request_uri, $base_path) === 0) {
    $route = substr($request_uri, strlen($base_path));
} else {
    $route = $request_uri;
}

// Zorg dat de route altijd met een / begint en geen trailing / heeft (behalve voor de root)
if (strpos($route, '/') !== 0) {
    $route = '/' . $route;
}
if ($route !== '/') {
    $route = rtrim($route, '/');
}

// Fallback: Check 'route' query parameter
if ((($route === '' || $route === '/' || $route === '/api.php') && isset($_GET['route']))) {
    $route = $_GET['route'];
    if (strpos($route, '/') !== 0) $route = '/' . $route;
}

error_log("API verzoek: " . $_SERVER['REQUEST_URI'] . " -> Route: " . $route);

$routes = require __DIR__ . '/../src/api/routes.php';

// Route dispatching
if (isset($routes[$route])) {
    $handler = $routes[$route];
    echo json_encode($handler());
} else {
    http_response_code(404);
    echo json_encode(["error" => "Route niet gevonden", "path" => $route]);
}

