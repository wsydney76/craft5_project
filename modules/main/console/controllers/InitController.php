<?php

namespace modules\main\console\controllers;

use Craft;
use craft\console\Controller;
use craft\elements\Asset;
use craft\elements\conditions\assets\AssetCondition;
use craft\elements\conditions\assets\HasAltConditionRule;
use craft\elements\conditions\assets\VolumeConditionRule;
use craft\elements\Entry;
use craft\errors\BusyResourceException;
use craft\errors\InvalidFieldException;
use craft\errors\SectionNotFoundException;
use craft\errors\StaleResourceException;
use craft\errors\VolumeException;
use craft\helpers\StringHelper;
use craft\services\ProjectConfig;
use DateTime;
use Exception;
use yii\base\ErrorException;
use yii\base\InvalidConfigException;
use yii\base\NotSupportedException;
use yii\console\ExitCode;
use yii\web\ServerErrorHttpException;

class InitController extends Controller
{

    public $defaultAction = 'init';

    public function actionInit(): int
    {

        $this->stdout("Set element sources... ");
        $this->actionSetElementSources();

        return ExitCode::OK;
    }

    // php craft main/init/set-element-sources
    public function actionSetElementSources(): int
    {
        $this->setAssetsSources();
        $this->setEntriesSources();

        $this->stdout("Done\n");
        return ExitCode::OK;
    }

    /**
     * @throws NotSupportedException
     * @throws InvalidConfigException
     * @throws ServerErrorHttpException
     * @throws VolumeException
     * @throws StaleResourceException
     * @throws \yii\base\Exception
     * @throws BusyResourceException
     * @throws ErrorException
     */
    protected function setAssetsSources(): void
    {

        $assetSettings = [
            [
                'key' => $this->getVolumeKey('images'),
                'tableAttributes' => [
                    'alt',
                    'imageSize',
                    'dateModified',
                    'link'
                ],
                'type' => 'native'
            ],
            [
                'heading' => 'Quality',
                'type' => 'heading'
            ],
            [
                'condition' => [
                    'class' => AssetCondition::class,
                    'conditionRules' => [
                        [
                            'class' => VolumeConditionRule::class,
                            'operator' => 'in',
                            'uid' => $this->getUid(),
                            'values' => [
                                Craft::$app->volumes->getVolumeByHandle('images')->uid
                            ]
                        ],
                        [
                            'class' => HasAltConditionRule::class,
                            'uid' => $this->getUid(),
                            'value' => false
                        ]
                    ],
                    'elementType' => Asset::class,
                    'fieldContext' => 'global'
                ],
                'key' => 'custom:' . $this->getUid(),
                'label' => 'Missing alt text',
                'tableAttributes' => ['imageSize', 'dateModified', 'link'],
                'type' => 'custom'
            ],
            [
                'heading' => 'Internal',
                'type' => 'heading'
            ],
            [
                'key' => $this->getVolumeKey('tempImages'),
                'tableAttributes' => [
                    'alt',
                    'imageSize',
                    'dateModified',
                    'link'
                ],
                'type' => 'native'
            ],
            [
                'key' => $this->getVolumeKey('userPhotos'),
                'tableAttributes' => [
                    'alt',
                    'imageSize',
                    'dateModified',
                    'link'
                ],
                'type' => 'native'
            ]
        ];

        Craft::$app->projectConfig->set(ProjectConfig::PATH_ELEMENT_SOURCES . '.' . Asset::class, $assetSettings);
    }

    protected function setEntriesSources(): void
    {

        $entrySettings = [
            [
                'key' => '*',
                'tableAttributes' => [
                    'section',
                    'postDate',
                    'link'
                ],
                'type' => 'native'
            ],
            [
                'heading' => 'Site',
                'type' => 'heading'
            ],
            [
                'key' => 'singles',
                'tableAttributes' => [
                    'drafts',
                    $this->getFieldKey('featuredImage'),
                    'link'
                ],
                'type' => 'native'
            ],
            [
                'key' => $this->getSectionKey('page'),
                'tableAttributes' => [
                    'drafts',
                    'type',
                    $this->getFieldKey('featuredImage'),
                    'postDate',
                    'link'
                ],
                'type' => 'native'
            ],
        ];

        Craft::$app->projectConfig->set(ProjectConfig::PATH_ELEMENT_SOURCES . '.' . Entry::class, $entrySettings);
    }

    protected function getSectionKey(string $handle): string
    {
        $section = Craft::$app->sections->getSectionByHandle($handle);
        if (!$section) {
            throw new SectionNotFoundException();
        }
        return "section:$section->uid";
    }

    protected function getFieldKey(string $handle): string
    {
        $field = Craft::$app->fields->getFieldByHandle($handle);
        if (!$field) {
            throw new InvalidFieldException($handle);
        }
        return "field:$field->uid";
    }

    protected function getVolumeKey(string $handle): string
    {
        $volume = Craft::$app->volumes->getVolumeByHandle($handle);
        if (!$volume) {
            throw new VolumeException();
        }
        return "volume:$volume->uid";
    }

    /**
     * @throws Exception
     */
    protected function getUid()
    {
        return StringHelper::UUID();
    }

}
