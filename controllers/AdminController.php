<?php

namespace app\controllers;

use app\models\Building;

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
        return $id;
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
        return 123;
    }

    public function actionSave()
    {

    }

    public function actionUpdate()
    {

    }

}
