<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Playlist;

class PlaylistController extends Controller
{
    public function index(): void
    {
        if (!isset($_SESSION['user_id'])) { header('Location: /login'); return; }
        $model = new Playlist();
        $lists = $model->listByUser((int)$_SESSION['user_id']);
        $this->render('playlist/index', ['title'=>'Mes playlists','playlists'=>$lists]);
    }

    public function create(): void
    {
        if (!isset($_SESSION['user_id'])) { header('Location: /login'); return; }
        $this->render('playlist/create', ['title'=>'Créer une playlist']);
    }

    public function store(): void
    {
        if (!isset($_SESSION['user_id'])) { header('Location: /login'); return; }
        $title = trim($_POST['title'] ?? '');
        $visibility = $_POST['visibility'] ?? 'public';
        $model = new Playlist();
        $id = $model->create((int)$_SESSION['user_id'], $title, $visibility);
        header('Location: /playlist/view?id=' . $id);
    }

    public function view(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        $model = new Playlist();
        $pl = $model->findById($id);
        if (!$pl) { http_response_code(404); echo 'Not found'; return; }
        $videos = $model->videos($id);
        $this->render('playlist/view', ['title'=>$pl['title'],'playlist'=>$pl,'videos'=>$videos]);
    }

    public function addVideo(): void
    {
        if (!isset($_SESSION['user_id'])) { $this->json(['error'=>'auth'],401); return; }
        $pid = (int)($_POST['playlist_id'] ?? 0);
        $vid = (int)($_POST['video_id'] ?? 0);
        $model = new Playlist();
        $model->addVideo($pid, $vid);
        $this->json(['ok'=>true]);
    }

    public function removeVideo(): void
    {
        if (!isset($_SESSION['user_id'])) { $this->json(['error'=>'auth'],401); return; }
        $pid = (int)($_POST['playlist_id'] ?? 0);
        $vid = (int)($_POST['video_id'] ?? 0);
        $model = new Playlist();
        $model->removeVideo($pid, $vid);
        $this->json(['ok'=>true]);
    }
}