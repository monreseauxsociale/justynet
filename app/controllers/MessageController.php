<?php
// ... existing code ...
namespace App\\Controllers;

use App\\Core\\Controller;
use App\\Models\\Message;
use App\\Models\\User;

class MessageController extends Controller
{
    public function index(): void
    {
        if (!isset($_SESSION['user_id'])) { header('Location: /login'); return; }
        $userModel = new User();
        $users = $userModel->listAllExcept((int)$_SESSION['user_id']);
        $this->render('message/index', ['title' => 'Messages', 'users' => $users]);
    }

    public function thread(): void
    {
        if (!isset($_SESSION['user_id'])) { $this->json(['error' => 'auth'], 401); return; }
        $withId = (int)($_GET['with'] ?? 0);
        $messageModel = new Message();
        $messages = $messageModel->getThread((int)$_SESSION['user_id'], $withId);
        $this->json(['messages' => $messages]);
    }

    public function send(): void
    {
        if (!isset($_SESSION['user_id'])) { $this->json(['error' => 'auth'], 401); return; }
        $to = (int)($_POST['to'] ?? 0);
        $text = trim($_POST['text'] ?? '');
        if ($to && $text !== '') {
            $messageModel = new Message();
            $messageModel->send((int)$_SESSION['user_id'], $to, $text);
        }
        $this->json(['ok' => true]);
    }

    public function status(): void
    {
        $this->json(['online' => true]);
    }
}