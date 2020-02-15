<?php

use concepture\yii2logic\console\migrations\Migration;

/**
 * Class m191213_110841__forecast_localization_init
 */
class m191213_110841__post_image_anons_big extends Migration
{
    function getTableName()
    {
        return 'post';
    }

    public function safeUp()
    {
        $this->createColumn("image_anons_big", $this->string(1024));
    }
}
