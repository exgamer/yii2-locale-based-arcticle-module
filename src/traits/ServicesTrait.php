<?php
namespace concepture\yii2article\traits;

use concepture\yii2article\services\PostCategoryService;
use concepture\yii2article\services\PostService;
use concepture\yii2article\services\PostTagsLinkService;
use Yii;

/**
 * Trait ServicesTrait
 * @package concepture\yii2article\traits
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
trait ServicesTrait
{
    /**
     * @return PostCategoryService
     */
    public function postCategoryService()
    {
        return Yii::$app->postCategoryService;
    }

    /**
     * @return PostService
     */
    public function postService()
    {
        return Yii::$app->postService;
    }
}

