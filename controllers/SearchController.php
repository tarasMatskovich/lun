<?php

namespace app\controllers;

use app\models\Building;
use Yii;
use yii\helpers\Url;

class SearchController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSearch()
    {
        $data = Yii::$app->request->get();
        if ($data['city'] == '') {
            Yii::$app->session->setFlash('error', 'Введите город');
            return $this->redirect(Url::to(['search/index']));
        }

        // ищем все новостройки в даном городе
        $buildings = Building::find()->where(['like', "city", $data['city']])->all();
        $typicalApartments = [];
        $nonTypicalApartments = [];
        foreach ($buildings as $building) {
            foreach ($building->apartments as $apartment) {
                if ($apartment->rooms == $data['rooms']) {
                    $typicalApartments[] = $apartment;
                }
            }
            foreach ($building->houses as $house) {
                foreach ($house->apartments as $apartment) {
                    if ($apartment->rooms == $data['rooms']) {
                        $nonTypicalApartments[] = $apartment;
                    }
                }
            }
        }
        $apartments = array_merge($nonTypicalApartments,$typicalApartments);

        return $this->render('search_result', ['apartments' => $apartments, 'data' => $data]);
    }

}
