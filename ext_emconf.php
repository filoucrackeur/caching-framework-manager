<?php
$EM_CONF[$_EXTKEY] = [
    'title' => 'Storage framework manager',
    'description' => 'Storage framework manager extension for TYPO3',
    'category' => 'module',
    'state' => 'stable',
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'Philippe Court',
    'author_email' => 'contact@webstationservice.fr',
    'author_company' => 'Web Station Service',
    'version' => '1.0.0',
    '_md5_values_when_last_written' => '',
    'constraints' =>
        [
            'depends' =>
                [
                    'php' => '7.2.99-7.3.99',
                    'typo3' => '9.5.99-9.9.99',
                ],
            'conflicts' =>
                [
                ],
            'suggests' =>
                [
                ],
        ],
];
