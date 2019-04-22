<?php
defined('TYPO3_MODE') or die();

if (TYPO3_MODE === 'BE') {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'Filoucrackeur.storage_framework_manager',
        'tools',
        'tx_storageframeworkmanager',
        '',
        [
            'Backend\StorageFrameworkManager' => 'index,show',
        ],
        [
            'access' => 'admin',
            'icon' => 'EXT:storage_framework_manager/ext_icon.svg',
            'labels' => 'LLL:EXT:storage_framework_manager/Resources/Private/Language/locallang_mod.xlf',
        ]
    );
}
