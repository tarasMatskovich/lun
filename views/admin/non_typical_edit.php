<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>

<h1>Редактирование квартиры</h1>

<?php if( Yii::$app->session->hasFlash('error') ): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('error'); ?>
    </div>
<?php endif;?>

<form action="<?=Url::to(['admin/nontypicalupdateapartment', 'id' => $apartment->id])?>" method="post">
    <div class="form-group">
        <label for="rooms">Количество комнат</label>
        <select name="rooms" id="rooms" class="form-control">
            <option value="студия" <?php if($apartment->rooms == 'студия'):?>selected<?php endif;?>>Студия</option>
            <option value="1к" <?php if($apartment->rooms == '1к'):?>selected<?php endif;?>>1к</option>
            <option value="2к" <?php if($apartment->rooms == '2к'):?>selected<?php endif;?>>2к</option>
            <option value="3к" <?php if($apartment->rooms == '3к'):?>selected<?php endif;?>>3к</option>
            <option value="4к" <?php if($apartment->rooms == '4к'):?>selected<?php endif;?>>4к</option>
            <option value="5к" <?php if($apartment->rooms == '5к'):?>selected<?php endif;?>>5к</option>
            <option value="5к двухуровневая" <?php if($apartment->rooms == '5к двухуровневая'):?>selected<?php endif;?>>5к двухуровневая</option>
            <option value="6к двухуровневая" <?php if($apartment->rooms == '6к двухуровневая'):?>selected<?php endif;?>>6к двухуровневая</option>
        </select>
    </div>
    <div class="form-group">
        <label for="square">Общая площадь (в метрах квадратных)</label>
        <input type="number" name="square" class="form-control" placeholder="Площадь" value="<?=$apartment->square?>">
    </div>
    <div class="form-group">
        <?php if ($apartment->price): ?>
            <label for="price">Цена за всю квартиру (грн):</label>
            <input type="number" name="price" class="form-control" placeholder="Цена" value="<?=$apartment->price?>">
            <input type="hidden" name="fullPrice" value="true">
        <?php else: ?>
            <label for="price">Цена за 1 квадратный метр (грн):</label>
            <input type="number" name="price" class="form-control" placeholder="Цена" value="<?=$apartment->price_per_square_meter?>">
            <input type="hidden" name="fullPrice" value="false">
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="house">Дом:</label>
        <select name="house_id" id="house" class="form-control">
            <?php foreach ($apartment->house->building->houses as $house):?>
                <option value="<?=$house->id?>"><?=$house->title?></option>
            <?php endforeach;?>
        </select>
    </div>
    <?=Html::hiddenInput(\Yii :: $app->getRequest()->csrfParam, \Yii :: $app->getRequest()->getCsrfToken(), [])?>
    <div class="form-group">
        <button class="btn btn-success">Сохранить</button>
    </div>
</form>
