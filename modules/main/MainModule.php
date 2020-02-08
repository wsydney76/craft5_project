<?php

namespace modules\main;

use Craft;
use yii\base\Module;

class MainModule extends Module
{
    public function init()
    {
        // Set the controllerNamespace based on whether this is a console or web request
        if (Craft::$app->getRequest()->getIsConsoleRequest()) {
            $this->controllerNamespace = 'modules\\console\\controllers';
        } else {
            $this->controllerNamespace = 'modules\\controllers';
        }

        parent::init();
    }
}
