<?php

use concepture\yii2logic\console\migrations\Migration;

/**
 * Class m191213_110845__post_category_post_count
 */
class m191213_110845__post_category_post_count extends Migration
{
    function getTableName()
    {
        return 'post_category';
    }

    public function safeUp()
    {
        $this->createColumn("post_count", $this->integer());
    }
}
