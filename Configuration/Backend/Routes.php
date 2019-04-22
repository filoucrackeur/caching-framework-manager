<?php
declare(strict_types=1);

use Filoucrackeur\StorageFrameworkManager\Controller\Backend;

return [
    'session_backends' => [
        'path' => '/storage-framework-manager/session-backends',
        'target' => Backend\StorageFrameworkManagerController::class . '::session'
    ],
    'caching_backends' => [
        'path' => '/storage-framework-manager/caching-backends',
        'target' => Backend\StorageFrameworkManagerController::class . '::caching'
    ],
];
