<?php
/**
 * General Configuration
 *
 * All of your system's general configuration settings go in here. You can see a
 * list of the available settings in vendor/craftcms/cms/src/config/GeneralConfig.php.
 *
 * @see \craft\config\GeneralConfig
 */

use craft\config\GeneralConfig;
use craft\helpers\App;

$isDev = App::env('CRAFT_ENVIRONMENT') === 'dev';
$isProd = App::env('CRAFT_ENVIRONMENT') === 'production';

return
	GeneralConfig::create()
		->devMode($isDev)
		->allowAdminChanges($isDev)

        ->preloadSingles(true)

		->maxRevisions(10)
		->defaultWeekStartDay(1)

		->omitScriptNameInUrls(true)
		->cpTrigger('admin')
		->limitAutoSlugsToAscii(true)

		->preventUserEnumeration(true)
		->sendPoweredByHeader(false)
		->disallowRobots(!$isProd)

		->defaultTemplateExtensions(['twig'])
		->enableTemplateCaching($isProd)

		->convertFilenamesToAscii(true)
		->maxUploadFileSize('32M')
		->generateTransformsBeforePageLoad(true)
		->optimizeImageFilesize(false)
		->revAssetUrls(true)
        ->tempAssetUploadFs('tempimages_local')

		->useIframeResizer(true)

		->aliases([
			// Prevent the @web alias from being set automatically (cache poisoning vulnerability)
			'@web' => App::env('PRIMARY_SITE_URL'),
			// Lets `./craft clear-caches all` clear CP resources cache
			'@webroot' => dirname(__DIR__) . '/web',
		]);

