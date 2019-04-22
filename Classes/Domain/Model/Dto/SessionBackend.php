<?php
declare(strict_types=1);

namespace Filoucrackeur\StorageFrameworkManager\Domain\Model\Dto;

use Filoucrackeur\StorageFrameworkManager\Type\Backend\Type;
use TYPO3\CMS\Core\Session\Backend\SessionBackendInterface;
use TYPO3\CMS\Core\Session\SessionManager;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class SessionBackend extends AbstractBackendInterface
{
    /**
     * @var SessionBackendInterface
     */
    protected $backend;

    /**
     * @return string
     */
    public function getType(): string
    {
        return Type::SESSION;
    }

    public function getBackend()
    {
        /** @var SessionManager $cm */
        $sm = GeneralUtility::makeInstance(SessionManager::class);
        $backend = $sm->getSessionBackend($this->getIdentifier());
        return $backend;
    }
}
