<?php

namespace modules\main\console\controllers;

use craft\console\Controller;
use craft\records\Element_SiteSettings;
use yii\console\ExitCode;
use function str_replace;

class UtilsController extends Controller
{
    public function actionRepairUri()
    {
        $records = Element_SiteSettings::find()
            ->where(['like', 'uri', '('])
            ->all();

        foreach ($records as $record) {
            $this->stdout("$record->elementId: $record->uri => ");

            $newUri = str_replace('(', '', $record->uri);

            $this->stdout($newUri);

            $record->uri = $newUri;

            $record->save();

            $this->stdout("\n");
        }

        return ExitCode::OK;
    }
}
