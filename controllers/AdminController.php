<?php

namespace app\controllers;

use app\models\Building;
use app\models\House;
use app\models\NonTypicalApartment;
use app\models\TypicalApartment;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use Yii;

class AdminController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'update' => ['post'],
                    'updatehouse' => ['post'],
                    'nontypicalupdateapartment' => ['post'],
                    'typicalupdateapartment' => ['post'],
                ]
            ]
        ];
    }

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
        $nonTypicalAppartments = [];
        foreach ($building->houses as $house) {
            foreach ($house->apartments as $apartment) {
                $nonTypicalAppartments[] = $apartment;
            }
        }
        return $this->render('show', ['building' => $building, 'nonTypicalApartments' => $nonTypicalAppartments]);
    }

    public function actionDeletehouse($id)
    {
        $house = House::findOne($id);
        $building_id = $house->building_id;
        if (!$house)
            throw new NotFoundHttpException('Такого дома нет');
        // удаляем все не типичные дома в этом доме
        foreach ($house->apartments as $apartment) {
            $apartment->delete();
        }
        if ($house->delete()) {
            Yii::$app->session->setFlash('success', 'Дом был успешно удален');
        } else {
            Yii::$app->session->setFlash('success', 'При удалении дома произошла ошибка');
        }
        $this->redirect(Url::to(['admin/show', 'id' => $building_id]));
    }

    public function actionTypicaldelete($id) {
        $apartment = TypicalApartment::findOne($id);
        if (!$apartment)
            throw new NotFoundHttpException('Такой квартиры нет');
        $building_id = $apartment->building_id;
        if ($apartment->delete()) {
            Yii::$app->session->setFlash('success', 'Квартира была успешно удалена');
        } else {
            Yii::$app->session->setFlash('success', 'При удалении квартиры произошла ошибка');
        }
        $this->redirect(Url::to(['admin/show', 'id' => $building_id]));
    }

    public function actionNontypicaldelete($id) {
        $apartment = NonTypicalApartment::findOne($id);
        if (!$apartment)
            throw new NotFoundHttpException('Такой квартиры нет');
        $building_id = $apartment->house->building_id;
        if ($apartment->delete()) {
            Yii::$app->session->setFlash('success', 'Квартира была успешно удалена');
        } else {
            Yii::$app->session->setFlash('success', 'При удалении квартиры произошла ошибка');
        }
        $this->redirect(Url::to(['admin/show', 'id' => $building_id]));
    }

    public function actionDelete($id)
    {
        $building = Building::findOne($id);
        if (!$building)
            throw new NotFoundHttpException('Такой новостройки нет');
        // удаляем все типичные квартиры в новостройке
        foreach ($building->apartments as $apartment) {
            $apartment->delete();
        }
        // удаляем все дома в новостройке и все не типичные квартиры в даной новостройке
        foreach ($building->houses as $house) {
            foreach ($house->apartments as $apartment) {
                $apartment->delete();
            }
            $house->delete();
        }
        // удаляем саму новостройку
        if ($building->delete()) {
            Yii::$app->session->setFlash('success', 'Новостройка была успешно удалена');
        } else {
            Yii::$app->session->setFlash('success', 'При удалении новостройки произошла ошибка');
        }
        $this->redirect(Url::to(['admin/list']));

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

    public function actionEdit($id)
    {
        $building = Building::findOne($id);
        if (!$building)
            throw new NotFoundHttpException('Такой новостройки нет');
        return $this->render('building_edit', ['building' => $building]);
    }

    public function actionUpdate($id)
    {
        $building = Building::findOne($id);
        if (!$building)
            throw new NotFoundHttpException('Такой новостройки нет');
        $data = Yii::$app->request->post();
        $building->title = $data['title'];
        $building->city = $data['city'];
        if ($building->save()) {
            Yii::$app->session->setFlash('success', 'Новостройка была успешно сохранена');
            return $this->redirect(Url::to(['admin/list']));
        } else {
            Yii::$app->session->setFlash('error', 'При сохранении новостройки произошла ошибка: проверьте правильность заполнения полей');
            return $this->redirect(Url::to(['admin/edit', 'id' => $id]));
        }
    }

    public function actionShowhouse($id)
    {
        $house = House::findOne($id);
        if (!$house)
            throw new NotFoundHttpException('Такого дома нет');

        return $this->render('show_house', ['house' => $house]);
    }

    public function actionEdithouse($id)
    {
        $house = House::findOne($id);
        if (!$house)
            throw new NotFoundHttpException('Такого дома нет');
        return $this->render('edit_house', ['house' => $house]);
    }

    public function actionUpdatehouse($id)
    {
        $house = House::findOne($id);
        $building_id = $house->building_id;
        if (!$house)
            throw new NotFoundHttpException('Такого дома нет');
        $data = Yii::$app->request->post();
        $house->title = $data['title'];
        if ($house->save()) {
            Yii::$app->session->setFlash('success', 'Дом был успешно сохранен');
            return $this->redirect(Url::to(['admin/show', 'id' => $building_id]));
        } else {
            Yii::$app->session->setFlash('error', 'При сохранении дома произошла ошибка: проверьте правильность заполнения полей');
            return $this->redirect(Url::to(['admin/edithouse', 'id' => $id]));
        }
    }

    public function actionNontypicalshowapartment($id)
    {
        $apartment = NonTypicalApartment::findOne($id);
        if (!$apartment)
            throw new NotFoundHttpException('Такой квартиры нет');
        return $this->render("non_typical_show", ['apartment' => $apartment]);
    }

    public function actionTypicalshowapartment($id)
    {
        $apartment = TypicalApartment::findOne($id);
        if (!$apartment)
            throw new NotFoundHttpException('Такой квартиры нет');
        return $this->render("typical_show", ['apartment' => $apartment]);
    }

    public function actionNontypicaleditapartment($id)
    {
        $apartment = NonTypicalApartment::findOne($id);
        if (!$apartment)
            throw new NotFoundHttpException('Такой квартиры нет');
        return $this->render("non_typical_edit", ['apartment' => $apartment]);
    }

    public function actionTypicaleditapartment($id)
    {
        $apartment = TypicalApartment::findOne($id);
        if (!$apartment)
            throw new NotFoundHttpException('Такой квартиры нет');
        return $this->render("typical_edit", ['apartment' => $apartment]);
    }

    public function actionNontypicalupdateapartment($id)
    {
        $apartment = NonTypicalApartment::findOne($id);
        if (!$apartment)
            throw new NotFoundHttpException('Такой квартиры нет');
        $data = Yii::$app->request->post();
        $apartment->rooms = $data['rooms'];
        $apartment->square = $data['square'];
        if ($data['fullPrice'] == 'true') {
            $apartment->price = $data['price'];
        } else {
            $apartment->price_per_square_meter = $data['price'];
        }
        $apartment->house_id = $data['house_id'];
        if ($apartment->save()) {
            Yii::$app->session->setFlash('success', 'Квартира успешно сохранилась');
            return $this->redirect(Url::to(['admin/show', 'id' => $apartment->house->building_id]));
        } else {
            Yii::$app->session->setFlash('error', 'При сохранении квартиры произошла ошибка: проверьте правильность заполнения данных');
            return $this->redirect(Url::to(['admin/nontypicaleditapartment', 'id' => $id]));
        }
    }

    public function actionTypicalupdateapartment($id)
    {
        $apartment = TypicalApartment::findOne($id);
        if (!$apartment)
            throw new NotFoundHttpException('Такой квартиры нет');
        $data = Yii::$app->request->post();
        $apartment->rooms = $data['rooms'];
        $apartment->square = $data['square'];
        if ($data['fullPrice'] == 'true') {
            $apartment->price = $data['price'];
        } else {
            $apartment->price_per_square_meter = $data['price'];
        }
        if ($apartment->save()) {
            Yii::$app->session->setFlash('success', 'Квартира успешно сохранилась');
            return $this->redirect(Url::to(['admin/show', 'id' => $apartment->building_id]));
        } else {
            Yii::$app->session->setFlash('error', 'При сохранении квартиры произошла ошибка: проверьте правильность заполнения данных');
            return $this->redirect(Url::to(['admin/typicaleditapartment', 'id' => $id]));
        }
    }

    public function actionSaveapartment()
    {
        $data = Yii::$app->request->post();
        $apartment = $data['apartment'];
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $result = false;
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
            $apartmentModel->building_id = $data['building_id'];
            $result = $apartmentModel->save();
        } else {
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
            $apartmentModel->house_id = $apartment['house_id'];
            $result = $apartmentModel->save();
        }
        if ($result) {
            Yii::$app->session->setFlash('success', 'Квартира была успешно добавлена');
        } else {
            Yii::$app->session->setFlash('error', 'При сохранении квартиры произошла ошибка');
        }
        return ['result' => $result];
    }

    public function actionSavehouse()
    {
        $data = Yii::$app->request->post();
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $house = new House();
        $house->title = $data['title'];
        $house->building_id = $data['building_id'];
        $result = $house->save();
        if ($result) {
            Yii::$app->session->setFlash('success', 'Дом был успешно добавлен');
        } else {
            Yii::$app->session->setFlash('error', 'При сохранении дома произошла ошибка');
        }
        return ['result' => $result];
    }

}
