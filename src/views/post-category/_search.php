<?php

use common\enum\MenuEnum;
use concepture\yii2logic\enum\StatusEnum;
use concepture\yii2logic\enum\IsDeletedEnum;
?>
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-12">
        <?= $form->field($model,'id')->textInput();?>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12">
        <?= $form->field($model,'title')->textInput();?>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12">
        <?= $form->field($model,'seo_name')->textInput();?>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12">
        <?= $form
            ->field($model, 'parent_id')
            ->dropDownList(Yii::$app->postCategoryService->catalog(), [
                'class' => 'form-control custom-select',
                'prompt' => ''
            ]);
        ?>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12">
        <?= $form
            ->field($model, 'status')
            ->dropDownList(StatusEnum::arrayList(), [
                'class' => 'form-control custom-select',
                'prompt' => ''
            ]);
        ?>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12">
        <?= $form
            ->field($model, 'is_deleted')
            ->dropDownList(IsDeletedEnum::arrayList(), [
                'class' => 'form-control custom-select',
                'prompt' => ''
            ]);
        ?>
    </div>
</div>