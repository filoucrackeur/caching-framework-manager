<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$boot = function ($_EXTKEY) {
    $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
        \TYPO3\CMS\Core\Imaging\IconRegistry::class
    );

    $images = [
        'tx-storage-framework-manager-logo',
        'tx-storage-framework-manager-redis',
        'tx-storage-framework-manager-database',
        'tx-storage-framework-manager-simple-file',
        'tx-storage-framework-manager-file',
        'tx-storage-framework-manager-wincache',
        'tx-storage-framework-manager-transient-memory',
        'tx-storage-framework-manager-pdo',
        'tx-storage-framework-manager-memcached',
        'tx-storage-framework-manager-apc',
        'tx-storage-framework-manager-apcu',
        'tx-storage-framework-manager-null',
        'tx-storage-framework-manager-core',
        'tx-storage-framework-manager-extensions',
        'tx-storage-framework-manager-session',
        'tx-storage-framework-manager-logo',
    ];

    foreach ($images as $key => $image) {
        $iconRegistry->registerIcon(
            $image,
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:storage_framework_manager/Resources/Public/Icons/' . $image . '.svg']
        );
    }

};

$boot($_EXTKEY);
unset($boot);
