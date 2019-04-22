<?php
declare(strict_types=1);

namespace Filoucrackeur\StorageFrameworkManager\ViewHelpers;

use Exception;
use Filoucrackeur\StorageFrameworkManager\Utility\TreeUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class TreeViewHelper extends AbstractViewHelper
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
        $this->registerArgument('value', 'array', 'array to convert to tree', true);

    }

    /**
     * @return string
     * @throws Exception
     */
    public function render(): string
    {
        $array = $this->arguments['value'];

        return TreeUtility::fromArray($array);
    }
}
