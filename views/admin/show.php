<?php

?>

<a href="<?=\yii\helpers\Url::to(['admin/list'])?>" class="btn btn-primary back-btn">Вернуться назад к списку</a>

<?php if( Yii::$app->session->hasFlash('success') ): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('success'); ?>
    </div>
<?php endif;?>

<?php if( Yii::$app->session->hasFlash('error') ): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('error'); ?>
    </div>
<?php endif;?>

<h1 class="title">Новостройка: <a href="<?=\yii\helpers\Url::to(['admin/show', 'id' => $building->id])?>">"<?=$building->title?>"</a></h1>

<h4>
    Список домов в даной новостройке:
</h4>

<?php if (count($building->houses)):?>
<table class="table houses-list">
    <thead>
    <tr>
        <th scope="col">Название</th>
        <th scope="col">Действия</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($building->houses as $house):?>
        <tr>
            <td>
                <a href="<?=\yii\helpers\Url::to(['admin/showhouse', 'id' => $house->id])?>"><?=$house->title?></a>
            </td>
            <td class="actions">
                <a href="<?=\yii\helpers\Url::to(['admin/showhouse', 'id' => $house->id])?>">
                    <i class="fas fa-eye"></i>
                </a>
                &nbsp;&nbsp;
                <a href="<?=\yii\helpers\Url::to(['admin/edithouse', 'id' => $house->id])?>">
                    <i class="fas fa-edit"></i>
                </a>
                &nbsp;&nbsp;
                <a href="<?=\yii\helpers\Url::to(['admin/deletehouse', 'id' => $house->id])?>">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
<?php else: ?>
    <p>В даной новостройке пока нет домов</p>
<?php endif; ?>

<button class="btn btn-primary" v-if="!showAddHouseForm" @click="onAddHouseFormClick">Добавить дом</button>

<div class="add-house-form-click" v-else>
    <div class="form-group">
        <p>Добавление дома</p>
    </div>
    <div class="form-group">
        <label for="house">Название дома:</label>
        <input type="text" class="form-control" placeholder="Название" v-model="houseTitle">
    </div>
    <div class="form-group">
        <button type="button" class="btn btn-success" @click="addHouseFormSubmit">Добавить дом</button>
        <button type="button" class="btn btn-secondary" @click="showAddHouseForm = false">Отменить</button>
    </div>
</div>



<h4>
    Список типовых квартир даной новостройки:
</h4>

<?php if (count($building->apartments)):?>
<table class="table typical-apartments-list">
    <thead>
    <tr>
        <th scope="col">Количество комнат</th>
        <th scope="col">Площадь</th>
        <th scope="col">Цена за 1м квадратный</th>
        <th scope="col">Цена за всю квартиру</th>
        <th scope="col">Действия</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($building->apartments as $apartment):?>
        <tr>
            <td>
                <?=$apartment->rooms?>
            </td>
            <td>
                <?=$apartment->square?>
            </td>
            <td>
                <?=$apartment->price_per_square_meter ? $apartment->price_per_square_meter : "-"?>
            </td>
            <td>
                <?=$apartment->price ? $apartment->price : "-"?>
            </td>
            <td class="actions">
                <a href="<?=\yii\helpers\Url::to(['admin/typicalshowapartment', 'id' => $apartment->id])?>">
                    <i class="fas fa-eye"></i>
                </a>
                &nbsp;&nbsp;
                <a href="<?=\yii\helpers\Url::to(['admin/typicaleditapartment', 'id' => $apartment->id])?>">
                    <i class="fas fa-edit"></i>
                </a>
                &nbsp;&nbsp;
                <a href="<?=\yii\helpers\Url::to(['admin/typicaldelete', 'id' => $apartment->id])?>">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
<?php else: ?>
<p>В даной новостройке пока нет типовых квартир</p>
<?php endif; ?>


<h4>Список не типовых квартир даной новостройки:</h4>

