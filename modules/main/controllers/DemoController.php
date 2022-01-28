<?php

namespace modules\main\controllers;

use craft\web\Controller;

class DemoController extends Controller
{
    protected $allowAnonymous = true;

    // .../actions/main/demo/say-hello
    public function actionSayHello()
    {
        return 'Hello World';
    }
}
