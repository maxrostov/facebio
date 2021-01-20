<?php

use Zelenin\yii\SemanticUI\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Person */
/* @var $form yii\widgets\ActiveForm */
?>

<div  class="ui bottom attached segment">
<?php $form = ActiveForm::begin(    [
    'enableClientValidation' =>false,
    'enableClientScript' =>false,

    'options' =>
        ['class' => 'ui form']
]); ?>

<?= $form->errorSummary($model); ?>



<div class="three fields">
    <div class="field">
        <?php echo $form->field($model, 'family_id')->dropDownList($model->family) ?>
    </div>
    <div class="field">
        <?php echo $form->field($model, 'children_id')->dropDownList($model->children) ?>
    </div>
    <div class="field">
        <?php echo $form->field($model, 'pension_id')->dropDownList($model->pension) ?>
    </div>

</div>


<div class="three fields">
    <div class="field">
        <?php echo $form->field($model, 'education_id')->dropDownList($model->education) ?>
    </div>
    <div class="field">
        <?php echo $form->field($model, 'qualification_id')->dropDownList($model->qualification) ?>
    </div>
    <div class="field">
        <?php echo $form->field($model, 'workarea_id')->dropDownList($model->workarea) ?>

    </div>

</div>

<div class="three fields">
    <div class="field">
        <?php echo $form->field($model, 'work_search_id')->dropDownList($model->work_search) ?>

    </div>

    <div class="field">
        <?php echo $form->field($model, 'cause_id')->dropDownList($model->cause) ?>
    </div>

    <div class="field">
        <?php echo $form->field($model, 'relation_id')->dropDownList($model->relation) ?>
    </div>
</div>


<div class="three fields">
    <div class="field">
        <?php echo $form->field($model, 'prefer_id')->dropDownList($model->prefer) ?>
    </div>
    <div class="field">
        <?php echo $form->field($model, 'try_id')->dropDownList($model->try) ?>
    </div>
    <div class="field">
        <?php echo $form->field($model, 'how_long_id')->dropDownList($model->how_long) ?>

    </div>
</div>

<div class="two fields">

    <div class="field">
        <label for="agency_id"><?=$model->getAttributeLabel('agency_id')?></label>
        <select onclick="agency_leave()" id="agency_id" name="Person[agency_id]" class="ui dropdown">
            <option value="0">Нет ответа</option>
            <option value="1" <?php if($model->agency_id==1) echo 'selected' ?> >Пребывал в ночлежном доме (ночлежке)</option>
            <option value="2" <?php if($model->agency_id==2) echo 'selected' ?>>Жил в специальном интернате</option>
            <option value="3" <?php if($model->agency_id==3) echo 'selected' ?>>В приемнике - распределителе</option>
            <option value="4" <?php if($model->agency_id==4) echo 'selected' ?>>Отбывал срок заключения</option>
            <option value="5" <?php if($model->agency_id==5) echo 'selected' ?>>Другое</option>
          </select>

        <?php //echo $form->field($model, 'agency_id')->dropDownList($model->agency) ?>
    </div>
    <div class="field">
        <?php echo $form->field($model, 'agency_leave_id')->dropDownList($model->agency_leave) ?>
    </div>
</div>

<div class="four fields">

    <div class="field">

        <?php echo $form->field($model, 'socialhelp1_ids')->checkboxList($model->socialhelp1s) ?>
    </div>
    <div class="field">
        <?php echo $form->field($model, 'socialhelp2_ids')->checkboxList($model->socialhelp2s) ?>
    </div>
    <div class="field">
        <?php echo $form->field($model, 'hobby_ids')->checkboxList($model->hobbys) ?>
        <?php //echo $form->field($model, 'is_religious')->checkbox(['class' => '']) ?>
    </div>

    <div class="field">
        <?php echo $form->field($model, 'plan_ids')->checkboxList($model->plans) ?>
    </div>

</div>
<!--<button onclick="window.history.back();" class="ui grey button">Возврат</button>-->
<div id="editButton" onclick="editButton()" class="ui blue button">Редактировать</div>
<button id="saveButton" style="display: none" type="submit" class="ui right floated green button">Сохранить</button>
<br><br>
<?php ActiveForm::end(); ?>



<a href="/person/anketa_p?id=<?=$model->id?>" target="_blank">
    <i class="print icon"></i> Версия для печати</a>
</div>
<script>
    // jQuery еще не загрузился
    var divs = document.querySelectorAll('.ui .dropdown');
    for (var i = 0; i < divs.length; i++) {
        divs[i].classList.add('disabled');
    }

    var divs2 = document.querySelectorAll('.ui .checkbox');
    for (var i = 0; i < divs2.length; i++) {
        divs2[i].classList.add('disabled');
    }

    function editButton() {

        $("#editButton").hide(100);
        $("#saveButton").show(400);
        $(".ui .checkbox").removeClass('disabled');
        $(".ui .dropdown").removeClass('disabled');
    }

    function agency_leave() {
        //Находились ли раньше в спец учереждениях
        // нет ответа -> прячем "Если находились, почему покинули"
        if (document.getElementById('agency_id').value=="0") {
            document.querySelector('.field-person-agency_leave_id').style.display = 'none';


        } else {
            document.querySelector('.field-person-agency_leave_id').style.display = 'block';

        }
    }

    agency_leave();
</script>

