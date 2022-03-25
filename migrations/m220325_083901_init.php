<?php

namespace craft\contentmigrations;

use Craft;
use craft\db\Migration;

/**
 * m220325_083901_init migration.
 */
class m220325_083901_init extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp(): bool
    {
        if (Craft::$app->request->isConsoleRequest) {
            Craft::$app->runAction('main/init');
        }
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
}
