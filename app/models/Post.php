<?php
// ... existing code ...
namespace App\\Models;

use App\\Core\\Model;

class Post extends Model
{
    public function getFeed(int $userId): array
    {
        $sql = 'SELECT p.id, p.content, p.created_at, u.name AS author_name
                FROM posts p JOIN users u ON u.id = p.user_id
                ORDER BY p.created_at DESC LIMIT 50';
        return self::$db->query($sql)->fetchAll();
    }

    public function create(int $userId, string $content): void
    {
        $stmt = self::$db->prepare('INSERT INTO posts(user_id, content) VALUES(?, ?)');
        $stmt->execute([$userId, $content]);
    }
}