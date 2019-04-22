<?php
declare(strict_types=1);

namespace Filoucrackeur\StorageFrameworkManager\Domain\Model\Dto;

use Filoucrackeur\StorageFrameworkManager\Type\Backend\Status;
use Filoucrackeur\StorageFrameworkManager\Type\Backend\Type;
use TYPO3\CMS\Core\Cache\Backend\BackendInterface;
use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class CacheBackend extends AbstractBackendInterface
{

    /**
     * @var BackendInterface
     */
    protected $backend;

    /**
     * @return string
     */
    public function getType(): string
    {
        return Type::CACHE;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return Status::WARNING;
    }

    /**
     * @return mixed|\TYPO3\CMS\Core\Cache\Frontend\FrontendInterface
     * @throws \TYPO3\CMS\Core\Cache\Exception\NoSuchCacheException
     */
    public function getBackend()
    {
        /** @var CacheManager $cm */
        $cm = GeneralUtility::makeInstance(CacheManager::class);
        $cm->setCacheConfigurations($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']);
        $backend = $cm->getCache($this->getIdentifier());
        return $backend;
    }
}
