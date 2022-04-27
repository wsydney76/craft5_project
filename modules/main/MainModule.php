<?php

namespace modules\main;

use Craft;
use craft\base\Element;
use craft\elements\Asset;
use craft\events\ElementEvent;
use craft\events\RegisterElementTableAttributesEvent;
use craft\helpers\ElementHelper;
use craft\services\Elements;
use yii\base\Event;
use yii\base\Module;

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
            // $event->tableAttributes['copyright'] = ['label' => Craft::t('site', 'Copyright')];
        });

        // Don't update search index for drafts
        Event::on(
            Elements::class,
            Elements::EVENT_BEFORE_UPDATE_SEARCH_INDEX,
            function(ElementEvent $event) {
                if (ElementHelper::isDraft($event->element)) {
                    $event->isValid = false;
                }
            }
        );

        parent::init();
    }
}
