<?php
// ... existing code ...
namespace App\\Models;

use App\\Core\\Model;

class Channel extends Model
{
    public function listAll(): array
    {
        return self::$db->query('SELECT c.*, u.name AS owner_name, (SELECT COUNT(*) FROM channel_subscriptions s WHERE s.channel_id=c.id) AS subs FROM channels c JOIN users u ON u.id=c.user_id ORDER BY c.created_at DESC')->fetchAll();
    }

    public function create(int $userId, string $name, string $description): int
    {
        $stmt = self::$db->prepare('INSERT INTO channels(user_id, name, description) VALUES(?,?,?)');
        $stmt->execute([$userId, $name, $description]);
        return (int)self::$db->lastInsertId();
    }

    public function findById(int $id): ?array
    {
        $stmt = self::$db->prepare('SELECT * FROM channels WHERE id=?');
        $stmt->execute([$id]);
        $row=$stmt->fetch();
        return $row?:null;
    }

    public function toggleSubscription(int $userId, int $channelId): void
    {
        $stmt = self::$db->prepare('SELECT 1 FROM channel_subscriptions WHERE user_id=? AND channel_id=?');
        $stmt->execute([$userId,$channelId]);
        if ($stmt->fetch()) {
            $del = self::$db->prepare('DELETE FROM channel_subscriptions WHERE user_id=? AND channel_id=?');
            $del->execute([$userId,$channelId]);
        } else {
            $ins = self::$db->prepare('INSERT INTO channel_subscriptions(user_id, channel_id) VALUES(?,?)');
            $ins->execute([$userId,$channelId]);
        }
    }

    public function search(string $q): array
    {
        $like='%'.$q.'%';
        $s=self::$db->prepare('SELECT * FROM channels WHERE name LIKE ? ORDER BY created_at DESC LIMIT 100');
        $s->execute([$like]);
        return $s->fetchAll();
    }
}