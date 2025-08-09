<?php
namespace App\Core;

class Controller
{
    protected function render(string $view, array $params = [], string $layout = 'main')
    {
        extract($params, EXTR_SKIP);
        $viewFile = __DIR__ . '/../views/' . $view . '.php';
        $layoutFile = __DIR__ . '/../views/layouts/' . $layout . '.php';

        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        require $layoutFile;
    }

    protected function json($data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}