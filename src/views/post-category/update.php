<?php
use kamaelkz\yii2admin\v1\themes\components\view\BreadcrumbsHelper;

$this->setTitle(Yii::t('yii2admin', 'Редактирование'));

$breadcrumbs = BreadcrumbsHelper::getClosurePath($model, "title", "parent_id", $this->getTitle());
foreach ($breadcrumbs as $breadcrumb){
    $this->pushBreadcrumbs($breadcrumb);
}

$this->viewHelper()->pushPageHeader();
$this->viewHelper()->pushPageHeader(['view', 'id' => $originModel->id], Yii::t('yii2admin', 'Просмотр'),'icon-file-eye2');
$this->viewHelper()->pushPageHeader(['index'], $model::label(),'icon-list');
?>

<?= $this->render('_form', [
    'model' => $model,
    'originModel' => $originModel,
]) ?>
