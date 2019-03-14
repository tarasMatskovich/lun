<?php

?>

<div id="add-building">
    <h1 class="title">Создание новой новостройки</h1>

    <?php if( Yii::$app->session->hasFlash('error') ): ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo Yii::$app->session->getFlash('error'); ?>
        </div>
    <?php endif;?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="name">Название новостройки: </label>
            <input type="text" class="form-control" id="name" placeholder="Название" v-model="buildingTitle">
        </div>
        <div class="form-group">
            <label for="city">Город новостройки: </label>
            <input type="text" class="form-control" id="city" placeholder="Город" v-model="buildingCity">
        </div>
        <div class="form-group">
            <label for="list">Список домов в новостройке:</label>
            <ul class="list-group">
                <li class="list-group-item" v-for="house in houses">{{house.title}} &nbsp;&nbsp;<a href="" class="delete-house-icon" @click.prevent="onHouseDelete(house.id)"><i class="fas fa-times"></i></a></li>
            </ul>
            <input type="text" id="list" class="form-control" placeholder="Название дома" v-model="houseTitle">
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-primary" @click="onHouseAdd">Добавить дом</button>
        </div>
        <div class="form-group">
            <label for="">Список квартир в новостройке:</label>
            <table class="table" v-if="apartments.length > 0">
                <thead>
                    <tr>
                        <th scope="col">Количество комнат</th>
                        <th scope="col">Площадь</th>
                        <th scope="col">Цена за 1м квадратный</th>
                        <th scope="col">Цена за всю квартиру</th>
                        <th scope="col">Типовая</th>
                        <th scope="col">Дом</th>
                        <th scope="col">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="apartment in apartments">
                        <td>{{apartment.rooms}}</td>
                        <td>{{apartment.square}}</td>
                        <td>{{apartment.fullPrice ? "-" : apartment.price}}</td>
                        <td>{{apartment.fullPrice ? apartment.price : "-"}}</td>
                        <td>{{apartment.typical ? "Да" : "Нет"}}</td>
                        <td>{{apartment.typical ? "Все" : getHouse(apartment)}}</td>
                        <td>
                            <a href="#" class="delete-house-icon" @click.prevent="onApartmentDelete(apartment.id)">
                                <i class="fas fa-times"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>


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
                            <input class="form-check-input" type="radio" name="typical" id="non-typical" :disabled="houses.length <= 0" :value="false" v-model="apartment.typical">
                            <label class="form-check-label" for="non-typical">Не типовая</label>
                        </div>
                    </div>
                    <div class="form-group" v-if="!typical">
                        <label for="non-t-house">Дом для нетиповой квартиры:</label>
                        <select name="" id="non-t-house" class="form-control" v-model="apartment.house_id">
                            <option :value="house.id" v-for="house in houses">{{house.title}}</option>
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
                        <label for="square">Общая площадь (квадратные метры):</label>
                        <input type="number" id="square" class="form-control" placeholder="Площадь" v-model="apartment.square">
                    </div>
                    <div class="form-group">
                        <label for="price">Цена (грн):</label>
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
                </div>
            </div>
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-primary" @click="onApartmentAdd">Добавить квартиру</button>
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-success" @click="onBuildingSave">Создать новостройку</button>
        </div>
    </form>
</div>


