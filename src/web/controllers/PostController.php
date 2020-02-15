<?php

namespace concepture\yii2article\web\controllers;

use concepture\yii2user\enum\UserRoleEnum;
use concepture\yii2logic\controllers\web\Controller;
use concepture\yii2logic\actions\web\StatusChangeAction;
use kamaelkz\yii2cdnuploader\actions\web\ImageDeleteAction;
use kamaelkz\yii2cdnuploader\actions\web\ImageUploadAction;

/**
 * Class PostController
 * @package concepture\yii2article\web\controllers
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class PostController extends Controller
{
    protected function getAccessRules()
    {
        return [
            [
                'actions' => ['index', 'create', 'update', 'delete', 'status-change', 'image-upload', 'image-delete'],
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
