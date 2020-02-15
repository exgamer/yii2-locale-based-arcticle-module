<?php
namespace concepture\yii2article\models;

use concepture\yii2logic\models\traits\SeoTrait;
use concepture\yii2logic\traits\SeoPropertyTrait;
use concepture\yii2logic\validators\SeoNameValidator;
use concepture\yii2user\models\User;
use Yii;
use concepture\yii2logic\models\ActiveRecord;
use concepture\yii2logic\validators\TranslitValidator;
use concepture\yii2logic\models\traits\v2\property\HasLocalePropertyTrait;
use concepture\yii2logic\models\traits\StatusTrait;
use concepture\yii2handbook\models\traits\DomainTrait;
use concepture\yii2user\models\traits\UserTrait;
use concepture\yii2logic\validators\MD5Validator;
use concepture\yii2logic\models\traits\IsDeletedTrait;
use concepture\yii2handbook\models\traits\TagsTrait;
use concepture\yii2logic\validators\UniqueLocalizedValidator;
use kamaelkz\yii2cdnuploader\traits\ModelTrait;
use yii\helpers\ArrayHelper;

/**
 * Class Post
 * @package concepture\yii2article\models
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class Post extends ActiveRecord
{
    public $allow_physical_delete = false;

    use HasLocalePropertyTrait;
    use StatusTrait;
    use UserTrait;
    use IsDeletedTrait;
    use ModelTrait;
    use SeoTrait;


    /**
     * @see \concepture\yii2logic\models\ActiveRecord:label()
     *
     * @return string
     */
    public static function label()
    {
        return Yii::t('static', 'Посты');
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
        return '{{post}}';
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
                        'category_id',
                        'locale_id',
                        'sort',
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
                        'image_anons_big',
                    ],
                    'string',
                    'max'=>1024
                ],
                 [
                     [
                         'seo_name'
                     ],
                     \concepture\yii2logic\validators\v2\UniquePropertyValidator::class,
                     'propertyFields' => ['seo_name', 'locale_id']
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
            'category_id' => Yii::t('article','Категория'),
            'status' => Yii::t('article','Статус'),
            'locale_id' => Yii::t('article','Язык'),
            'image' => Yii::t('article','Изображение'),
            'image_anons' => Yii::t('article','Изображение для анонса'),
            'image_anons_big' => Yii::t('article','Изображение для анонса (большое)'),
            'title' => Yii::t('article','Название'),
            'anons' => Yii::t('article','Описание анонса'),
            'content' => Yii::t('article','Контент'),
            'created_at' => Yii::t('article','Дата создания'),
            'updated_at' => Yii::t('article','Дата обновления'),
            'is_deleted' => Yii::t('article','Удален'),
            'views' => Yii::t('article','Просмотры'),
            'sort' => Yii::t('article','Вес'),
            ]
        );
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->saveProperty($insert, $changedAttributes);

        return parent::afterSave($insert, $changedAttributes);
    }

    public function beforeDelete()
    {
        $this->deleteProperties();

        return parent::beforeDelete();
    }

    public function getCategory()
    {
        return $this->hasOne(PostCategory::class, ['id' => 'category_id']);
    }

    public function getCategoryTitle()
    {
        if (isset($this->category)){
            return $this->category->title;
        }

        return null;
    }

    public function getCategorySeoName()
    {
        if (isset($this->category)){
            return $this->category->seo_name;
        }

        return null;
    }
}
