<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use concepture\yii2handbook\converters\LocaleConverter;
use kamaelkz\yii2admin\v1\widgets\formelements\Pjax;
use yii\helpers\Url;
use kamaelkz\yii2admin\v1\themes\components\view\BreadcrumbsHelper;

$this->setTitle(Yii::t('yii2admin', 'Просмотр'));

$breadcrumbs = BreadcrumbsHelper::getClosurePath($model, "title", "parent_id", $this->getTitle());
foreach ($breadcrumbs as $breadcrumb){
    $this->pushBreadcrumbs($breadcrumb);
}

$this->viewHelper()->pushPageHeader();
$this->viewHelper()->pushPageHeader(['update' ,'id' => $model->id], Yii::t('yii2admin','Редактирование'), 'icon-pencil6');
$this->viewHelper()->pushPageHeader(['index'], $model::label(),'icon-list');
?>

<?php Pjax::begin();?>

<?php if (count($model->locales()) > 1): ?>
    <ul class="nav nav-tabs nav-tabs-solid nav-justified bg-light">
        <?php foreach ($model->locales() as $key => $locale):?>
            <li class="nav-item">
                <?= Html::a(
                    $locale,
                    \yii\helpers\Url::current(['locale' => $key]),
                    ['class' => 'nav-link ' . ($key ==  $model->locale   ? "active" : "")]
                ) ?>
            </li>
        <?php endforeach;?>
    </ul>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-lg-9 col-md-8 col-sm-12">
                <h5 class="card-title">
                    <?= $model->toString();?>
                </h5>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-12 text-right">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary btn-labeled btn-labeled-left dropdown-toggle" data-toggle="dropdown">
                        <b>
                            <i class="icon-cog5"></i>
                        </b>
                        <?= Yii::t('yii2admin', 'Операции');?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <?= Html::a(
                            '<i class="icon-bin2"></i>' . Yii::t('yii2admin', 'Удалить'),
                            ['delete', 'id' => $model->id],
                            [
                                'class' => 'admin-action dropdown-item',
                                'data-pjax-id' => 'list-pjax',
                                'data-pjax-url' => Url::current([], true),
                                'data-swal' => Yii::t('yii2admin' , 'Удалить'),
                            ]
                        );?>
                        <div class="dropdown-divider"></div>
                        <?= Html::a(
                            '<i class="icon-pencil6"></i>' . Yii::t('yii2admin', 'Редактирование'),
                            ['update', 'id' => $model->id],
                            [
                                'class' => 'dropdown-item',
                                'data-pjax' => '0',
                            ]
                        );?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'title',
                [
                    'attribute'=>'Версии',
                    'value'=>function($model) {

                        return implode(",", $model->locales());
                    },
                    'visible' => Yii::$app->localeService->catalogCount() > 1,
                ],
                'seo_name',
                'seo_h1',
                'seo_title',
                'seo_description',
                'seo_keywords',
                [
                    'attribute'=>'status',
                    'value'=>$model->statusLabel(),
                ],
                'created_at',
                'updated_at',
                [
                    'attribute'=>'is_deleted',
                    'value'=>function($data) {
                        return $data->isDeletedLabel();
                    }
                ],
            ],
        ]) ?>
    </div>
</div>
<?php Pjax::end(); ?>

