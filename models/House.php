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
            [['title'], 'required'],
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

    // Relations

    public function getBuilding()
    {
        return $this->hasOne(Building::className(), ['id' => 'building_id']);
    }

    public function getApartments()
    {
        return $this->hasMany(NonTypicalApartment::className(), ['house_id' => 'id']);
    }
}
