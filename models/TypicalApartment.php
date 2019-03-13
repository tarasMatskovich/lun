<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "typical_apartments".
 *
 * @property int $id
 * @property string $rooms
 * @property double $square
 * @property double $price_per_square_meter
 * @property double $price
 * @property int $building_id
 */
class TypicalApartment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'typical_apartments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rooms'], 'string'],
            [['square', 'price_per_square_meter', 'price'], 'number'],
            [['building_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rooms' => 'Rooms',
            'square' => 'Square',
            'price_per_square_meter' => 'Price Per Square Meter',
            'price' => 'Price',
            'building_id' => 'Building ID',
        ];
    }

    // Relations

    public function getBuilding()
    {
        return $this->hasOne(Building::className(), ['id' => 'building_id']);
    }
}
