<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Channel;
use App\Models\Video;

class ChannelController extends Controller
{
    public function index(): void
    {
        $model = new Channel();
        $channels = $model->listAll();
        $this->render('channel/index', ['title' => 'Chaînes', 'channels' => $channels]);
    }

    public function create(): void
    {
        if (!isset($_SESSION['user_id'])) { header('Location: /login'); return; }
        $this->render('channel/create', ['title' => 'Créer une chaîne']);
    }

    public function store(): void
    {
        if (!isset($_SESSION['user_id'])) { header('Location: /login'); return; }
        $name = trim($_POST['name'] ?? '');
        $desc = trim($_POST['description'] ?? '');
        $model = new Channel();
        $id = $model->create((int)$_SESSION['user_id'], $name, $desc);
        header('Location: /channel/view?id=' . $id);
    }

    public function view(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        $model = new Channel();
        $chan = $model->findById($id);
        if (!$chan) { http_response_code(404); echo 'Not found'; return; }
        $videoModel = new Video();
        $videos = $videoModel->listByChannel($id);
        $this->render('channel/view', ['title' => $chan['name'], 'channel' => $chan, 'videos' => $videos]);
    }

    public function subscribe(): void
    {
        if (!isset($_SESSION['user_id'])) { $this->json(['error'=>'auth'],401); return; }
        $id = (int)($_POST['id'] ?? 0);
        $model = new Channel();
        $model->toggleSubscription((int)$_SESSION['user_id'], $id);
        $this->json(['ok'=>true]);
    }
}