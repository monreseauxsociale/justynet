<?php
// ... existing code ...
namespace App\\Models;

use App\\Core\\Model;

class Video extends Model
{
    public function getDiscover(): array
    {
        $sql = 'SELECT v.id, v.title, v.filename, v.created_at, u.name AS author_name
                FROM videos v JOIN users u ON u.id = v.user_id
                WHERE v.visibility = \"public\" ORDER BY v.created_at DESC LIMIT 50';
        return self::$db->query($sql)->fetchAll();
    }

    public function create(int $userId, string $title, string $filename, string $visibility): void
    {
        $stmt = self::$db->prepare('INSERT INTO videos(user_id, title, filename, visibility) VALUES(?,?,?,?)');
        $stmt->execute([$userId, $title, $filename, $visibility]);
    }

    public function findById(int $id): ?array
    {
        $stmt = self::$db->prepare('SELECT * FROM videos WHERE id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }
}