<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\LaborCosts $model */

$this->title = 'Update Labor Costs: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Labor Costs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="labor-costs-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
