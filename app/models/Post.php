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
                WHERE (p.expires_at IS NULL OR p.expires_at > NOW())
                ORDER BY p.created_at DESC LIMIT 50';
        return self::$db->query($sql)->fetchAll();
    }

    public function create(int $userId, string $content, ?string $expiresAt = null): void
    {
        if ($expiresAt) {
            $stmt = self::$db->prepare('INSERT INTO posts(user_id, content, expires_at) VALUES(?, ?, ?)');
            $stmt->execute([$userId, $content, $expiresAt]);
        } else {
            $stmt = self::$db->prepare('INSERT INTO posts(user_id, content) VALUES(?, ?)');
            $stmt->execute([$userId, $content]);
        }
    }

    public function search(string $q): array
    {
        $like='%'.$q.'%';
        $s=self::$db->prepare('SELECT p.*, u.name AS author_name FROM posts p JOIN users u ON u.id=p.user_id WHERE p.content LIKE ? ORDER BY p.created_at DESC LIMIT 100');
        $s->execute([$like]);
        return $s->fetchAll();
    }

    public function share(int $userId, int $postId): void
    {
        $s=self::$db->prepare('INSERT INTO post_shares(post_id,user_id) VALUES(?,?)');
        $s->execute([$postId,$userId]);
    }
}