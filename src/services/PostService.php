<?php
namespace concepture\yii2article\services;

use concepture\yii2handbook\traits\ServicesTrait;
use concepture\yii2logic\services\traits\ViewsTrait;
use yii\db\ActiveQuery;
use concepture\yii2article\traits\ServicesTrait as ArticleServices;
use concepture\yii2logic\forms\Model;
use concepture\yii2logic\models\ActiveRecord;
use concepture\yii2logic\services\Service;
use Yii;
use concepture\yii2logic\services\traits\StatusTrait;
use concepture\yii2logic\services\traits\PropertyTrait;
use concepture\yii2logic\enum\StatusEnum;
use concepture\yii2logic\enum\IsDeletedEnum;
use concepture\yii2handbook\services\traits\ModifySupportTrait as HandbookModifySupportTrait;
use concepture\yii2handbook\services\traits\ReadSupportTrait as HandbookReadSupportTrait;
use concepture\yii2user\services\traits\UserSupportTrait;
use concepture\yii2handbook\services\traits\EntityTypeSupportTrait;

/**
 * Class PostService
 * @package concepture\yii2article\services
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class PostService extends Service
{
    use ArticleServices;
    use ServicesTrait;
    use StatusTrait;
    use PropertyTrait;
    use HandbookModifySupportTrait;
    use HandbookReadSupportTrait;
    use UserSupportTrait;
    use ViewsTrait;
    use EntityTypeSupportTrait;

    protected function beforeCreate(Model $form)
    {
        $this->setCurrentUser($form);
    }

    protected function afterModelSave(Model $form , ActiveRecord $model, $is_new_record)
    {
        $this->postCategoryService()->updatePostCount($form->category_id);
    }

    public function getDataProviderWithPosition($page = 0, $perPage = 50, $entity_type_position = null)
    {
        $config = [
            'pagination' => [
                'pageSize' => $perPage,
                'pageSizeParam' => false,
                'forcePageParam' => false,
            ]
        ];
        if(! $entity_type_position) {
            $config['sort'] = [
                'attributes' => ['created_at'],
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ];
        }

        return $this->getDataProvider([], $config, null, null,  function(ActiveQuery $query) use ($entity_type_position){
            if ($entity_type_position) {
                $entityTableName = $this->getTableName();
                $entity_type = $this->entityTypeService()->getOneByCondition(['table_name' => $entityTableName], true);
                if (!$entity_type) {
                    throw new Exception('Entity type not found.');
                }

                $this->entityTypePositionSortService()->applyQuery(
                    $query,
                    $entityTableName,
                    $entity_type->id,
                    $entity_type_position,
                    [
                        'created_at' => SORT_DESC
                    ]
                );
            }

            $query->andWhere([Match::tableName() . '.status' => StatusEnum::ACTIVE]);
            $query->andWhere([Match::tableName() . '.is_deleted' => IsDeletedEnum::NOT_DELETED]);
        });
    }
}
