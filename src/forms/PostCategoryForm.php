<?php
namespace concepture\yii2article\forms;


use concepture\yii2logic\forms\Form;
use concepture\yii2logic\enum\StatusEnum;
use concepture\yii2logic\traits\SeoPropertyTrait;
use Yii;

/**
 * Class PostCategoryForm
 * @package concepture\yii2article\forms
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class PostCategoryForm extends Form
{
    use SeoPropertyTrait;

    public $user_id;
    public $parent_id;
    public $locale_id;
    public $image;
    public $image_anons;
    public $title;
    public $anons;
    public $content;
    public $status = StatusEnum::INACTIVE;

    /**
     * @see Form::formRules()
     */
    public function formRules()
    {
        return [
            [
                [
                    'title',
                ],
                'required'
            ],
        ];
    }
}
