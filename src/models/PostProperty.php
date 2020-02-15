<?php
namespace concepture\yii2article\models;

use Yii;
use concepture\yii2logic\models\ActiveRecord;

/**
 * Class PostLocalization
 * @package concepture\yii2article\models
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class PostProperty extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{post_property}}';
    }
}
