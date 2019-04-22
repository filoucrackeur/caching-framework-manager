<?php
declare(strict_types=1);

use Filoucrackeur\StorageFrameworkManager\Controller\Backend;

return [
    'session_backends' => [
        'path' => '/storage-framework-manager/session-backends',
        'target' => Backend\StorageFrameworkManagerController::class . '::session'
    ],
    'core_backends' => [
        'path' => '/storage-framework-manager/core-backends',
        'target' => Backend\StorageFrameworkManagerController::class . '::core'
    ],
    'extensions_backends' => [
        'path' => '/storage-framework-manager/extensions-backends',
        'target' => Backend\StorageFrameworkManagerController::class . '::extensions'
    ],
    'show_backend' => [
        'path' => '/storage-framework-manager/show',
        'target' => Backend\StorageFrameworkManagerController::class . '::show'
    ],
];
