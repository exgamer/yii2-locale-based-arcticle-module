<?php

use concepture\yii2logic\console\migrations\Migration;

/**
 * Class m191005_101559_post_cat_loc_anons_fix
 */
class m191005_101559_post_cat_loc_anons_fix extends Migration
{
    function getTableName()
    {
        return 'post_category_property';
    }

    public function safeUp()
    {
        $this->createColumn("anons", $this->string(1024));
    }
}
