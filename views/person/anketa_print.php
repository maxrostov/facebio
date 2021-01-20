<?php
use yii\helpers\Html;
?>

<img src="/uploads/photo/<?=$model->photo()?>" alt=""
     style="width: 150px;margin: 1rem;float: left;">

    <h2>
<?php echo $model->surname.' '.$model->name.' '.$model->patronymic ?>
</h2>
    <?=$model->age() ?> лет;  <?=$model->birthdate ?> <?=$model->birth_place ?><br>

<table class='ui very compact striped selectable celled table'>
    <?php
    $bio_rows = json_decode($model->bio_rows) ?? [];
    $reg_rows = json_decode($model->reg_rows) ?? [];

    // передаем весь массив биографии, находим где человек был в 1992г (т.е. первая подходящая позиция)
    function find_year($bio_rows,$year){
        $find = strtotime("$year-01-01");
        foreach ($bio_rows as $row){
            if ($find < strtotime($row->date2)) return $row->address;
        }
    }
    ?>
    <tr>
        <td>Дата и место рождения</td>
        <td><?= $model->birthdate ?> <?= $model->birth_place ?>
            <?php
            if ($bio_rows) echo(current($bio_rows)->address)
            ?>
        </td>
    </tr>
    <tr>
        <td>В 1992 году проживал</td>
        <td><?= $model->location92 ?>
            <?php echo find_year($bio_rows,'1992') ?></td>
    </tr>
    <tr>
        <td>В 2002 году проживал</td>
        <td>
            <?php echo find_year($bio_rows,'2002') ?></td>
    </tr>
    <tr>
        <td>Из какого населенного пункта вы приехали</td>
        <td><?= $model->came_from ?>
            <?php
            if ($bio_rows) echo(end($bio_rows)->address) ?>
        </td>
    </tr>
    <?php if($reg_rows){ ?> <tr><td colspan="2"><b>Биография</b></td><?php } ?>
    </tr>

    <?php
    // format date
    function d($date){
        $d = strtotime($date);
        return date('d/m/y',$d);
    }

    foreach($bio_rows as $bio){ ?>
        <tr>    <td><?php echo d($bio->date1). '&mdash;' .d($bio->date2) ?></td>
            <td><?=$bio->org?><br> <?=$bio->address ?></td>
        </tr>
    <?php } ?>

    <?php if($reg_rows){ ?> <tr><td colspan="2"><b>Прописка</b></td></tr> <?php } ?>

    <?php foreach($reg_rows as $reg){ ?>
        <tr>    <td><?php echo d($reg->date1). '&mdash;' .d($reg->date2) ?></td>
            <td><?=$reg->address ?></td>
        </tr>
    <?php } ?>

</table>



<table class='ui very compact striped selectable celled small table'>
    <?php foreach($model->docs as $doc){ ?>
    <tr> <td>
            <i><?php echo $doc->type() ?></i> <br>
            <?php echo $doc->serial ?> <?php echo $doc->number ?>
        </td>
        <td>

            <?php echo $doc->issued_by ?> <?php echo $doc->issued_date ?> <br>
             <?php echo $doc->registration ?> <br>
            <?php echo $doc->info ?>

        </td>
    </tr>
<?php } ?>
</table>

    <?php echo $model->showProfileTable() ?>
    <br><br>
    Анкету заполнил: ___________________________ <br><br><br>
    Клиент: _______________  <?php echo $model->surname.' '.$model->name.' '.$model->patronymic ?>
<script>
    window.print();
</script>