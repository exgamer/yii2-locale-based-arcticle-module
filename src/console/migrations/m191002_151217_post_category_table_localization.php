<?php

use concepture\yii2logic\console\migrations\Migration;

/**
 * Class m191002_151217_static_table_localization
 */
class m191002_151217_post_category_table_localization extends Migration
{
    function getTableName()
    {
        return 'post_category_property';
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
            'content' => $this->text()
        ]);
        $this->addPK(['entity_id', 'locale_id'], true);
        $this->addIndex(['entity_id']);
        $this->addIndex(['locale_id']);
        $this->addIndex(['url']);
        $this->addForeign('entity_id', 'post_category','id');
        $this->addForeign('locale_id', 'locale','id');
    }
}
