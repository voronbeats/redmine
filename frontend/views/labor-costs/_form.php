<?php

use frontend\widget\Autocomplete;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\LaborCosts $model */
/** @var yii\widgets\ActiveForm $form */

$this->registerCssFile('/css/style.css');
$this->registerJsFile('/js/site.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerCssFile('/assest_all/calendar/jquery-ui.css');
$this->registerJsFile('/assest_all/calendar/jquery-ui.js',
        ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="labor-costs-form container">

    <?php $form = ActiveForm::begin(); ?>

    <?=Autocomplete::widget(['task_id' => $model->task_id])?>

    <?= $form->field($model, 'task_id')->hiddenInput(['class' => 'form-control task-id'])->label(false)?>

    <?= $form->field($model, 'date')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '9999.99.99'])->textInput(['class' => 'form-control datepicker'])?> 

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'time')->textInput(['maxlength' => true, 'type' => 'time']) ?>

   

  
    

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
