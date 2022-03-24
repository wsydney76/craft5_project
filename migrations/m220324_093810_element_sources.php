<?php

namespace craft\contentmigrations;

use Craft;
use craft\base\Field;
use craft\db\Migration;
use craft\elements\Asset;
use craft\elements\conditions\assets\HasAltConditionRule;
use craft\services\ProjectConfig;
use craft\elements\conditions\assets\VolumeConditionRule;
use craft\elements\conditions\assets\AssetCondition;

/**
 * m220324_093810_element_sources migration.
 */
class m220324_093810_element_sources extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp(): bool
    {
        $this->setAssetIndexes();
        $this->setElementIndexes();
        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown(): bool
    {
        echo "There is nothing to revert.\n";
        return true;
    }

    protected function setAssetIndexes(): void
    {

        $assetSources = [
            'siteHeading' => ['type' => 'heading', 'heading' => 'Site Assets'],
            'images' => ['type' => 'key', 'tableAttributes' => ['alt', 'imageSize', 'dateModified', 'link']],
            'internalHeading' => ['type' => 'heading', 'heading' => 'Internal'],
            'tempImages' => ['type' => 'key', 'tableAttributes' => ['filename', 'imageSize', 'dateModified', 'link']],
            'userPhotos' => ['type' => 'key', 'tableAttributes' => ['filename', 'imageSize', 'dateModified', 'link']],
            'qualityHeading' => ['type' => 'heading', 'heading' => 'Quality'],
            'missingAlt' => [
                'type' => 'condition',
                'source' => [
                    'condition' => [
                        'class' => AssetCondition::class,
                        'conditionRules' => [
                            [
                                'class' => VolumeConditionRule::class,
                                'operator' => 'in',
                                'uid' => '79f2feb4-b598-432c-b4bd-9c575c39ca05',
                                'values' => [
                                    Craft::$app->volumes->getVolumeByHandle('images')->uid
                                ]
                            ],
                            [
                                'class' => HasAltConditionRule::class,
                                'uid' => 'ed2080f1-740a-4b76-b3f2-4f61febf437d',
                                'value' => false
                            ]
                        ],
                        'elementType' => Asset::class,
                        'fieldContext' => 'global'
                    ],
                    'key' => 'custom:8cbdeae2-e144-4ce6-978c-7e34c1475280',
                    'label' => 'Missing alt text',
                    'tableAttributes' => ['imageSize','dateModified','link'],
                    'type' => 'custom'
                ]
            ]
        ];

        $assetSettings = [];

        foreach ($assetSources as $handle => $source) {
            if ($source['type'] == 'key') {
                $volume = Craft::$app->volumes->getVolumeByHandle($handle);
                if ($volume) {
                    $assetSettings[] = [
                        'key' => 'volume:' . $volume->uid,
                        'tableAttributes' => $source['tableAttributes'],
                        'type' => 'native'
                    ];
                }
            }

            if ($source['type'] == 'heading') {
                $assetSettings[] = ['heading' => $source['heading'], 'type' => 'heading'];
            }

            if ($source['type'] == 'condition') {
                $assetSettings[] = $source['source'];
            }
        }

        Craft::$app->projectConfig->set(ProjectConfig::PATH_ELEMENT_SOURCES . '.craft\\elements\\Asset', $assetSettings);
    }

    protected function setElementIndexes(): void
    {
        $sections = Craft::$app->sections->getAllSections();
        $s = [];
        foreach ($sections as $section) {
            $s[$section->handle] = 'section:' . $section->uid;
        }

        $f = [];
        $fields = Craft::$app->fields->getAllFields();
        foreach ($fields as $field) {
            /** @var Field $field */
            $f[$field->handle] = 'field:' . $field->uid;
        }

        $entrySettings = [
            ['key' => '*', 'tableAttributes' => ['section', 'postDate', 'link'], 'type' => 'native'],
            ['heading' => 'Site', 'type' => 'heading'],
            ['key' => 'singles', 'tableAttributes' => ['drafts', $f['featuredImage'], 'link'], 'type' => 'native'],
            ['key' => $s['page'], 'tableAttributes' => ['drafts', 'type', $f['featuredImage'], 'postDate', 'link'], 'type' => 'native'],
        ];

        Craft::$app->projectConfig->set(ProjectConfig::PATH_ELEMENT_SOURCES . '.craft\\elements\\Entry', $entrySettings);
    }

}
