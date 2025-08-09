<?php
// ... existing code ...
namespace App\\Controllers;

use App\\Core\\Controller;

class HomeController extends Controller
{
    public function index(): void
    {
        $isLogged = isset($_SESSION['user_id']);
        if ($isLogged) {
            header('Location: /feed');
            return;
        }
        $this->render('home/index', [
            'title' => 'Bienvenue sur Justy',
        ]);
    }
}