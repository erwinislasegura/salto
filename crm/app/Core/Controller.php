<?php
namespace CRM\Core;

class Controller
{
    protected function view(string $view, array $data = []): void
    {
        extract($data, EXTR_SKIP);
        require __DIR__ . '/../Views/layouts/main.php';
    }

    protected function redirect(string $controller = 'dashboard', string $action = 'index'): void
    {
        header('Location: index.php?controller=' . urlencode($controller) . '&action=' . urlencode($action));
        exit;
    }

    protected function imagePath(string $field, string $currentPath = ''): string
    {
        if (empty($_FILES[$field]['tmp_name']) || !is_uploaded_file($_FILES[$field]['tmp_name'])) {
            return $currentPath;
        }

        $allowedTypes = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/webp' => 'webp',
            'image/gif' => 'gif',
        ];
        $mimeType = mime_content_type($_FILES[$field]['tmp_name']);
        if (!isset($allowedTypes[$mimeType])) {
            die('El archivo subido debe ser una imagen JPG, PNG, WEBP o GIF.');
        }

        $directory = __DIR__ . '/../../../uploads/crm';
        if (!is_dir($directory)) {
            mkdir($directory, 0775, true);
        }

        $filename = $field . '-' . date('YmdHis') . '-' . bin2hex(random_bytes(4)) . '.' . $allowedTypes[$mimeType];
        $destination = $directory . '/' . $filename;
        if (!move_uploaded_file($_FILES[$field]['tmp_name'], $destination)) {
            die('No fue posible guardar la imagen subida.');
        }

        return 'uploads/crm/' . $filename;
    }
}
