<?php

namespace modules\main\console\controllers;

use craft\console\Controller;

class DemoController extends Controller
{
    // php craft main/demo/say-hello
    public function actionSayHello()
    {
        $this->stdout('Hello World');
    }
}
