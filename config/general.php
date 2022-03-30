<?php
/**
 * General Configuration
 *
 * All of your system's general configuration settings go in here. You can see a
 * list of the available settings in vendor/craftcms/cms/src/config/GeneralConfig.php.
 *
 * @see \craft\config\GeneralConfig
 */

use config\Env;
use craft\helpers\App;

// Set Variables for use in CP
Env::setCpVars();

return [
    // Global settings
    '*' => [
        // Default Week Start Day (0 = Sunday, 1 = Monday...)
        'defaultWeekStartDay' => 1,

        // Whether generated URLs should omit "index.php"
        'omitScriptNameInUrls' => true,

        // Control Panel trigger word
        'cpTrigger' => 'admin',

        // The secure key Craft will use for hashing and encrypting data
        'securityKey' => Env::SECURITY_KEY,

        // Whether an X-Powered-By: Craft CMS header should be sent
        'sendPoweredByHeader' => false,

        // Whether to enable Craft's template {% cache %} tag on a global basis
        'enableTemplateCaching' => false,

        // Max No. of revisions
        'maxRevisions' => 10,

        // Whether uploaded filenames with non-ASCII characters should be converted to ASCII
        'convertFilenamesToAscii' => true,

        // needs php.ini max upload size and max post size set accordingly
        'maxUploadFileSize' => '32M',

        //Whether non-ASCII characters in auto-generated slugs should be converted to ASCII
        'limitAutoSlugsToAscii' => true,

        // Whether images transforms should be generated before page load.
        'generateTransformsBeforePageLoad' => true,

        // Whether Craft should optimize images for reduced file sizes without noticeably reducing image quality.
        'optimizeImageFilesize' => false,

        // Whether asset URLs should be revved so browsers don’t load cached versions when they’re modified.
        'revAssetUrls' => true,

        // Whether iFrame Resizer should be used for Live Preview.
        'useIframeResizer' => true,

        // Whether front end requests should respond with X-Robots-Tag: none HTTP headers
        'disallowRobots' => true,

        'aliases' => [
            // Prevent the @web alias from being set automatically (cache poisoning vulnerability)
            '@web' => Env::DEFAULT_SITE_URL,
            // Lets `./craft clear-caches all` clear CP resources cache
            '@webroot' => dirname(__DIR__) . '/web',
        ],

        // Whether Craft should run pending queue jobs automatically when someone visits the control panel.
        // Run php craft queue/listen if set to false
        'runQueueAutomatically' => Env::RUN_QUEUE_AUTOMATICALLY,
    ],

    // Dev environment settings
    'dev' => [
        // Dev Mode (see https://craftcms.com/guides/what-dev-mode-does)
        'devMode' => true,
    ],

    // Temporary Settings for installing or upgrading the site
    'install' => [
        'isSystemLive' => false,
    ],

    // Staging environment settings
    'staging' => [
        // Set this to `false` to prevent administrative changes from being made on staging
        'allowAdminChanges' => false,
    ],

    // Production environment settings
    'production' => [
        // Set this to `false` to prevent administrative changes from being made on production
        'allowAdminChanges' => false,

        // Whether to enable Craft's template {% cache %} tag on a global basis
        'enableTemplateCaching' => true,

        // Whether front end requests should respond with X-Robots-Tag: none HTTP headers
        'disallowRobots' => false,

    ],
];
