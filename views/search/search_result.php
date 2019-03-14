<?php

?>

<h1>Результаты поиска квартир</h1>

<p>Город: <strong><?=$data['city']?></strong></p>
<p>Количество комнат: <strong><?=$data['rooms']?></strong></p>

<?php if(count($apartments)):?>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Название новостройки</th>
            <th scope="col">Город</th>
            <th scope="col">Дом</th>
            <th scope="col">Общая площадь (кв. м.)</th>
            <th scope="col">Минимальная цена за квартиру (грн)</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($apartments as $apartment):?>
            <tr>
                <td><?=isset($apartment->building_id) ? $apartment->building->title : $apartment->house->building->title?></td>
                <td><?=isset($apartment->building_id) ? $apartment->building->city : $apartment->house->building->city?></td>
                <td>
                    <?php if(isset($apartment->building_id)):?>
                        <?php foreach ($apartment->building->houses as $house):?>
                            <?=$house->title?><br>
                        <?php endforeach;?>
                    <?php else: ?>
                        <?=$apartment->house->title?>
                    <?php endif; ?>
                </td>
                <td>
                    <?=$apartment->square?> кв.м.
                </td>
                <td>
                    <?php if($apartment->price):?>
                        <?=$apartment->price?> грн
                    <?php else: ?>
                        <?=(int)($apartment->square * $apartment->price_per_square_meter)?> грн
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p>Поиск не дал результатов</p>
<?php endif; ?>
