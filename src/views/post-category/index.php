<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kamaelkz\yii2admin\v1\widgets\formelements\Pjax;
use concepture\yii2handbook\converters\LocaleConverter;
use concepture\yii2logic\enum\StatusEnum;
use concepture\yii2logic\enum\IsDeletedEnum;
use yii\helpers\Url;
use kamaelkz\yii2admin\v1\themes\components\view\BreadcrumbsHelper;

$this->setTitle($searchModel::label());

$breadcrumbs = BreadcrumbsHelper::getClosurePath($searchModel, "title", "parent_id");
foreach ($breadcrumbs as $breadcrumb){
    $this->pushBreadcrumbs($breadcrumb);
}


$this->viewHelper()->pushPageHeader(['create', 'parent_id' => $searchModel->parent_id]);
?>
<?php Pjax::begin(); ?>

<?php if (Yii::$app->localeService->catalogCount() > 1): ?>
    <ul class="nav nav-tabs nav-tabs-solid nav-justified bg-light">
        <?php foreach (Yii::$app->localeService->catalog() as $key => $locale):?>
            <li class="nav-item">
                <?= Html::a(
                    $locale,
                    \yii\helpers\Url::current(['locale' => $key]),
                    ['class' => 'nav-link ' . ($key ==  $searchModel::currentLocale()  ? "active" : "")]
                ) ?>
            </li>
        <?php endforeach;?>
    </ul>
<?php endif; ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'searchVisible' => true,
    'searchParams' => [
        'model' => $searchModel
    ],
    'columns' => [
        'id',
        'title',
        'seo_name',
        [
            'attribute'=>'status',
            'filter'=> StatusEnum::arrayList(),
            'value'=>function($data) {
                return $data->statusLabel();
            }
        ],
        [
            'attribute'=>'parent_id',
            'filter'=> Yii::$app->postCategoryService->catalog(),
            'value'=>function($data) {
                return $data->getParentTitle();
            }
        ],
        [
            'attribute'=>'Версии',
            'value'=>function($data) {

                return implode(",", $data->locales());
            },
            'visible' => Yii::$app->localeService->catalogCount() > 1,
        ],
        'created_at',


        [
            'class'=>'yii\grid\ActionColumn',
            'template'=>'{childs}  {update} {activate} {deactivate} {delete}',
            'buttons'=>[
                'childs'=> function ($url, $model) {
                    return Html::a(
                        '<i class="icon-tree5"></i>' . Yii::t('yii2admin', 'Подкатегории'),
                        ['index', 'parent_id' => $model['id']],
                        [
                            'class' => 'dropdown-item',
                            'aria-label' => Yii::t('yii2admin', 'Подменю'),
                            'title' => Yii::t('yii2admin', 'Подменю'),
                            'data-pjax' => '0'
                        ]
                    );
                },
                'update'=> function ($url, $model) {
                    if ($model['is_deleted'] == IsDeletedEnum::DELETED){
                        return '';
                    }

                    return Html::a(
                        '<i class="icon-pencil6"></i>'. Yii::t('yii2admin', 'Редактировать'),
                        ['update', 'id' => $model['id'],  'parent_id' => $model['parent_id']],
                        [
                            'class' => 'dropdown-item',
                            'aria-label' => Yii::t('yii2admin', 'Редактировать'),
                            'title' => Yii::t('yii2admin', 'Редактировать'),
                            'data-pjax' => '0'
                        ]
                    );
                },
                'activate'=> function ($url, $model) {
                    if ($model['is_deleted'] == IsDeletedEnum::DELETED){
                        return '';
                    }

                    if ($model['status'] == StatusEnum::ACTIVE){
                        return '';
                    }

                    return Html::a(
                        '<i class="icon-checkmark4"></i>'. Yii::t('yii2admin', 'Активировать'),
                        ['status-change', 'id' => $model['id'], 'status' => StatusEnum::ACTIVE,  'parent_id' => $model['parent_id']],
                        [
                            'class' => 'admin-action dropdown-item',
                            'data-pjax-id' => 'list-pjax',
                            'data-pjax-url' => Url::current([], true),
                            'data-swal' => Yii::t('yii2admin' , 'Активировать'),
                        ]
                    );
                },
                'deactivate'=> function ($url, $model) {
                    if ($model['is_deleted'] == IsDeletedEnum::DELETED){
                        return '';
                    }
                    if ($model['status'] == StatusEnum::INACTIVE){
                        return '';
                    }
                    return Html::a(
                        '<i class="icon-cross2"></i>'. Yii::t('yii2admin', 'Деактивировать'),
                        ['status-change', 'id' => $model['id'], 'status' => StatusEnum::INACTIVE, 'parent_id' => $model['parent_id']],
                        [
                            'class' => 'admin-action dropdown-item',
                            'data-pjax-id' => 'list-pjax',
                            'data-pjax-url' => Url::current([], true),
                            'data-swal' => Yii::t('yii2admin' , 'Деактивировать'),
                        ]
                    );
                },
                'delete'=> function ($url, $model) {
                    if ($model['is_deleted'] == IsDeletedEnum::DELETED){
                        return '';
                    }

                    return Html::a(
                        '<i class="icon-trash"></i>'. Yii::t('yii2admin', 'Удалить'),
                        ['delete', 'id' => $model['id'], 'parent_id' => $model['parent_id']],
                        [
                            'class' => 'admin-action dropdown-item',
                            'data-pjax-id' => 'list-pjax',
                            'data-pjax-url' => Url::current([], true),
                            'data-swal' => Yii::t('yii2admin' , 'Удалить'),
                        ]
                    );
                }
            ]
        ],
    ],
]); ?>

<?php Pjax::end(); ?>
