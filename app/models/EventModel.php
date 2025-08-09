<?php
namespace App\Models;

use App\Core\Model;

class EventModel extends Model
{
    public function listUpcoming(): array
    {
        return self::$db->query('SELECT e.*, u.name AS creator FROM events e JOIN users u ON u.id=e.creator_id WHERE e.start_at >= NOW() ORDER BY e.start_at ASC')->fetchAll();
    }
    public function create(int $creatorId, string $name, string $location, string $startAt, string $description): int
    {
        $s=self::$db->prepare('INSERT INTO events(creator_id,name,location,start_at,description) VALUES(?,?,?,?,?)');
        $s->execute([$creatorId,$name,$location,$startAt,$description]);
        return (int)self::$db->lastInsertId();
    }
}