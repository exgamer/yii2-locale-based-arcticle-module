<?php

namespace concepture\yii2article\search;

use concepture\yii2article\models\Post;
use yii\db\ActiveQuery;
use Yii;
use yii\data\ActiveDataProvider;

/**
 * Class PostSearch
 * @package concepture\yii2article\search
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class PostSearch extends Post
{
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
                    'category_id',
                    'is_deleted',
                ],
                'integer'
            ],
            [
                [
                    'title',
                    'seo_name',
                ],
                'safe'
            ]
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
        $query->andFilterWhere([
            static::tableName().'.category_id' => $this->category_id
        ]);
        $query->andWhere([
            static::tableName().'.is_deleted' => 0
        ]);
        $query->andFilterWhere(['like', static::propertyAlias() . ".seo_name", $this->seo_name]);
        $query->andFilterWhere(['like', static::propertyAlias() . ".title", $this->title]);
    }

    public function extendDataProvider(ActiveDataProvider $dataProvider)
    {
        $this->addSortByPropertyAttribute($dataProvider, 'seo_name');
        $this->addSortByPropertyAttribute($dataProvider, 'title');
    }
}
