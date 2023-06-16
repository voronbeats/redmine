<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Progul $model */
/** @var yii\widgets\ActiveForm $form */


$this->registerCssFile('/assest_all/calendar/jquery-ui.css');
$this->registerJsFile(
    '/assest_all/calendar/jquery-ui.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>

<div class="progul-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->dropDownList($users) ?>

    <?= $form->field($model, 'date')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '9999-99-99'])->textInput(['class' => 'form-control datepicker']) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
