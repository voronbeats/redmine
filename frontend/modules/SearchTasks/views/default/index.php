<? if($models) {?>
    <ul>
        <? foreach($models as $res) {?>
            <li><span class="click-search" data-id="<?=$res->id?>"><?=$res->name?></span></li>
        <? } ?>
    </ul>
<? }else{ ?>
  Ничего не найдено
<? } ?>