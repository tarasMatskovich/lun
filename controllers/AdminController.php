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
        $buildings = Building::find()->all();
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

    public function save()
    {

    }

    public function update()
    {

    }

}
