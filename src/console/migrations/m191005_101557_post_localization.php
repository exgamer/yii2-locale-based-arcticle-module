<?php

use concepture\yii2logic\console\migrations\Migration;

/**
 * Class m191005_101557_static_block_localization
 */
class m191005_101557_post_localization extends Migration
{
    function getTableName()
    {
        return 'post_property';
    }

    public function up()
    {
        $this->addTable([
            'entity_id' => $this->bigInteger()->notNull(),
            'locale_id' => $this->bigInteger()->notNull(),
            'seo_name' => $this->string(1024),
            'seo_h1' => $this->string(1024),
            'seo_title' => $this->string(175),
            'seo_description' => $this->string(175),
            'seo_keywords' => $this->string(175),
            'title' => $this->string(1024)->notNull(),
            'content' => $this->text()->notNull()
        ]);
        $this->addPK(['entity_id', 'locale_id'], true);
        $this->addIndex(['entity_id']);
        $this->addIndex(['locale_id']);
        $this->addForeign('entity_id', 'post','id');
        $this->addForeign('locale_id', 'locale','id');
    }
}
