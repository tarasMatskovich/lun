<?php

?>

<a href="<?=\yii\helpers\Url::to(['admin/list'])?>" class="btn btn-primary">Вернуться назад к списку</a>

<h1 class="title">Новостройка: <a href="<?=\yii\helpers\Url::to(['admin/show', 'id' => $building->id])?>">"<?=$building->title?>"</a></h1>

<h4>
    Список домов в даной новостройке:
</h4>

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
                <a href="<?=\yii\helpers\Url::to(['admin/edit', 'id' => $house->id])?>">
                    <i class="fas fa-edit"></i>
                </a>
                &nbsp;&nbsp;
                <a href="<?=\yii\helpers\Url::to(['admin/delete', 'id' => $house->id])?>">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>

<h4>
    Список типовых квартир даной новостройки:
</h4>

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
                <a href="">
                    <i class="fas fa-eye"></i>
                </a>
                &nbsp;&nbsp;
                <a href="">
                    <i class="fas fa-edit"></i>
                </a>
                &nbsp;&nbsp;
                <a href="">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>