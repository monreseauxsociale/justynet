<?php
namespace App\Models;

use App\Core\Model;

class Playlist extends Model
{
    public function listByUser(int $userId): array
    {
        $stmt=self::$db->prepare('SELECT * FROM playlists WHERE user_id=? ORDER BY created_at DESC');
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }
    public function create(int $userId, string $title, string $visibility): int
    {
        $stmt=self::$db->prepare('INSERT INTO playlists(user_id,title,visibility) VALUES(?,?,?)');
        $stmt->execute([$userId,$title,$visibility]);
        return (int)self::$db->lastInsertId();
    }
    public function findById(int $id): ?array
    {
        $s=self::$db->prepare('SELECT * FROM playlists WHERE id=?');
        $s->execute([$id]);
        $r=$s->fetch();
        return $r?:null;
    }
    public function videos(int $playlistId): array
    {
        $sql='SELECT v.* FROM playlist_videos pv JOIN videos v ON v.id=pv.video_id WHERE pv.playlist_id=? ORDER BY pv.position ASC';
        $s=self::$db->prepare($sql);$s->execute([$playlistId]);return $s->fetchAll();
    }
    public function addVideo(int $playlistId, int $videoId): void
    {
        $s=self::$db->prepare('INSERT IGNORE INTO playlist_videos(playlist_id,video_id,position) VALUES(?,?,0)');
        $s->execute([$playlistId,$videoId]);
    }
    public function removeVideo(int $playlistId, int $videoId): void
    {
        $s=self::$db->prepare('DELETE FROM playlist_videos WHERE playlist_id=? AND video_id=?');
        $s->execute([$playlistId,$videoId]);
    }
}