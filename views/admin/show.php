<?php

?>

<a href="<?=\yii\helpers\Url::to(['admin/list'])?>" class="btn btn-primary back-btn">Вернуться назад к списку</a>

<?php if( Yii::$app->session->hasFlash('success') ): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('success'); ?>
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