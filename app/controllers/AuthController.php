<?php
// ... existing code ...
namespace App\\Controllers;

use App\\Core\\Controller;
use App\\Models\\User;

class AuthController extends Controller
{
    public function login(): void
    {
        $this->render('auth/login', ['title' => 'Connexion']);
    }

    public function doLogin(): void
    {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $userModel = new User();
        $user = $userModel->findByEmail($email);
        if (!$user || !password_verify($password, $user['password_hash'])) {
            $this->render('auth/login', ['title' => 'Connexion', 'error' => 'Identifiants invalides']);
            return;
        }
        $_SESSION['user_id'] = (int)$user['id'];
        header('Location: /feed');
    }

    public function register(): void
    {
        $this->render('auth/register', ['title' => 'Créer un compte']);
    }

    public function doRegister(): void
    {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 6) {
            $this->render('auth/register', ['title' => 'Créer un compte', 'error' => 'Vérifiez les champs']);
            return;
        }

        $userModel = new User();
        if ($userModel->findByEmail($email)) {
            $this->render('auth/register', ['title' => 'Créer un compte', 'error' => 'Email déjà utilisé']);
            return;
        }

        $userId = $userModel->create($name, $email, password_hash($password, PASSWORD_BCRYPT));
        $_SESSION['user_id'] = $userId;
        header('Location: /feed');
    }

    public function logout(): void
    {
        session_destroy();
        header('Location: /');
    }
}