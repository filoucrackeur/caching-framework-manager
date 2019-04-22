<?php
declare(strict_types=1);

namespace Filoucrackeur\StorageFrameworkManager\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class ConfigurationViewHelper extends AbstractViewHelper
{

    /**
     * @var bool
     */
    protected $escapeOutput = false;

    /**
     * @var bool
     */
    protected $escapeChildren = false;

    /**
     * Initialize arguments.
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('type', 'string', 'Backend type session or cache', true);
        $this->registerArgument('identifier', 'string', 'Cache identifier', false, null);
    }

    /**
     * @return array|null
     */
    public function render(): ?array
    {
        if ($this->arguments['type'] === 'cache') {

            if (isset($this->arguments['identifier']) && '' !== $this->arguments['identifier']) {
                return $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations'][$this->arguments['identifier']];
            }

            return $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations'];
        }

        if ($this->arguments['type'] === 'session') {

            if (isset($this->arguments['identifier']) && '' !== $this->arguments['identifier']) {
                return $GLOBALS['TYPO3_CONF_VARS']['SYS']['session'][$this->arguments['identifier']];
            }

            return $GLOBALS['TYPO3_CONF_VARS']['SYS']['session'];
        }

        return null;
    }
}
