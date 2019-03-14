<?php

use yii\helpers\Url;
?>

<h1 class="title">Новостройка: <a href="<?=Url::to(['admin/show', 'id' => $house->building->id])?>">"<?=$house->building->title?>"</a></h1>
<h1>Название дома: <a href="<?=Url::to(['admin/showhouse', 'id' => $house->id])?>">"<?=$house->title?>"</a></h1>

<h4>
    Список не типовых квартир в даном доме:
</h4>

<?php if (count($house->apartments)):?>
<table class="table non-typical-apartments-list">
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
    <?php foreach ($house->apartments as $apartment):?>
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
<?php else:?>
<p>В даном доме пока нет не типовых квартир</p>
<?php endif;?>
