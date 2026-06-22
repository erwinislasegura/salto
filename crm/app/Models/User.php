<?php
namespace CRM\Models;

use CRM\Core\Database;

class User
{
    public static function all(): array
    {
        return Database::connection()
            ->query('SELECT id, name, email, role, is_active, created_at FROM crm_users ORDER BY created_at DESC')
            ->fetchAll();
    }

    public static function count(): int
    {
        return (int) Database::connection()->query('SELECT COUNT(*) FROM crm_users')->fetchColumn();
    }

    public static function find(int $id): ?array
    {
        $statement = Database::connection()->prepare('SELECT id, name, email, role, is_active FROM crm_users WHERE id = ?');
        $statement->execute([$id]);
        return $statement->fetch() ?: null;
    }

    public static function findByEmail(string $email): ?array
    {
        $statement = Database::connection()->prepare('SELECT * FROM crm_users WHERE email = ? LIMIT 1');
        $statement->execute([$email]);
        return $statement->fetch() ?: null;
    }

    public static function create(array $data): void
    {
        $statement = Database::connection()->prepare('INSERT INTO crm_users (name, email, password_hash, role, is_active) VALUES (?, ?, ?, ?, ?)');
        $statement->execute([
            $data['name'],
            $data['email'],
            password_hash($data['password'], PASSWORD_DEFAULT),
            $data['role'],
            (int) $data['is_active'],
        ]);
    }

    public static function update(int $id, array $data): void
    {
        $params = [$data['name'], $data['email'], $data['role'], (int) $data['is_active']];
        $passwordSql = '';

        if (!empty($data['password'])) {
            $passwordSql = ', password_hash = ?';
            $params[] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        $params[] = $id;
        $statement = Database::connection()->prepare("UPDATE crm_users SET name = ?, email = ?, role = ?, is_active = ?{$passwordSql} WHERE id = ?");
        $statement->execute($params);
    }

    public static function delete(int $id): void
    {
        $statement = Database::connection()->prepare('DELETE FROM crm_users WHERE id = ?');
        $statement->execute([$id]);
    }
}
