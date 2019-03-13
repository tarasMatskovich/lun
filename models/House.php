<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "houses".
 *
 * @property int $id
 * @property string $title
 * @property int $building_id
 */
class House extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'houses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['building_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
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
            'building_id' => 'Building ID',
        ];
    }
}
