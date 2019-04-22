<?php
declare(strict_types=1);

namespace Filoucrackeur\StorageFrameworkManager\Type\Backend;

use TYPO3\CMS\Core\Type\Enumeration;

class Session extends Enumeration
{
    const FE = 'FE';

    const BE = 'BE';

    /**
     * @return bool
     */
    public function isFrontent(): bool
    {
        return $this->equals(self::FE);
    }

    /**
     * @return bool
     */
    public function isBackend(): bool
    {
        return $this->equals(self::BE);
    }
}
