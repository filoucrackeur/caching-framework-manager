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
    public function show(ServerRequestInterface $request): ResponseInterface
    {
        $view = $this->initializeStandaloneView($request, 'Backend/StorageFrameworkManager/Show.html');
        $cacheManagerService = GeneralUtility::makeInstance(CacheManagerService::class);

        return new JsonResponse([
            'success' => true,
            'html' => $view->render(),
        ]);
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
     */
    public function core(ServerRequestInterface $request): ResponseInterface
    {
        $view = $this->initializeStandaloneView($request, 'Backend/StorageFrameworkManager/Backend/Core.html');

        $cacheManagerService = GeneralUtility::makeInstance(CacheManagerService::class);

        $view->assignMultiple([
            'backends' => $cacheManagerService->getCacheCoreBackends(),
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
     */
    public function extensions(ServerRequestInterface $request): ResponseInterface
    {
        $view = $this->initializeStandaloneView($request, 'Backend/StorageFrameworkManager/Backend/Extensions.html');
        $cacheManagerService = GeneralUtility::makeInstance(CacheManagerService::class);

        $view->assignMultiple([
            'backends' => $cacheManagerService->getCacheExtensionsBackends(),
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
     */
    public function backend(ServerRequestInterface $request): ResponseInterface
    {

        $backend = GeneralUtility::makeInstance(CacheManagerService::class)
            ->getSessionBackendByIdentifier('BE');
//            ->getCacheBackendByIdentifier('cache_pages');

        try {
            $backend->getBackend()->validateConfiguration();
        } catch (\Exception $e) {
            var_dump($e);
        }
        die;

        return new JsonResponse([
            'success' => true,
            'backend' => [
                'identifier' => $backend->getIdentifier(),
                'type' => $backend->getType(),
                'status' => $backend->getStatus(),
                'configuration' => $backend->getConfiguration(),
            ],
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
