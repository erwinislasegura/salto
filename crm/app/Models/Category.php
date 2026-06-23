<?php
namespace CRM\Models;

use CRM\Core\Database;

class Category
{
    public static function all(bool $onlyActive = false): array
    {
        $sql = 'SELECT * FROM crm_categories' . ($onlyActive ? ' WHERE is_active = 1' : '') . ' ORDER BY sort_order, name';
        return Database::connection()->query($sql)->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $statement = Database::connection()->prepare('SELECT * FROM crm_categories WHERE id = ?');
        $statement->execute([$id]);
        return $statement->fetch() ?: null;
    }

    public static function findBySlug(string $slug): ?array
    {
        $statement = Database::connection()->prepare('SELECT * FROM crm_categories WHERE slug = ? AND is_active = 1 LIMIT 1');
        $statement->execute([$slug]);
        return $statement->fetch() ?: null;
    }

    public static function create(array $data): void
    {
        $statement = Database::connection()->prepare('INSERT INTO crm_categories (name, slug, menu_label, meta_title, meta_description, hero_title, hero_subtitle, hero_image, directory_title, directory_intro, static_section_title, static_section_content, cta_title, cta_text, sort_order, is_active) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $statement->execute(self::values($data));
    }

    public static function update(int $id, array $data): void
    {
        $statement = Database::connection()->prepare('UPDATE crm_categories SET name = ?, slug = ?, menu_label = ?, meta_title = ?, meta_description = ?, hero_title = ?, hero_subtitle = ?, hero_image = ?, directory_title = ?, directory_intro = ?, static_section_title = ?, static_section_content = ?, cta_title = ?, cta_text = ?, sort_order = ?, is_active = ? WHERE id = ?');
        $values = self::values($data);
        $values[] = $id;
        $statement->execute($values);
    }

    public static function delete(int $id): void
    {
        $statement = Database::connection()->prepare('DELETE FROM crm_categories WHERE id = ?');
        $statement->execute([$id]);
    }

    private static function values(array $data): array
    {
        return [
            trim($data['name'] ?? ''),
            trim($data['slug'] ?? ''),
            trim($data['menu_label'] ?? ''),
            trim($data['meta_title'] ?? ''),
            trim($data['meta_description'] ?? ''),
            trim($data['hero_title'] ?? ''),
            trim($data['hero_subtitle'] ?? ''),
            trim($data['hero_image'] ?? 'assets/img/2.png'),
            trim($data['directory_title'] ?? ''),
            trim($data['directory_intro'] ?? ''),
            trim($data['static_section_title'] ?? ''),
            trim($data['static_section_content'] ?? ''),
            trim($data['cta_title'] ?? ''),
            trim($data['cta_text'] ?? ''),
            (int) ($data['sort_order'] ?? 0),
            isset($data['is_active']) ? 1 : 0,
        ];
    }
}
