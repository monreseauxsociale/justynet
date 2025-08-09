<?php
namespace App\Models;

use App\Core\Model;

class Story extends Model
{
    public function listActive(): array
    {
        return self::$db->query('SELECT s.*, u.name AS author FROM stories s JOIN users u ON u.id=s.user_id WHERE s.expires_at>NOW() ORDER BY s.created_at DESC')->fetchAll();
    }
    public function create(int $userId, string $kind, ?string $text, ?string $mediaPath): void
    {
        $s=self::$db->prepare('INSERT INTO stories(user_id,kind,text,media_path,expires_at) VALUES(?,?,?,?, DATE_ADD(NOW(), INTERVAL 1 DAY))');
        $s->execute([$userId,$kind,$text,$mediaPath]);
    }
}