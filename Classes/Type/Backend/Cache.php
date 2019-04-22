<?php
declare(strict_types=1);

namespace Filoucrackeur\StorageFrameworkManager\Type\Backend;

use TYPO3\CMS\Core\Type\Enumeration;

class Cache extends Enumeration
{
    const CACHE_CORE = 'cache_core';

    const CACHE_HASH = 'cache_hash';

    const CACHE_PAGES = 'cache_pages';

    const CACHE_PAGESECTION = 'cache_pagesection';

    const CACHE_RUNTIME = 'cache_runtime';

    const CACHE_ROOTLINE = 'cache_rootline';

    const CACHE_IMAGESIZES = 'cache_imagesizes';

    const CACHE_ASSETS = 'assets';

    const CACHE_L10N = 'l10n';

    const CACHE_FLUID_TEMPLATE = 'fluid_template';

    const CACHE_EXTBASE_REFLECTION = 'extbase_reflection';

    const CACHE_EXTBASE_DATAMAPFACTORY_DATAMAP = 'extbase_datamapfactory_datamap';

    const CACHE_ADMINPANEL_REQUESTCACHE = 'adminpanel_requestcache';
}
