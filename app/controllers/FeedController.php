<?php
// ... existing code ...
namespace App\\Controllers;

use App\\Core\\Controller;
use App\\Models\\Post;
use App\\Models\\Reaction;
use App\\Models\\Comment;

class FeedController extends Controller
{
    public function index(): void
    {
        $this->requireAuth();
        $postModel = new Post();
        $posts = $postModel->getFeed((int)$_SESSION['user_id']);
        $this->render('feed/index', ['title' => 'Fil d\'actualité', 'posts' => $posts]);
    }

    public function create(): void
    {
        $this->requireAuth();
        $content = trim($_POST['content'] ?? '');
        if ($content !== '') {
            $postModel = new Post();
            $postModel->create((int)$_SESSION['user_id'], $content);
        }
        header('Location: /feed');
    }

    public function react(): void
    {
        $this->requireAuth();
        $postId = (int)($_POST['post_id'] ?? 0);
        $type = $_POST['type'] ?? 'like';
        $reactionModel = new Reaction();
        $reactionModel->toggle((int)$_SESSION['user_id'], $postId, $type);
        $this->json(['ok' => true]);
    }

    public function comment(): void
    {
        $this->requireAuth();
        $postId = (int)($_POST['post_id'] ?? 0);
        $text = trim($_POST['text'] ?? '');
        if ($postId && $text !== '') {
            $commentModel = new Comment();
            $commentModel->create((int)$_SESSION['user_id'], $postId, $text);
        }
        $this->json(['ok' => true]);
    }

    private function requireAuth(): void
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
    }
}