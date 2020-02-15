# concepture-yii2article-module

    
Подключение

"require": {
    "concepture/yii2-article" : "*"
},
    

Миграции
 php yii migrate/up --migrationPath=@concepture/yii2article/console/migrations
 
Подключение модуля для админки

     'modules' => [
         'article' => [
             'class' => 'concepture\yii2article\Module'
         ],
     ],
     
Для переопределния контроллера добавялем в настройки модуля

     'modules' => [
         'article' => [
            'class' => 'concepture\yii2article\Module',
            'controllerMap' => [
                'post' => 'backend\controllers\PostController'
            ],
         ],
     ],

            
Для переопределния папки с представленяими добавялем в настройки модуля

     'modules' => [
         'article' => [
             'class' => 'concepture\yii2article\Module',
             'viewPath' => '@backend/views'
         ],
     ],
     
Для переопределния любого класса можно вооспользоваться инекцией зависимостей через config.php
К примеру подменить модель StaticBlock на свой

    <?php
    return [
        'container' => [
            'definitions' => [
                'concepture\yii2article\models\StaticBlock' => ['class' => 'backend\models\StaticBlock'],
            ],
        ],
    ]