<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index(): void
    {
        if (!isset($_SESSION['user_id'])) { $this->json([]); return; }
        $notificationModel = new Notification();
        $items = $notificationModel->listForUser((int)$_SESSION['user_id']);
        $this->json($items);
    }

    public function markRead(): void
    {
        if (!isset($_SESSION['user_id'])) { $this->json(['ok' => true]); return; }
        $id = (int)($_POST['id'] ?? 0);
        $notificationModel = new Notification();
        $notificationModel->markRead($id, (int)$_SESSION['user_id']);
        $this->json(['ok' => true]);
    }
}