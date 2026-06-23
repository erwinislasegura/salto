<?php
namespace CRM\Models;

use CRM\Core\Database;
use PDO;

class Business
{
    public static function all(): array
    {
        return Database::connection()->query('SELECT * FROM crm_businesses ORDER BY created_at DESC')->fetchAll();
    }

    public static function byCategory(int $categoryId, ?string $tag = null): array
    {
        $sql = 'SELECT b.* FROM crm_businesses b INNER JOIN crm_business_category bc ON bc.business_id = b.id WHERE bc.category_id = ? AND b.is_active = 1';
        $params = [$categoryId];
        if ($tag) {
            $sql .= ' AND FIND_IN_SET(?, REPLACE(b.tags, ", ", ","))';
            $params[] = $tag;
        }
        $sql .= ' ORDER BY b.is_featured DESC, b.name';
        $statement = Database::connection()->prepare($sql);
        $statement->execute($params);
        return $statement->fetchAll();
    }

    public static function tagsByCategory(int $categoryId): array
    {
        $businesses = self::byCategory($categoryId);
        $tags = [];
        foreach ($businesses as $business) {
            foreach (array_filter(array_map('trim', explode(',', $business['tags'] ?? ''))) as $tag) {
                $tags[$tag] = $tag;
            }
        }
        ksort($tags);
        return array_values($tags);
    }

    public static function find(int $id): ?array
    {
        $statement = Database::connection()->prepare('SELECT * FROM crm_businesses WHERE id = ?');
        $statement->execute([$id]);
        $business = $statement->fetch();
        if (!$business) {
            return null;
        }
        $categoryStatement = Database::connection()->prepare('SELECT category_id FROM crm_business_category WHERE business_id = ?');
        $categoryStatement->execute([$id]);
        $business['category_ids'] = $categoryStatement->fetchAll(PDO::FETCH_COLUMN);
        return $business;
    }

    public static function create(array $data): void
    {
        $db = Database::connection();
        $statement = $db->prepare('INSERT INTO crm_businesses (name, slug, summary, description, image, phone, whatsapp, address, map_url, tags, is_featured, is_active) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $statement->execute(self::values($data));
        self::syncCategories((int) $db->lastInsertId(), $data['category_ids'] ?? []);
    }

    public static function update(int $id, array $data): void
    {
        $statement = Database::connection()->prepare('UPDATE crm_businesses SET name = ?, slug = ?, summary = ?, description = ?, image = ?, phone = ?, whatsapp = ?, address = ?, map_url = ?, tags = ?, is_featured = ?, is_active = ? WHERE id = ?');
        $values = self::values($data);
        $values[] = $id;
        $statement->execute($values);
        self::syncCategories($id, $data['category_ids'] ?? []);
    }

    public static function delete(int $id): void
    {
        $statement = Database::connection()->prepare('DELETE FROM crm_businesses WHERE id = ?');
        $statement->execute([$id]);
    }

    private static function syncCategories(int $businessId, array $categoryIds): void
    {
        $db = Database::connection();
        $db->prepare('DELETE FROM crm_business_category WHERE business_id = ?')->execute([$businessId]);
        $statement = $db->prepare('INSERT INTO crm_business_category (business_id, category_id) VALUES (?, ?)');
        foreach (array_unique(array_map('intval', $categoryIds)) as $categoryId) {
            if ($categoryId > 0) {
                $statement->execute([$businessId, $categoryId]);
            }
        }
    }

    private static function values(array $data): array
    {
        return [
            trim($data['name'] ?? ''),
            trim($data['slug'] ?? ''),
            trim($data['summary'] ?? ''),
            trim($data['description'] ?? ''),
            trim($data['image'] ?? 'assets/img/3.png'),
            trim($data['phone'] ?? ''),
            trim($data['whatsapp'] ?? ''),
            trim($data['address'] ?? ''),
            trim($data['map_url'] ?? ''),
            trim($data['tags'] ?? ''),
            isset($data['is_featured']) ? 1 : 0,
            isset($data['is_active']) ? 1 : 0,
        ];
    }
}
