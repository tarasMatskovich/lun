<?php

namespace app\controllers;

use app\models\Building;
use app\models\House;
use app\models\NonTypicalApartment;
use app\models\TypicalApartment;
use yii\web\NotFoundHttpException;
use Yii;

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
        $building = new Building();
        $data = Yii::$app->request->post();
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (!isset($data['building']['title']) || !isset($data['building']['city'])) {
            Yii::$app->session->setFlash('error', 'Поля название и город обезательны');
            return ['error' => true];
        } else {
            $building->title = $data['building']['title'];
            $building->city = $data['building']['city'];
            if ($building->save()) {
                $this->saveBuildingHouses($data, $building->id);
            }
            Yii::$app->session->setFlash('success', 'Новостройка была успешно создана');
            return ['error' => false];
        }
    }

    protected function saveBuildingHouses($data, $building_id)
    {
        $localHouses = [];
        if (isset($data['houses'])) {
            $houses = $data['houses'];
            foreach ($houses as $house) {
                $houseModel = new House();
                $houseModel->title = $house['title'];
                $houseModel->building_id = $building_id;
                $houseModel->save(false);
                $localHouses[$house['id']] = $houseModel->id;
            }
        }
        if (isset($data['apartments'])) {
            $apartments = $data['apartments'];
            foreach ($apartments as $apartment) {
                if ($apartment['typical'] === 'true') {
                    $apartmentModel = new TypicalApartment();
                    $apartmentModel->rooms = $apartment['rooms'];
                    $apartmentModel->square = $apartment['square'];
                    if ($apartment['fullPrice']) {
                        $apartmentModel->price = $apartment['price'];
                        $apartmentModel->price_per_square_meter = null;
                    } else {
                        $apartmentModel->price = null;
                        $apartmentModel->price_per_square_meter = $apartment['price'];
                    }
                    $apartmentModel->building_id = $building_id;
                    $apartmentModel->save();
                } else {
                    if (isset($localHouses[$apartment['house_id']])) {
                        $apartmentModel = new NonTypicalApartment();
                        $apartmentModel->rooms = $apartment['rooms'];
                        $apartmentModel->square = $apartment['square'];
                        if ($apartment['fullPrice']) {
                            $apartmentModel->price = $apartment['price'];
                            $apartmentModel->price_per_square_meter = null;
                        } else {
                            $apartmentModel->price = null;
                            $apartmentModel->price_per_square_meter = $apartment['price'];
                        }
                        $apartmentModel->house_id = $localHouses[$apartment['house_id']];
                        $apartmentModel->save();
                    }
                }

            }
        }

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
