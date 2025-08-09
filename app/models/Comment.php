<?php
// ... existing code ...
namespace App\\Models;

use App\\Core\\Model;

class Comment extends Model
{
    public function create(int $userId, int $postId, string $text): void
    {
        $stmt = self::$db->prepare('INSERT INTO comments(user_id, post_id, text) VALUES(?,?,?)');
        $stmt->execute([$userId, $postId, $text]);
    }
}