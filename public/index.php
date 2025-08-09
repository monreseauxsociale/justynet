<?php
declare(strict_types=1);

ini_set('display_errors', '1');
error_reporting(E_ALL);

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/core/Autoloader.php';

use App\Core\App;

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Serve static if running with PHP built-in server
if (php_sapi_name() === 'cli-server') {
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $fullPath = __DIR__ . $path;
    if ($path !== '/' && file_exists($fullPath) && is_file($fullPath)) {
        return false;
    }
}

$app = new App();
$app->run();