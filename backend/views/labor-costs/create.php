<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\LaborCosts $model */

$this->title = 'Create Labor Costs';
$this->params['breadcrumbs'][] = ['label' => 'Labor Costs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="labor-costs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
