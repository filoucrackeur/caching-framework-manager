<?php
declare(strict_types=1);

namespace Filoucrackeur\StorageFrameworkManager\Controller\Backend;

use Filoucrackeur\StorageFrameworkManager\Service\CacheManagerService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Backend\View\BackendTemplateView;
use TYPO3\CMS\Core\Http\JsonResponse;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class StorageFrameworkManagerController extends AbstractController
{
    /**
     * @var BackendTemplateView
     */
    protected $view;

    /**
     * @var string
     */
    protected $defaultViewObjectName = BackendTemplateView::class;

    /**
     * @var CacheManagerService
     */
    protected $cacheManagerService;

    public function indexAction(): void
    {
        $pageRenderer = $this->view->getModuleTemplate()->getPageRenderer();
        $pageRenderer->addRequireJsConfiguration([
            'paths' => [
                'TYPO3/CMS/Install' => 'sysext/install/Resources/Public/JavaScript/Modules',
            ],
        ]);

        $pageRenderer->loadRequireJsModule(
            'TYPO3/CMS/StorageFrameworkManager/StorageFrameworkManagerModule'
        );
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\InvalidExtensionNameException
     */
    public function session(ServerRequestInterface $request): ResponseInterface
    {
        $view = $this->initializeStandaloneView($request, 'Backend/StorageFrameworkManager/Backend/Session.html');
        $cacheManagerService = GeneralUtility::makeInstance(CacheManagerService::class);

        $view->assignMultiple([
            'backends' => $cacheManagerService->getSessionBackends(),
        ]);

        return new JsonResponse([
            'success' => true,
            'html' => $view->render(),
        ]);
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws \TYPO3\CMS\Core\Cache\Exception\NoSuchCacheException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\InvalidExtensionNameException
     */
    public function caching(ServerRequestInterface $request): ResponseInterface
    {
        $view = $this->initializeStandaloneView($request, 'Backend/StorageFrameworkManager/Backend/Caching.html');

        $cacheManagerService = GeneralUtility::makeInstance(CacheManagerService::class);

        $view->assignMultiple([
            'coreBackends' => $cacheManagerService->getCacheCoreBackends(),
            'extensionsBackends' => $cacheManagerService->getCacheExtensionsBackends(),
        ]);

        return new JsonResponse([
            'success' => true,
            'html' => $view->render(),
        ]);
    }

    /**
     * @param CacheManagerService $cacheManagerService
     */
    public function injectCacheManagerService(CacheManagerService $cacheManagerService): void
    {
        $this->cacheManagerService = $cacheManagerService;
    }
}
