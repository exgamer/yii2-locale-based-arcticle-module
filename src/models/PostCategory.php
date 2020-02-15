<?php
namespace concepture\yii2article\models;

use concepture\yii2logic\validators\SeoNameValidator;
use concepture\yii2user\models\User;
use concepture\yii2logic\validators\UniquePropertyValidator;
use Yii;
use concepture\yii2logic\models\ActiveRecord;
use concepture\yii2logic\validators\TranslitValidator;
use concepture\yii2logic\models\traits\v2\property\HasLocalePropertyTrait;
use concepture\yii2logic\models\traits\StatusTrait;
use concepture\yii2handbook\converters\LocaleConverter;
use concepture\yii2handbook\models\traits\DomainTrait;
use concepture\yii2user\models\traits\UserTrait;
use concepture\yii2logic\models\traits\IsDeletedTrait;
use concepture\yii2logic\models\traits\HasTreeTrait;
use concepture\yii2logic\validators\MD5Validator;
use concepture\yii2logic\validators\UniqueLocalizedValidator;
use kamaelkz\yii2cdnuploader\traits\ModelTrait;
use concepture\yii2logic\models\traits\SeoTrait;
use concepture\yii2logic\traits\SeoPropertyTrait;
use yii\helpers\ArrayHelper;

/**
 * Class PostCategory
 * @package concepture\yii2article\models
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class PostCategory extends ActiveRecord
{
    public $allow_physical_delete = false;

    use HasTreeTrait;
    use HasLocalePropertyTrait;
    use StatusTrait;
    use IsDeletedTrait;
    use UserTrait;
    use ModelTrait;
    use SeoTrait;

    /**
     * @see \concepture\yii2logic\models\ActiveRecord:label()
     *
     * @return string
     */
    public static function label()
    {
        return Yii::t('static', 'Категории постов');
    }

    /**
     * @see \concepture\yii2logic\models\ActiveRecord:toString()
     * @return string
     */
    public function toString()
    {
        return $this->title;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{post_category}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return ArrayHelper::merge(
            $this->seoRules(),
            [
            [
                [
                    'status',
                    'user_id',
                    'parent_id',
                    'locale_id',
                    'post_count',
                ],
                'integer'
            ],
            [
                [
                    'content'
                ],
                'string'
            ],
            [
                [
                    'title',
                    'anons',
                    'image',
                    'image_anons',
                ],
                'string',
                'max'=>1024
            ],
            [
                [
                    'seo_name'
                ],
                UniqueLocalizedValidator::class,
                'localizedFields' => ['seo_name', 'locale']
            ]
            ]
        );
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(
            $this->seoAttributeLabels(),
            [
            'id' => Yii::t('article','#'),
            'user_id' => Yii::t('article','Пользователь'),
            'parent_id' => Yii::t('comment','Родитель'),
            'status' => Yii::t('article','Статус'),
            'image' => Yii::t('article','Изображение'),
            'image_anons' => Yii::t('article','Изображение для анонса'),
            'locale_id' => Yii::t('article','Язык'),
            'title' => Yii::t('article','Название'),
            'anons' => Yii::t('article','Описание анонса'),
            'content' => Yii::t('article','Контент'),
            'created_at' => Yii::t('article','Дата создания'),
            'updated_at' => Yii::t('article','Дата обновления'),
            'is_deleted' => Yii::t('article','Удален'),
            'post_count' => Yii::t('article','Количество постов'),
            ]
        );
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->saveProperty($insert, $changedAttributes);
        $this->bindTree();

        return parent::afterSave($insert, $changedAttributes);
    }

    public function beforeDelete()
    {
        $this->deleteProperties();
        $this->removeTree();

       return parent::beforeDelete();
    }

    public function getParentTitle()
    {
        if (isset($this->parent)){
            return $this->parent->title;
        }

        return null;
    }

    public function getParentSeoName()
    {
        if (isset($this->parent)){
            return $this->parent->seo_name;
        }

        return null;
    }
}
