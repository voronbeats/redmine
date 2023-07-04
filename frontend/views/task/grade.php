<?php
use miloschuman\highcharts\Highcharts;
use yii\bootstrap\ActiveForm;
use yii\helpers\html;
use yii\jui\DatePicker;
use yii\helpers\Url;
/** @var yii\web\View $this */
/** @var common\models\LaborCostsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'График успеваемости';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('/frontend/web/css/grade.css');
$this->registerJsFile(
    '/frontend/web/js/grade.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>


<?php if(!$users) {  ?>
    <br>
    <br>
    <br>
    <div class="alert alert-primary" role="alert">
        Нет информация за текущий период
    </div>
</div>
    <?}else{
echo Highcharts::widget([
    'options' => '{
        "chart": {
            "plotBackgroundColor": null,
            "plotBorderWidth": null,
            "plotShadow": false
        },
        "title": {
            "text": "График успеваемости"
        },
        "tooltip": {
            "pointFormat": "{series.name}: <b>{point.percentage:.1f}%</b>"
        },
        "plotOptions": {
            "pie": {
                "allowPointSelect": true,
                "cursor": "pointer",
                "dataLabels": {
                    "enabled": true,
                   "color": "#000000",
                    "connectorColor": "#000000",
                    "format": "<b>{point.name}</b>: {point.percentage:.1f} %"
                }
            }
        },
        "series": [{
    "type": "pie",
           "name": "Успевавемость",
            "data": [
        '.$users.'
            ]
        }]
    }'
]);
}
?>

<select id="select-grade" class="select" onchange="window.location = this.options[this.selectedIndex].value">
    <option <? if($_GET['date'] == date('Y-m')) { echo 'selected';}?> value="<?= Url::to(['task/grade', 'date' => date('Y-m')]); ?>"><?=date('Y-m')?></option>
    <option value="/task/grade?date=<?=date('Y-m', strtotime(date('Y-m'). ' -1 months'))?>"><?=date('Y-m', strtotime(date('Y-m'). ' -1 months'))?></option>
    <option value="/task/grade?date=<?=date('Y-m', strtotime(date('Y-m'). ' -2 months'))?>"><?=date('Y-m', strtotime(date('Y-m'). ' -2 months'))?></option>
    <option value="/task/grade?date=<?=date('Y-m', strtotime(date('Y-m'). ' -3 months'))?>"><?=date('Y-m', strtotime(date('Y-m'). ' -3 months'))?></option>
    <option value="/task/grade?date=<?=date('Y-m', strtotime(date('Y-m'). ' -4 months'))?>"><?=date('Y-m', strtotime(date('Y-m'). ' -4 months'))?></option>
</select>