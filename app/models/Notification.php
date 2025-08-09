<?php
// ... existing code ...
namespace App\\Models;

use App\\Core\\Model;

class Notification extends Model
{
    public function listForUser(int $userId): array
    {
        $stmt = self::$db->prepare('SELECT * FROM notifications WHERE user_id = ? AND is_read = 0 ORDER BY created_at DESC LIMIT 50');
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function markRead(int $id, int $userId): void
    {
        $stmt = self::$db->prepare('UPDATE notifications SET is_read = 1 WHERE id = ? AND user_id = ?');
        $stmt->execute([$id, $userId]);
    }
}