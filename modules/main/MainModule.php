<?php

namespace modules\main;

use Craft;
use craft\base\Element;
use craft\elements\Asset;
use craft\elements\Entry;
use craft\events\ModelEvent;
use craft\events\RegisterElementTableAttributesEvent;
use craft\helpers\ElementHelper;
use craft\records\Element_SiteSettings;
use yii\base\Event;
use yii\base\Module;
use function str_replace;

class MainModule extends Module
{
    public function init(): void
    {
        Craft::setAlias('@modules/main', $this->getBasePath());

        // Set the controllerNamespace based on whether this is a console or web request
        if (Craft::$app->getRequest()->getIsConsoleRequest()) {
            $this->controllerNamespace = 'modules\\main\\console\\controllers';
        } else {
            $this->controllerNamespace = 'modules\\main\\controllers';
        }

        // Prevent password managers like Bitdefender Wallet from falsely inserting credentials into user form
        Craft::$app->view->hook('cp.users.edit.content', function(array &$context) {
            return '<input type="text" name="dummy-first-name" value="wtf" style="display: none">';
        });

        // Register element index column
        Event::on(
            Asset::class,
            Element::EVENT_REGISTER_TABLE_ATTRIBUTES, function(RegisterElementTableAttributesEvent $event) {
            $event->tableAttributes['alt'] = ['label' => Craft::t('app', 'Alternative Text')];
            $event->tableAttributes['copyright'] = ['label' => Craft::t('site', 'Copyright')];
        });

        Event::on(
            Entry::class,
            Entry::EVENT_AFTER_SAVE, function(ModelEvent $event) {
            $this->repairUri($event->sender);
        });

        parent::init();
    }

    protected function repairUri($entry): void
    {
        if (ElementHelper::isDraftOrRevision($entry)) {
            return;
        }
        if (!$entry->scenario == Entry::SCENARIO_LIVE) {
            return;
        }

        $records = Element_SiteSettings::find()
            ->where(['elementId' => $entry->id])
            ->andWhere(['like', 'uri', '('])
            ->all();

        foreach ($records as $record) {
            $newUri = str_replace('(', '', $record->uri);

            $record->uri = $newUri;
            $record->save();
        }
    }
}
