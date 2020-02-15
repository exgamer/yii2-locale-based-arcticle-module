<?php

namespace concepture\yii2article\web\controllers;

use concepture\yii2user\enum\UserRoleEnum;
use concepture\yii2logic\controllers\web\tree\Controller;
use kamaelkz\yii2cdnuploader\actions\web\ImageDeleteAction;
use kamaelkz\yii2cdnuploader\actions\web\ImageUploadAction;
use concepture\yii2logic\actions\web\v2\StatusChangeAction;

/**
 * Class PostCategoryController
 * @package concepture\yii2article\web\controllers
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class PostCategoryController extends Controller
{
    protected function getAccessRules()
    {
        return [
            [
                'actions' => ['index', 'create', 'update', 'delete',  'status-change', 'image-upload', 'image-delete'],
                'allow' => true,
                'roles' => [UserRoleEnum::ADMIN],
            ]
        ];
    }


    public function actions()
    {
        $actions = parent::actions();

        return array_merge($actions,[
            'status-change' => StatusChangeAction::class,
            'image-upload' => ImageUploadAction::class,
            'image-delete' => ImageDeleteAction::class,
        ]);
    }
}
