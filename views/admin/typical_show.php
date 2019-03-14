<?php
use yii\helpers\Url;
?>

<a href="<?=Url::to(['admin/show', 'id' => $apartment->building->id])?>" class="btn btn-primary">Вернуться назад</a>

<h1>Информация про квартиру</h1>

<p>Новостройка: <a href="<?=Url::to(['admin/show', 'id' => $apartment->building->id])?>"><strong><?=$apartment->building->title?></strong></a></p>
<p>Тип квартиры: <strong>типовая</strong></p>
<p>Количество комнат: <strong><?=$apartment->rooms?></strong></p>
<p>Общая площа (метров квадратных): <strong><?=$apartment->square?></strong></p>
<p>Цена за квадратный метр (грн): <strong><?=$apartment->price_per_square_meter ? $apartment->price_per_square_meter : "-"?></strong></p>
<p>Цена за всю квартиру (грн): <strong><?=$apartment->price ? $apartment->price : "-"?></strong></p>
