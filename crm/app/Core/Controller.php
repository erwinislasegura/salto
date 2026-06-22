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
}