<?php if (count($nonTypicalApartments)):?>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Количество комнат</th>
            <th scope="col">Площадь</th>
            <th scope="col">Цена за 1м квадратный</th>
            <th scope="col">Цена за всю квартиру</th>
            <th scope="col">Дом</th>
            <th scope="col">Действия</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($nonTypicalApartments as $apartment):?>
        <tr>
            <td>
                <?=$apartment->rooms?>
            </td>
            <td>
                <?=$apartment->square?>
            </td>
            <td>
                <?=$apartment->price_per_square_meter ? $apartment->price_per_square_meter : "-"?>
            </td>
            <td>
                <?=$apartment->price ? $apartment->price : "-"?>
            </td>
            <td>
                <?=$apartment->house->title?>
            </td>
            <td class="actions">
                <a href="<?=\yii\helpers\Url::to(['admin/nontypicalshowapartment', 'id' => $apartment->id])?>">
                    <i class="fas fa-eye"></i>
                </a>
                &nbsp;&nbsp;
                <a href="<?=\yii\helpers\Url::to(['admin/nontypicaleditapartment', 'id' => $apartment->id])?>">
                    <i class="fas fa-edit"></i>
                </a>
                &nbsp;&nbsp;
                <a href="<?=\yii\helpers\Url::to(['admin/nontypicaldelete', 'id' => $apartment->id])?>">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
<?php else: ?>
    <p>В даной новостройке пока нет  не типовых квартир</p>
<?php endif; ?>

<button class="btn btn-primary" v-if="!showAddApartmentForm" @click="onAddApartmentFormClick">Добавить квартиру</button>

<div class="add-house-form-click" v-else>
    <div class="card">
        <div class="card-header">
            Добавление квартиры
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="">Тип квартиры (чтобы выбрать не типовую квартиру - сперва добавтье в новостройку хотя бы один дом):</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="typical" id="typical" :value="true" v-model="apartment.typical">
                    <label class="form-check-label" for="typical">Типовая</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="typical" id="non-typical" <?php if(!count($building->houses)):?>disabled<?php endif;?> :value="false" v-model="apartment.typical">
                    <label class="form-check-label" for="non-typical">Не типовая</label>
                </div>
            </div>
            <div class="form-group" v-if="!typical">
                <label for="non-t-house">Дом для нетиповой квартиры:</label>
                <select name="" id="non-t-house" class="form-control" v-model="apartment.house_id">
                    <?php foreach ($building->houses as $k => $house): ?>
                        <option <?php if ($k == 0):?>selected<?php endif;?> value="<?=$house->id?>"><?=$house->title?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="form-group">
                <label for="rooms-count">Количество комнат:</label>
                <select name="" id="rooms-count" class="form-control" v-model="apartment.rooms">
                    <option value="студия">Студия</option>
                    <option value="1к">1к</option>
                    <option value="2к">2к</option>
                    <option value="3к">3к</option>
                    <option value="4к">4к</option>
                    <option value="5к">5к</option>
                    <option value="5к двухуровневая">5к двухуровневая</option>
                    <option value="6к двухуровневая">6к двухуровневая</option>
                </select>
            </div>
            <div class="form-group">
                <label for="square">Общая площадь:</label>
                <input type="number" id="square" class="form-control" placeholder="Площадь" v-model="apartment.square">
            </div>
            <div class="form-group">
                <label for="price">Цена:</label>
                <input type="number" class="form-control" v-model="apartment.price" placeholder="Цена">
            </div>
            <div class="form-group">
                <label for="">Цена указана:</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="priceType" id="per" :value="false" v-model="apartment.fullPrice">
                    <label class="form-check-label" for="per">За 1 квадратный метр</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="priceType" id="full" :value="true" v-model="apartment.fullPrice">
                    <label class="form-check-label" for="full">За всю квартиру</label>
                </div>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-success" @click="addApartmentFormSubmit">Добавить квартиру</button>
                <button type="button" class="btn btn-secondary" @click="showAddApartmentForm = false">Отменить</button>
            </div>
        </div>
    </div>
</div>
<input type="hidden" value="<?=$building->id?>" id="building-id">
