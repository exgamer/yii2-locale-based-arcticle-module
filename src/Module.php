<?php
namespace concepture\yii2article;

use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'concepture\yii2article\web\controllers';

    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['yii2article'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'ru-RU',
            'basePath' => '@vendor/concepture/yii2article/messages',
        ];

    }
}