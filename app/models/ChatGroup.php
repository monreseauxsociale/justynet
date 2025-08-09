<?php
namespace App\Models;

use App\Core\Model;

class ChatGroup extends Model
{
    public function listByUser(int $userId): array
    {
        $sql='SELECT g.* FROM chat_groups g JOIN chat_group_members m ON m.group_id=g.id WHERE m.user_id=? ORDER BY g.created_at DESC';
        $s=self::$db->prepare($sql);$s->execute([$userId]);return $s->fetchAll();
    }
    public function create(int $ownerId, string $name): int
    {
        $s=self::$db->prepare('INSERT INTO chat_groups(owner_id,name) VALUES(?,?)');
        $s->execute([$ownerId,$name]);
        $id=(int)self::$db->lastInsertId();
        $add=self::$db->prepare('INSERT INTO chat_group_members(group_id,user_id,role) VALUES(?,?,"admin")');
        $add->execute([$id,$ownerId]);
        return $id;
    }
}