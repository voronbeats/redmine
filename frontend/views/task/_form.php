<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use common\models\User;
/** @var yii\web\View $this */
/** @var common\models\Task $model */
/** @var yii\widgets\ActiveForm $form */
$this->registerJsFile('/js/site.js', ['depends' => [\yii\web\JqueryAsset::className()]]);


$time = date_parse_from_format("Y-m-d H:iP ", $model->date_add);
$date = ($time['year'] . '-' . $time['month'] . '-' . $time['day'] . 'T' . $time['hour'] . ':' . $time['minute']);

$this->registerCssFile('/css/style.css');
$this->registerCssFile('/assest_all/calendar/jquery-ui.css');
$this->registerJsFile('/assest_all/calendar/jquery-ui.js',
        ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Url::home(true).'js/script.js',
        ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="labor-costs-form container">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'status')->dropDownList(\common\models\Task::STATUS) ?>

        <?= $form->field($model, 'prioritet')->textInput() ?>

        <?= $form->field($model, 'date_add')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '9999.99.99 99:99:99'])->textInput(['class' => 'form-control datepicker'])?> 

        <?= $form->field($model, 'date_end')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '9999.99.99 99:99:99'])->textInput(['class' => 'form-control datepicker'])?> 

        <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'ocenka_truda')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'user_id')->dropDownList($users) ?>

        <?= $form->field($model, 'readliness')->textInput() ?>

        <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
</div>



