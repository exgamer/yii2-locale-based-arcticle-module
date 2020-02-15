<?php

use concepture\yii2logic\console\migrations\Migration;

/**
 * Class m191213_110850__post_views
 */
class m191213_110850__post_views extends Migration
{
    function getTableName()
    {
        return 'post';
    }

    public function safeUp()
    {
        $this->createColumn("views", $this->integer()->defaultValue(0));
    }
}
