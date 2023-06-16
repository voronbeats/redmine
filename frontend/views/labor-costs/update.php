<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\LaborCosts $model */

$this->title = 'Обновление трудозатрат: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Трудозатраты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновление';
?>
<div class="labor-costs-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
