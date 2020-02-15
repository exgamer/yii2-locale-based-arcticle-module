<?php

use concepture\yii2logic\console\migrations\Migration;

/**
 * Class m191213_110848__post_published_dt
 */
class m191213_110848__post_published_dt extends Migration
{
    function getTableName()
    {
        return 'post';
    }

    public function safeUp()
    {
        $this->createColumn("published_at", $this->dateTime());
    }
}
