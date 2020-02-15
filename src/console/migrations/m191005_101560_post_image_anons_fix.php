<?php

use concepture\yii2logic\console\migrations\Migration;

/**
 * Class m191005_101560_post_image_anons_fix
 */
class m191005_101560_post_image_anons_fix extends Migration
{
    function getTableName()
    {
        return 'post';
    }

    public function safeUp()
    {
        $this->createColumn("image_anons", $this->string(1024));
    }
}
