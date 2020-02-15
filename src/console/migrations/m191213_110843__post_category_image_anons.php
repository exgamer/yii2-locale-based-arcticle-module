<?php

use concepture\yii2logic\console\migrations\Migration;

/**
 * Class m191213_110843__post_category_image_anons
 */
class m191213_110843__post_category_image_anons extends Migration
{
    function getTableName()
    {
        return 'post_category';
    }

    public function safeUp()
    {
        $this->createColumn("image_anons", $this->string(1024));
    }
}
