<?php

namespace concepture\yii2article\search;

use concepture\yii2article\models\PostCategory;
use yii\db\ActiveQuery;
use Yii;
use yii\data\ActiveDataProvider;

/**
 * Class StaticBlockSearch
 * @package concepture\yii2article\search
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class PostCategorySearch extends PostCategory
{
    public $parentWhereFunction = 'andWhere';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'id',
                    'status',
                    'parent_id',
                ],
                'integer'
            ],
            [
                [
                    'title',
                    'seo_name'
                ],
                'safe'
            ],
        ];
    }

    public function extendQuery(ActiveQuery $query)
    {
        $query->andFilterWhere([
            static::tableName().'.id' => $this->id
        ]);
        $query->andFilterWhere([
            static::tableName().'.status' => $this->status
        ]);
        $fName = $this->getParentWhereFunction();
        $query->{$fName}([
            static::tableName().'.parent_id' => $this->parent_id
        ]);
        $query->andWhere([
            static::tableName().'.is_deleted' => 0
        ]);
        $query->andFilterWhere(['like', static::propertyAlias() . ".seo_name", $this->seo_name]);
        $query->andFilterWhere(['like', static::propertyAlias() . ".title", $this->title]);
    }

    public function extendDataProvider(ActiveDataProvider $dataProvider)
    {
        $this->addSortByLocalizationAttribute($dataProvider, 'seo_name');
        $this->addSortByLocalizationAttribute($dataProvider, 'title');
    }

    public static function getListSearchKeyAttribute()
    {
        return 'id';
    }

    public static function getListSearchAttribute()
    {
        return 'title';
    }

    public function getParentWhereFunction()
    {
        return $this->parentWhereFunction;
    }

    public function setParentWhereFunction($name)
    {
        $this->parentWhereFunction = $name;
    }
}
