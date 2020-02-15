<?php

use concepture\yii2logic\console\migrations\Migration;

/**
 * Class m191213_110851__post_sort
 */
class m191213_110851__post_sort extends Migration
{
    function getTableName()
    {
        return 'post';
    }

    public function safeUp()
    {
        $this->createColumn("sort", $this->integer());
    }
}
