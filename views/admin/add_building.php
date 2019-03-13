<?php

?>

<div id="add-building">
    <h1 class="title">Создание новой новостройки</h1>

    <form action="" method="POST">
        <div class="form-group">
            <label for="name">Название новостройки: </label>
            <input type="text" class="form-control" id="name" placeholder="Название">
        </div>
        <div class="form-group">
            <label for="city">Город новостройки: </label>
            <input type="text" class="form-control" id="city" placeholder="Город">
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
                        <select name="" id="non-t-house" class="form-control">
                            <option value="" v-for="house in houses">{{house.title}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="rooms-count">Количество комнат:</label>
                        <select name="" id="rooms-count" class="form-control">
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
                        <label for="price">Цена:</label>
                        <input type="number" class="form-control" v-model="apartment.price">
                    </div>
                    <div class="form-group">
                        <label for="">Цена указана:</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="priceType" id="per" :value="true" v-model="apartment.fullPrice">
                            <label class="form-check-label" for="per">За 1 квадратный метр</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="priceType" id="full" :value="false" v-model="apartment.fullPrice">
                            <label class="form-check-label" for="full">За всю квартиру</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-primary">Добавить квартиру</button>
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-success">Создать новостройку</button>
        </div>
    </form>
</div>


