<?php
namespace concepture\yii2article\services;

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

/**
 * Class PostService
 * @package concepture\yii2article\services
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class PostService extends Service
{
    use ArticleServices;
    use StatusTrait;
    use PropertyTrait;
    use HandbookModifySupportTrait;
    use HandbookReadSupportTrait;
    use UserSupportTrait;
    use ViewsTrait;

    protected function beforeCreate(Model $form)
    {
        $this->setCurrentUser($form);
    }

    protected function afterModelSave(Model $form , ActiveRecord $model, $is_new_record)
    {
        $this->postCategoryService()->updatePostCount($form->category_id);
    }
}
