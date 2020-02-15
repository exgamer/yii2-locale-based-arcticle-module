<?php

use concepture\yii2logic\console\migrations\Migration;

/**
 * Class m191002_151207_static_table
 */
class m191002_151207_post_category_table extends Migration
{
    function getTableName()
    {
        return 'post_category';
    }

    public function up()
    {
        $this->addTable([
            'id' => $this->bigPrimaryKey(),
            'parent_id' => $this->bigInteger()->defaultValue(null),
            'user_id' => $this->bigInteger()->defaultValue(null),
            'image' => $this->string(1024),
            'status' => $this->smallInteger()->defaultValue(0),
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression("NOW()")),
            'updated_at' => $this->dateTime(),
            'is_deleted' => $this->smallInteger()->defaultValue(0),
        ]);
        $this->addIndex(['user_id']);
        $this->addIndex(['status']);
        $this->addIndex(['is_deleted']);
        $this->addForeign('user_id', 'user','id');
        $this->addForeign('parent_id', 'post_category','id');
    }
}
