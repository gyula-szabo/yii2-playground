<?php

namespace app\controllers;

use h3tech\crud\controllers\AbstractCRUDController;
use h3tech\crud\controllers\actions\SingleMediaAction;
use h3tech\crud\helpers\CrudWidget;
use yii\db\ActiveRecord;

class PostController extends AbstractCRUDController
{
    public static function formRules(ActiveRecord $model)
    {
        return [
            'title' => 'textInput',
            'text' => 'textarea',
            'lead_image_id' => ['mediaInput', [
                'modelVariable' => 'uploadedLeadImage',
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => [
                    'allowedFileExtensions' => ['jpg', 'gif', 'png'],
                ],
                'targetSize' => ['width' => 360, 'height' => 224],
            ]],
        ];
    }

    public static function viewAttributes(ActiveRecord $model)
    {
        return [
            'title', 'text', CrudWidget::mediaDisplayAttribute('lead_image_id'),
        ];
    }

    protected static function actionRules()
    {
        return [
            [
                'class' => SingleMediaAction::class,
                'type' => 'image',
                'mediaIdAttribute' => 'lead_image_id',
                'fileVariable' => 'uploadedLeadImage',
            ],
        ];
    }
}
