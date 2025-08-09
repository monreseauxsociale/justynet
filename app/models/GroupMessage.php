<?php
namespace App\Models;

use App\Core\Model;

class GroupMessage extends Model
{
    public function getThread(int $groupId): array
    {
        $s=self::$db->prepare('SELECT * FROM group_messages WHERE group_id=? ORDER BY created_at ASC LIMIT 300');
        $s->execute([$groupId]);
        return $s->fetchAll();
    }
    public function send(int $groupId, int $fromId, string $text): void
    {
        $s=self::$db->prepare('INSERT INTO group_messages(group_id,from_id,text) VALUES(?,?,?)');
        $s->execute([$groupId,$fromId,$text]);
    }
}