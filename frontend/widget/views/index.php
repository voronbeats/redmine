<?php

$this->registerJsFile('/js/searchtasks.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('/css/sreachtask.css');
?>

<div class="form-group field-laborcosts-task_id">
    <label class="control-label" for="laborcosts-task_id">Задача</label>
    <input type="text" class="form-control top-input-text" name="LaborCosts[task_id]" aria-required="true" autocomplete="off" value="<?=$taskName?>">
    <div class="top-search-search"></div>
</div>