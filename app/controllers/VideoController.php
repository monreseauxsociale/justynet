<?php
// ... existing code ...
namespace App\\Controllers;

use App\\Core\\Controller;
use App\\Models\\Video;

class VideoController extends Controller
{
    public function index(): void
    {
        $videoModel = new Video();
        $videos = $videoModel->getDiscover();
        $this->render('video/index', ['title' => 'Découverte', 'videos' => $videos]);
    }

    public function upload(): void
    {
        if (!isset($_SESSION['user_id'])) { header('Location: /login'); return; }
        $this->render('video/upload', ['title' => 'Téléverser une vidéo']);
    }

    public function doUpload(): void
    {
        if (!isset($_SESSION['user_id'])) { header('Location: /login'); return; }
        $title = trim($_POST['title'] ?? '');
        $visibility = $_POST['visibility'] ?? 'public';
        $videoFile = $_FILES['video'] ?? null;

        if ($videoFile && $videoFile['error'] === UPLOAD_ERR_OK && $title !== '') {
            $ext = pathinfo($videoFile['name'], PATHINFO_EXTENSION);
            $name = uniqid('vid_') . '.' . $ext;
            $dest = __DIR__ . '/../../public/uploads/videos/' . $name;
            move_uploaded_file($videoFile['tmp_name'], $dest);

            $videoModel = new Video();
            $videoModel->create((int)$_SESSION['user_id'], $title, $name, $visibility);
        }
        header('Location: /video');
    }

    public function watch(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        $videoModel = new Video();
        $video = $videoModel->findById($id);
        if (!$video) { http_response_code(404); echo 'Not found'; return; }
        $this->render('video/watch', ['title' => $video['title'], 'video' => $video]);
    }

    public function like(): void
    {
        $this->json(['ok' => true]); // placeholder
    }

    public function comment(): void
    {
        $this->json(['ok' => true]); // placeholder
    }
}