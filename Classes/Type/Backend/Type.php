<?php
declare(strict_types=1);

namespace Filoucrackeur\StorageFrameworkManager\Type\Backend;

use TYPO3\CMS\Core\Type\Enumeration;

class Type extends Enumeration
{
    const SESSION = 'session';

    const CACHE = 'cache';

    /**
     * @return bool
     */
    public function isSession(): bool
    {
        return $this->equals(self::SESSION);
    }

    /**
     * @return bool
     */
    public function isCache(): bool
    {
        return $this->equals(self::CACHE);
    }
}
