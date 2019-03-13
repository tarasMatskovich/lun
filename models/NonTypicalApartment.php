<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "non_typical_apartments".
 *
 * @property int $id
 * @property string $rooms
 * @property double $square
 * @property double $price_per_square_meter
 * @property double $price
 * @property int $house_id
 */
class NonTypicalApartment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'non_typical_apartments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rooms'], 'string'],
            [['square', 'price_per_square_meter', 'price'], 'number'],
            [['house_id'], 'integer'],
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
            'house_id' => 'House ID',
        ];
    }

    // Relations

    public function getHouse()
    {
        return $this->hasOne(House::className(), ['id' => 'house_id']);
    }
}
