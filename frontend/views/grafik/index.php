<?php

use yii\helpers\Html;
use yii\helpers\Url;


$this->title = 'График дежурств';
$this->params['breadcrumbs'][] = $this->title;


?>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>Имя</th>
      <?foreach($dayArray as $key => $day) {?>
         <th><?=$key?></th>
      <?}?>
    </tr>
  </thead>
  <tbody>
    <?foreach($users as $user) {?>
        <tr>
            <td><?=$user->username?></td>

            
            <?foreach($dayArray as $key => $day) {?>
            <td>
            <? if($key == 'Сб' || $key == 'Вс') {?>
                  <span style="color: red;">вых</span>
            <? }else{?>
       
                    <? if($user->usergrafik($user->id, $day)) {?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                        <circle cx="8" cy="8" r="8"/>
                        </svg>
                    <? }else{?>


                  <?if ($day == date("Y-m-d") && $user->userprogul($user->id, $day)) {?>
                            <svg style="color: red;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-slash-circle" viewBox="0 0 16 16">
                               <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                               <path d="M11.354 4.646a.5.5 0 0 0-.708 0l-6 6a.5.5 0 0 0 .708.708l6-6a.5.5 0 0 0 0-.708z"/>
                             </svg>
                   
                       <?}else{?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                </svg>
                        <? } ?> 
                    <? } ?> 
            <? } ?>           
            </td>
            <?}?>
        </tr>
    <? } ?>
  </tbody>
</table>