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
                WHERE v.visibility = "public" ORDER BY v.created_at DESC LIMIT 50';
        return self::$db->query($sql)->fetchAll();
    }

    public function listByChannel(int $channelId): array
    {
        $s=self::$db->prepare('SELECT * FROM videos WHERE channel_id=? ORDER BY created_at DESC');
        $s->execute([$channelId]);
        return $s->fetchAll();
    }

    public function search(string $q): array
    {
        $like = '%' . $q . '%';
        $sql = 'SELECT DISTINCT v.* FROM videos v LEFT JOIN video_tags t ON t.video_id=v.id WHERE (v.title LIKE ? OR t.tag LIKE ?) AND v.visibility="public" ORDER BY v.created_at DESC LIMIT 100';
        $s=self::$db->prepare($sql);$s->execute([$like,$like]);
        return $s->fetchAll();
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

    public function like(int $userId, int $videoId, string $type): void
    {
        $s=self::$db->prepare('REPLACE INTO video_likes(user_id,video_id,type) VALUES(?,?,?)');
        $s->execute([$userId,$videoId,$type]);
    }
    public function addView(int $videoId, ?int $userId): void
    {
        $s=self::$db->prepare('INSERT INTO video_views(video_id,user_id) VALUES(?,?)');
        $s->execute([$videoId,$userId]);
    }
    public function addShare(int $videoId, ?int $userId): void
    {
        $s=self::$db->prepare('INSERT INTO video_shares(video_id,user_id) VALUES(?,?)');
        $s->execute([$videoId,$userId]);
    }
    public function addDownload(int $videoId, ?int $userId): void
    {
        $s=self::$db->prepare('INSERT INTO video_downloads(video_id,user_id) VALUES(?,?)');
        $s->execute([$videoId,$userId]);
    }
}