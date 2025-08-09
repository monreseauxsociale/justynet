<?php
// ... existing code ...
namespace App\\Models;

use App\\Core\\Model;
use PDO;

class User extends Model
{
    public function findByEmail(string $email): ?array
    {
        $stmt = self::$db->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function findById(int $id): ?array
    {
        $stmt = self::$db->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(string $name, string $email, string $passwordHash): int
    {
        $stmt = self::$db->prepare('INSERT INTO users(name, email, password_hash) VALUES(?,?,?)');
        $stmt->execute([$name, $email, $passwordHash]);
        return (int)self::$db->lastInsertId();
    }

    public function listAllExcept(int $userId): array
    {
        $stmt = self::$db->prepare('SELECT id, name FROM users WHERE id != ? ORDER BY name');
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function updateProfile(int $id, string $name, string $bio): void
    {
        $stmt = self::$db->prepare('UPDATE users SET name = ?, bio = ? WHERE id = ?');
        $stmt->execute([$name, $bio, $id]);
    }
}