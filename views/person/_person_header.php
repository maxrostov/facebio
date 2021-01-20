<div id="avatar_popup" class="ui basic mini modal">
<!--     <div class="header">--><?php //echo $person->surname . ' ' . $person->name . ' ' .
//            $person->patronymic ?><!--</div>-->
    <div class="image content">
  <img  class="ui fluid image" src="/uploads/photo/<?=$person->photo() ?>">
<!--        <div class="description">111 222</div>-->
    </div>
</div>



<table class="ui very basic compact table">
   <tr>
    <td>    <img onclick="$('#avatar_popup').modal('show');" src="/uploads/photo/<?=$person->photo() ?>" style="height:108px;"
                 class="fitted item">

    </td>
<td class="item">
    <span style="font-size: 130%;">
         <?php echo $person->surname . ' ' . $person->name . ' ' .
            $person->patronymic ?></span>  <br>
    <span style="font-size: 80%;">
     <?=$person->status[$person->status_id] ?>
 </span>
</td>

    <td class="item" style="font-size: 80%;">
       <?=$person->name_scanner ?><br>
        <?=$person->age() ?> лет<br>

        <?php
        echo $face_icon = ($person->face_data) ? '<i title="биометрия лицо" class="ui teal smile icon"></i>':  '';
        echo $finger_icon = ($person->finger_data) ? '<i title="биометрия пальцы"  class="ui teal thumbs up icon"></i>':  '';
      ?>


</td>
   </tr>
</table>
<div class="ui top attached tabular menu">
    <a href="/person/view?id=<?=$id?>" class="<?php if($active =='view') echo 'active' ?> item">
        <i class="<?php if($active =='view') echo 'orange' ?> user icon"></i> Личные данные
    </a>
    <a href="/person/anketa?id=<?=$id?>"  class="<?php if($active =='anketa') echo 'active' ?> item">
        <i class="<?php if($active =='anketa') echo 'orange' ?> clipboard list icon"></i> Анкета
    </a>
    <a href="/person/docs?id=<?=$id?>"  class="<?php if($active =='docs') echo 'active' ?> item">
        <i class="<?php if($active =='docs') echo 'orange' ?> address card icon"></i>   Личное дело
    </a>
    <a href="/person/visits?id=<?=$id?>"  class="<?php if($active =='visits') echo 'active' ?> item">
        <i class="<?php if($active =='visits') echo 'orange' ?> chart bar icon"></i>   Визиты и действия
    </a>

</div>