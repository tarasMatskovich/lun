<?php

namespace app\models;

use Yii;
use app\models\House;

/**
 * This is the model class for table "buildings".
 *
 * @property int $id
 * @property string $title
 * @property string $city
 */
class Building extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'buildings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'city'], 'string', 'max' => 255],
            [['title', 'city'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'city' => 'Город',
        ];
    }

    // Relations
    public function getHouses()
    {
        return $this->hasMany(House::className(), ['building_id' => 'id']);
    }

    public function getApartments()
    {
        return $this->hasMany(TypicalApartment::className(), ['building_id' => 'id']);
    }
}
