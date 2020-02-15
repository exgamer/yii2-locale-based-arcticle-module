<?php

use yii\db\Migration;
use concepture\yii2logic\enum\StatusEnum;
use concepture\yii2handbook\forms\EntityTypeForm;

/**
 * Class m200127_045625_create_nonexistent_entity_types
 */
class m200124_105033_create_nonexistent_entity_types extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $item = Yii::$app->entityTypeService->getOneByCondition(['table_name' => 'post']);
        if (!$item) {
            $form = new EntityTypeForm();
            $form->table_name = 'post';
            $form->caption = 'Посты';
            $form->status = StatusEnum::ACTIVE;
            $form->sort_module = 1;
            $item = Yii::$app->entityTypeService->create($form);
        }
        $item = Yii::$app->entityTypeService->getOneByCondition(['table_name' => 'post_category']);
        if (!$item) {
            $form = new EntityTypeForm();
            $form->table_name = 'post_category';
            $form->caption = 'Категории';
            $form->status = StatusEnum::ACTIVE;
            $form->sort_module = 1;
            $item = Yii::$app->entityTypeService->create($form);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200127_045625_create_nonexistent_entity_types cannot be reverted.\n";

        return false;
    }

    /**
     * @return array
     */
    private function getTables(): array
    {
        return [
            'bookmaker' => [
                'caption' => 'Букмекеры',
            ],
            'forecast' => [
                'caption' => 'Прогнозы',
            ],
            'match' => [
                'caption' => 'Матчи',
            ],
            'post' => [
                'caption' => 'Посты',
            ],
        ];
    }
}
