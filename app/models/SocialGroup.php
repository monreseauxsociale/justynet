<?php
namespace App\Models;

use App\Core\Model;

class SocialGroup extends Model
{
    public function listAll(): array
    {
        return self::$db->query('SELECT * FROM social_groups ORDER BY created_at DESC')->fetchAll();
    }
    public function create(int $ownerId, string $name, string $privacy): int
    {
        $s=self::$db->prepare('INSERT INTO social_groups(owner_id,name,privacy) VALUES(?,?,?)');
        $s->execute([$ownerId,$name,$privacy]);
        return (int)self::$db->lastInsertId();
    }
}