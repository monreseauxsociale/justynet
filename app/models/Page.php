<?php
namespace App\Models;

use App\Core\Model;

class Page extends Model
{
    public function listAll(): array
    {
        return self::$db->query('SELECT p.*, u.name AS owner_name FROM pages p JOIN users u ON u.id=p.owner_id ORDER BY p.created_at DESC')->fetchAll();
    }
    public function create(int $ownerId, string $name, string $desc): int
    {
        $s=self::$db->prepare('INSERT INTO pages(owner_id,name,description) VALUES(?,?,?)');
        $s->execute([$ownerId,$name,$desc]);
        return (int)self::$db->lastInsertId();
    }
}