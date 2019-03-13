<?php

namespace app\controllers;

use app\models\Building;
use app\models\House;
use yii\web\NotFoundHttpException;

class AdminController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionList()
    {
        $buildings = Building::find()->with('houses')->all();
        return $this->render('list', ['buildings' => $buildings]);
    }

    public function actionShow($id)
    {
        $building = Building::findOne($id);
        if (!$building)
            throw new NotFoundHttpException("Такой новостройки нет");
//        echo '<pre>';
//        print_r($building);
//        echo '</pre>';
//        die;
        return $this->render('show', ['building' => $building]);
    }

    public function actionEdit($id)
    {
        return $id;
    }

    public function actionDelete($id)
    {
        return $id;
    }

    public function actionAdd()
    {
        return $this->render('add_building');
    }

    public function actionSave()
    {

    }

    public function actionUpdate()
    {

    }

    public function actionShowhouse($id)
    {
        $house = House::findOne($id);
        if (!$house)
            throw new NotFoundHttpException('Такого дома нет');

        return $this->render('show_house', ['house' => $house]);
    }

}
