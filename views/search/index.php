<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
?>
<h1>Поиск квартир</h1>

<?php if( Yii::$app->session->hasFlash('error') ): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('error'); ?>
    </div>
<?php endif;?>

<form action="<?=Url::to(['search/search'])?>" method="GET">
    <div class="form-group">
        <label for="city">Город:</label>
        <input type="text" name="city" class="form-control" id="city">
    </div>
    <div class="form-group">
        <label for="rooms">Количество комнат:</label>
        <select name="rooms" id="rooms" class="form-control">
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
        <button class="btn btn-success">Поиск</button>
    </div>
</form>
