<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\LaborCosts $model */

$this->title = 'Создание трудозатрат';
$this->params['breadcrumbs'][] = ['label' => 'Labor Costs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div  class="labor-costs-create container">

    <h1 style="font-weight: 400;"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
