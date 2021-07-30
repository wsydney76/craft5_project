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

        // Whether to enable Craft's template {% cache %} tag on a global basis
        'enableTemplateCaching' => false,
        'cacheElementQueries' => false,

        // Max No. of revisions
        'maxRevisions' => 10,

        // Whether uploaded filenames with non-ASCII characters should be converted to ASCII
        'convertFilenamesToAscii' => true,

        //Whether non-ASCII characters in auto-generated slugs should be converted to ASCII
        'limitAutoSlugsToAscii' => true,

        // Whether images transforms should be generated before page load.
        'generateTransformsBeforePageLoad' => true,

        // Whether iFrame Resizer should be used for Live Preview.
        'useIframeResizer' => true,

        // Whether front end requests should respond with X-Robots-Tag: none HTTP headers
        'disallowRobots' => true,

        'aliases' => [
            // Prevent the @web alias from being set automatically (cache poisoning vulnerability)
            '@web' => App::env('PRIMARY_SITE_URL'),
            // Lets `./craft clear-caches all` clear CP resources cache
            '@webroot' => dirname(__DIR__) . '/web',
        ]
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
        'cacheElementQueries' => true,

        // Whether front end requests should respond with X-Robots-Tag: none HTTP headers
        'disallowRobots' => false,

    ],
];
