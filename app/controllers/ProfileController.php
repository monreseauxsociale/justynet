<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class ProfileController extends Controller
{
    public function index(): void
    {
        if (!isset($_SESSION['user_id'])) { header('Location: /login'); return; }
        $userModel = new User();
        $user = $userModel->findById((int)$_SESSION['user_id']);
        $this->render('profile/index', ['title' => 'Mon profil', 'user' => $user]);
    }

    public function update(): void
    {
        if (!isset($_SESSION['user_id'])) { header('Location: /login'); return; }
        $name = trim($_POST['name'] ?? '');
        $bio = trim($_POST['bio'] ?? '');
        $userModel = new User();
        $userModel->updateProfile((int)$_SESSION['user_id'], $name, $bio);
        header('Location: /profile');
    }
}