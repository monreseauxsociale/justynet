<?php
// ... existing code ...
namespace App\\Core;

class Router
{
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public function get(string $path, string $handler): void
    {
        $this->routes['GET'][$this->normalize($path)] = $handler;
    }

    public function post(string $path, string $handler): void
    {
        $this->routes['POST'][$this->normalize($path)] = $handler;
    }

    public function dispatch(string $method, string $uri): void
    {
        $path = parse_url($uri, PHP_URL_PATH) ?? '/';
        $path = $this->normalize($path);
        $handler = $this->routes[$method][$path] ?? null;

        if ($handler === null) {
            http_response_code(404);
            echo '404 Not Found';
            return;
        }

        [$controllerName, $action] = explode('@', $handler);
        $controllerClass = 'App\\\\Controllers\\\\' . $controllerName;

        if (!class_exists($controllerClass)) {
            http_response_code(500);
            echo 'Controller not found';
            return;
        }

        $controller = new $controllerClass();
        if (!method_exists($controller, $action)) {
            http_response_code(500);
            echo 'Action not found';
            return;
        }

        call_user_func([$controller, $action]);
    }

    private function normalize(string $path): string
    {
        if ($path === '') {
            return '/';
        }
        return rtrim($path, '/') ?: '/';
    }
}