<?php

namespace concepture\yii2article\web\controllers;

use concepture\yii2user\enum\UserRoleEnum;
use concepture\yii2logic\controllers\web\tree\Controller;
use kamaelkz\yii2cdnuploader\actions\web\ImageDeleteAction;
use kamaelkz\yii2cdnuploader\actions\web\ImageUploadAction;
use concepture\yii2logic\actions\web\v2\StatusChangeAction;
use concepture\yii2handbook\actions\PositionSortIndexAction;
use kamaelkz\yii2admin\v1\actions\EditableColumnAction;
use kamaelkz\yii2admin\v1\actions\SortAction;
use concepture\yii2handbook\services\EntityTypePositionSortService;

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
                'actions' => ['index', 'create', 'update', 'delete',  'status-change', 'image-upload', 'image-delete',
                    PositionSortIndexAction::actionName(),
                    EditableColumnAction::actionName(),
                    SortAction::actionName(),
                ],
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
            PositionSortIndexAction::actionName() => [
                'class' => PositionSortIndexAction::class,
                'entityColumns' => [
                    'id',
                    'title',
                    'seo_name',
                ],
                'labelColumn' => 'name',
            ],
            EditableColumnAction::actionName() => [
                'class' => EditableColumnAction::class,
                'serviceClass' => EntityTypePositionSortService::class
            ],
            SortAction::actionName() => [
                'class' => SortAction::class,
                'serviceClass' => EntityTypePositionSortService::class
            ],
        ]);
    }
}
