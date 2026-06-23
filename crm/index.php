<?php
spl_autoload_register(function (string $class): void {
    $prefix = 'CRM\\';
    if (strpos($class, $prefix) !== 0) {
        return;
    }

    $relativeClass = substr($class, strlen($prefix));
    $file = __DIR__ . '/app/' . str_replace('\\', '/', $relativeClass) . '.php';
    if (is_file($file)) {
        require $file;
    }
});

$controllerName = preg_replace('/[^a-z]/', '', strtolower($_GET['controller'] ?? 'dashboard')) ?: 'dashboard';
$action = preg_replace('/[^a-z]/', '', strtolower($_GET['action'] ?? 'index')) ?: 'index';
$class = 'CRM\\Controllers\\' . ucfirst($controllerName) . 'Controller';

if (!class_exists($class) || !method_exists($class, $action)) {
    http_response_code(404);
    exit('Ruta del CRM no encontrada.');
}

(new $class())->{$action}();
