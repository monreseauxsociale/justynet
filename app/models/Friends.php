<?php
// ... existing code ...
namespace App\\Models;

use App\\Core\\Model;

class Friends extends Model
{
    public function request(int $from, int $to): void
    {
        $s=self::$db->prepare('INSERT IGNORE INTO friend_requests(from_id,to_id) VALUES(?,?)');
        $s->execute([$from,$to]);
    }
    public function respond(int $reqId, int $userId, string $status): void
    {
        $s=self::$db->prepare('UPDATE friend_requests SET status=? WHERE id=? AND to_id=?');
        $s->execute([$status,$reqId,$userId]);
    }
    public function friends(int $userId): array
    {
        $sql='SELECT u.id,u.name FROM users u WHERE u.id IN (
            SELECT CASE WHEN from_id=? THEN to_id ELSE from_id END FROM friend_requests WHERE (from_id=? OR to_id=?) AND status="accepted"
        ) ORDER BY u.name';
        $s=self::$db->prepare($sql);$s->execute([$userId,$userId,$userId]);return $s->fetchAll();
    }
    public function requests(int $userId): array
    {
        $s=self::$db->prepare('SELECT r.*, u.name AS from_name FROM friend_requests r JOIN users u ON u.id=r.from_id WHERE r.to_id=? AND r.status="pending"');
        $s->execute([$userId]);
        return $s->fetchAll();
    }
}