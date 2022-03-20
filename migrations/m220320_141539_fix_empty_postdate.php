<?php

namespace craft\contentmigrations;

use Craft;
use craft\db\Migration;
use craft\elements\Entry;
use DateTime;

/**
 * m220320_141539_fix_empty_postdate migration.
 */
class m220320_141539_fix_empty_postdate extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp(): bool
    {
        $entries = Entry::find()->postDate(':empty:')->status(null)->all();
        foreach ($entries as $entry) {
            $entry->postDate = new DateTime();
            if (!Craft::$app->elements->saveElement($entry)) {
                Craft::error('Error saving ' . $entry->title, 'Starter');
            }
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
