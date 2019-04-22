<?php
declare(strict_types=1);

namespace Filoucrackeur\StorageFrameworkManager\Controller\Backend;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Fluid\View\StandaloneView;

class AbstractController extends ActionController
{
    const EXTENTION_NAME = 'storage_framework_manager';

    /**
     * @param ServerRequestInterface $request
     * @param string $templatePath
     * @return StandaloneView
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\InvalidExtensionNameException
     * @internal param string $template
     */
    protected function initializeStandaloneView(ServerRequestInterface $request, string $templatePath): StandaloneView
    {
        $viewRootPath = GeneralUtility::getFileAbsFileName('EXT:' . self::EXTENTION_NAME . '/Resources/Private/');
        $view = GeneralUtility::makeInstance(StandaloneView::class);
        $view->getRequest()->setControllerExtensionName('StorageFrameworkManager');
        $view->setTemplatePathAndFilename($viewRootPath . 'Templates/' . $templatePath);
        $view->setLayoutRootPaths([$viewRootPath . 'Layouts/']);
        $view->setPartialRootPaths([$viewRootPath . 'Partials/']);
        $view->assignMultiple([
            'controller' => $request->getQueryParams()['storageFrameworkManager']['controller'] ?? 'maintenance',
            'context' => $request->getQueryParams()['storageFrameworkManager']['context'] ?? '',
            'composerMode' => Environment::isComposerMode(),
        ]);
        return $view;
    }

    protected function loadExtLocalconfDatabaseAndExtTables(): void
    {
        \TYPO3\CMS\Core\Core\Bootstrap::loadTypo3LoadedExtAndExtLocalconf(false);
        \TYPO3\CMS\Core\Core\Bootstrap::unsetReservedGlobalVariables();
        \TYPO3\CMS\Core\Core\Bootstrap::loadBaseTca(false);
        \TYPO3\CMS\Core\Core\Bootstrap::loadExtTables(false);
    }
}
