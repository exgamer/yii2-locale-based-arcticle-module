<?php
namespace concepture\yii2article\models;

use concepture\yii2logic\models\TreeActiveRecord;


class PostCategoryTree extends TreeActiveRecord
{
    public static function tableName()
    {
        return '{{post_category_tree}}';
    }
}