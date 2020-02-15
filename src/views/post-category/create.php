<?php
use kamaelkz\yii2admin\v1\themes\components\view\BreadcrumbsHelper;

$this->setTitle(Yii::t('yii2admin', 'Новая запись'));

$breadcrumbs = BreadcrumbsHelper::getClosurePath($model, "title", "parent_id", $this->getTitle());
foreach ($breadcrumbs as $breadcrumb){
    $this->pushBreadcrumbs($breadcrumb);
}

$this->viewHelper()->pushPageHeader(['index'], $model::label(),'icon-list');
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
