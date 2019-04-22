<?php
declare(strict_types=1);

namespace Filoucrackeur\StorageFrameworkManager\Type\Backend;

use TYPO3\CMS\Core\Type\Enumeration;

class Status extends Enumeration
{
    const OK = 'success';

    const ALERT = 'danger';

    const WARNING = 'warning';

    const INFO = 'info';

    /**
     * @return bool
     */
    public function isOk(): bool
    {
        return $this->equals(self::OK);
    }

    /**
     * @return bool
     */
    public function isAlert(): bool
    {
        return $this->equals(self::ALERT);
    }

    /**
     * @return bool
     */
    public function isWarning(): bool
    {
        return $this->equals(self::WARNING);
    }

    /**
     * @return bool
     */
    public function isInfo(): bool
    {
        return $this->equals(self::INFO);
    }
}
