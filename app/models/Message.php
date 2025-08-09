<?php
// ... existing code ...
namespace App\\Models;

use App\\Core\\Model;

class Message extends Model
{
    public function getThread(int $userId, int $withId): array
    {
        $sql = 'SELECT * FROM messages WHERE (from_id = ? AND to_id = ?) OR (from_id = ? AND to_id = ?) ORDER BY created_at ASC LIMIT 200';
        $stmt = self::$db->prepare($sql);
        $stmt->execute([$userId, $withId, $withId, $userId]);
        return $stmt->fetchAll();
    }

    public function send(int $from, int $to, string $text): void
    {
        $stmt = self::$db->prepare('INSERT INTO messages(from_id, to_id, text) VALUES(?,?,?)');
        $stmt->execute([$from, $to, $text]);
    }
}