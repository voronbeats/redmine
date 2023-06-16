<?php

$this->registerJsFile('/js/searchtasks.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('/css/sreachtask.css');
if(!isset($label)) {
   $label = 'Задача';
}
?>

<div class="form-group field-laborcosts-task_id">
    <label class="control-label" for="laborcosts-task_id"><?=$label?></label>
    <input type="text" class="form-control top-input-text" aria-required="true" autocomplete="off" value="<?=$taskName?>">
    <div class="top-search-search"></div>
</div>