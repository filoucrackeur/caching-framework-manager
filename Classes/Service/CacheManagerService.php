<?php
declare(strict_types=1);

namespace Filoucrackeur\StorageFrameworkManager\Service;

use Filoucrackeur\StorageFrameworkManager\Domain\Model\Dto\CacheBackend;
use Filoucrackeur\StorageFrameworkManager\Domain\Model\Dto\SessionBackend;
use TYPO3\CMS\Core\SingletonInterface;

class CacheManagerService implements SingletonInterface
{

    private const TYPO3_CORE_CACHE_IDENTIFIERS = [
        'cache_core',
        'cache_hash',
        'cache_pages',
        'cache_pagesection',
        'cache_runtime',
        'cache_rootline',
        'cache_imagesizes',
        'assets',
        'l10n',
        'fluid_template',
        'extbase_reflection',
        'extbase_datamapfactory_datamap',
        'adminpanel_requestcache',
    ];

    private const TYPO3_SESSION_IDENTIFIERS = [
        'BE',
        'FE',
    ];

    /**
     * @var array
     */
    private $cacheExtensionsBackends = [];

    /**
     * @return array
     */
    public function getSessionBackends(): array
    {
        return self::TYPO3_SESSION_IDENTIFIERS;
    }

    /**
     * @return array
     */
    public function getCacheCoreBackends(): array
    {
        return self::TYPO3_CORE_CACHE_IDENTIFIERS;
    }

    /**
     * @return array
     */
    public function getCacheExtensionsBackends(): array
    {
        $cacheConfigurations = $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations'];

        foreach ($cacheConfigurations as $identifier => $configuration) {
            if (!in_array($identifier, self::TYPO3_CORE_CACHE_IDENTIFIERS, true)) {
                $this->cacheExtensionsBackends[] = $identifier;
            }
        }

        return $this->cacheExtensionsBackends;
    }

    /**
     * @param string $identifier
     * @return CacheBackend
     */
    public function getCacheBackendByIdentifier(string $identifier): CacheBackend
    {
        return new CacheBackend(
            $identifier,
            $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations'][$identifier]['backend'],
            $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations'][$identifier]
        );
    }

    /**
     * @param string $identifier
     * @return SessionBackend
     */
    public function getSessionBackendByIdentifier(string $identifier): SessionBackend
    {
        return new SessionBackend(
            $identifier,
            $GLOBALS['TYPO3_CONF_VARS']['SYS']['session'][$identifier]['backend'],
            $GLOBALS['TYPO3_CONF_VARS']['SYS']['session'][$identifier]
        );
    }

}