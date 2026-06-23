<?php
return [
    'host' => getenv('CRM_DB_HOST') ?: 'localhost',
    'database' => getenv('CRM_DB_NAME') ?: 'saltos_crm',
    'username' => getenv('CRM_DB_USER') ?: 'root',
    'password' => getenv('CRM_DB_PASS') ?: '',
    'charset' => getenv('CRM_DB_CHARSET') ?: 'utf8mb4',
];
