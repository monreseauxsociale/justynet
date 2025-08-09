<?php
// ... existing code ...
namespace App\\Models;

use App\\Core\\Model;

class Reaction extends Model
{
    public function toggle(int $userId, int $postId, string $type): void
    {
        $stmt = self::$db->prepare('SELECT id FROM reactions WHERE user_id = ? AND post_id = ?');
        $stmt->execute([$userId, $postId]);
        $row = $stmt->fetch();
        if ($row) {
            $del = self::$db->prepare('DELETE FROM reactions WHERE id = ?');
            $del->execute([$row['id']]);
        } else {
            $ins = self::$db->prepare('INSERT INTO reactions(user_id, post_id, type) VALUES(?,?,?)');
            $ins->execute([$userId, $postId, $type]);
        }
    }
}