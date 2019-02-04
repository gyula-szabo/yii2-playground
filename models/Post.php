<?php

namespace app\models;

use h3tech\crud\models\Media;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string $title
 * @property string $text
 * @property int $lead_image_id
 *
 * @property Media $leadImage
 */
class Post extends \yii\db\ActiveRecord
{
    public $uploadedLeadImage;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'text'], 'required'],
            [['text'], 'string'],
            [['lead_image_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['lead_image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Media::class, 'targetAttribute' => ['lead_image_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'text' => 'Text',
            'lead_image_id' => 'Lead Image ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLeadImage()
    {
        return $this->hasOne(Media::class, ['id' => 'lead_image_id']);
    }
}
