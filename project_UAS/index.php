<?php
// File: index.php - MAIN ENTRY POINT

// 1. Start session
session_start();

// 2. Define BASE URL (automatically detected)
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://';
$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '\\/');
if ($basePath === '' || $basePath === '\\') {
    $basePath = '';
}
define('BASE_URL', $protocol . $_SERVER['HTTP_HOST'] . $basePath . '/');
define('BASE_PATH', __DIR__);

// 3. Error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 4. Simple Autoloader
spl_autoload_register(function($class) {
    $paths = [
        'controllers/' . $class . '.php',
        'models/' . $class . '.php',
        'config/' . $class . '.php'
    ];
    
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return true;
        }
    }
    
    return false;
});

// 5. Include database config
require_once 'config/database.php';

// 6. Routing System
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'auth/login';
$urlParts = explode('/', $url);

$controllerName = !empty($urlParts[0]) ? ucfirst($urlParts[0]) . 'Controller' : 'AuthController';
$action = !empty($urlParts[1]) ? $urlParts[1] : 'login';
$params = array_slice($urlParts, 2);

// 7. Load Controller
$controllerFile = 'controllers/' . $controllerName . '.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    
    if (class_exists($controllerName)) {
        $controller = new $controllerName();
        
        if (method_exists($controller, $action)) {
            call_user_func_array([$controller, $action], $params);
        } else {
            // Method not found, try index
            if (method_exists($controller, 'index')) {
                $controller->index();
            } else {
                http_response_code(404);
                echo "404 - Page not found (Method: $action)";
            }
        }
    } else {
        http_response_code(500);
        echo "500 - Controller class not found";
    }
} else {
    http_response_code(404);
    echo "404 - Page not found (Controller: $controllerName)";
}
?>