<?php

use yii\helpers\Html;
//use yii\bootstrap\ActiveForm;
use Zelenin\yii\SemanticUI\widgets\ActiveForm;
use Zelenin\yii\SemanticUI\widgets\ActiveField;

/* @var $this yii\web\View */
/* @var $model app\models\Person */
/* @var $form yii\widgets\ActiveForm */
?>


<?php $form = ActiveForm::begin(
    [
        'enableClientValidation' => false,
        'enableClientScript' => false,

        'options' =>
            ['class' => 'ui form', 'enctype' => 'multipart/form-data']
    ]
); ?>
<?= $form->errorSummary($model); ?>

<div class="inline fields">

    <div class="field">
        <div class="ui radio checkbox">
            <input name="Person[sex_id]" value="1" <?php if ($model->sex_id == 0 OR $model->sex_id == 1) echo 'checked' ?> id="sex_male" type="radio">
            <label for="sex_male">Мужчина</label>
        </div>
    </div>
    <div class="field">
        <div class="ui radio checkbox">
            <input name="Person[sex_id]" value="2" <?php if ($model->sex_id == 2) echo 'checked' ?> id="sex_female" type="radio">
            <label for="sex_female">Женщина</label>
        </div>
    </div>
</div>

<div class="five fields">
    <div class="field">
        <?php


        $model->status_id = $model->isNewRecord ? 0 : $model->status_id;
        echo $form->field($model, 'status_id')
            ->dropDownList($model->status) ?>
    </div>
    <div class="field">
        <?php
        // get all product types from the corresponding table:
        $branches = \app\models\Branch::find()->asArray()->all();
        // create an array of pairs ('id', 'type-name'):
        $branchesList = yii\helpers\ArrayHelper::map($branches, 'id', 'title');

        $model->branch_id = $model->isNewRecord ? 0 : $model->branch_id;
        echo $form->field($model, 'branch_id')
            ->dropDownList($branchesList) ?>
    </div>
    <div class="field">
        <label>Фамилия</label>
        <input value="<?php echo $model->surname ?>" required type="text" name="Person[surname]" placeholder="Фамилия">
    </div>

    <div class="field">
        <label>Имя</label>
        <input value="<?php echo $model->name ?>" required type="text" name="Person[name]" placeholder="Имя">
    </div>
    <div class="field">
        <label>Отчество</label>
        <input value="<?php echo $model->patronymic ?>" required
               type="text" name="Person[patronymic]" placeholder="Отчество">
    </div>

    <!--    <div class="field">-->
    <!--        <label>Имя в сканнере</label>-->
    <!--        <input value="--><?php //echo $model->name_scanner ?><!--" required type="text" name="Person[name_scanner]"-->
    <!--               placeholder="Имя в сканнере (только латиница)">-->
    <!--    </div>-->
</div>

<!--<div class="fields">-->
<!--    <div class="three wide field">-->
<!--        <label>Дата рождения</label>-->
<!--        <input type="date" name="Person[birthdate]" value="--><?php //echo $model->birthdate ?><!--">-->
<!--    </div>-->
<!--    <div class="thirteen wide field">-->
<!--        <label>Место рождения</label>-->
<!--        <input class="js-dadata_address" type="text" name="Person[birth_place]" value="--><?php //echo $model->birth_place ?><!--">-->
<!--    </div>-->
<!---->
<!--</div>-->
<!---->
<!--<div class="fields">-->
<!---->
<!--    <div class="eight wide field">-->
<!--        <label>В 1992 году проживал</label>-->
<!--        <input class="js-dadata_address" type="text" name="Person[location92]" value="--><?php //echo $model->location92 ?><!--">-->
<!--    </div>-->
<!--    <div class="eight wide field">-->
<!--        <label>Из какого населенного пункта вы приехали</label>-->
<!--        <input class="js-dadata_address" type="text" name="Person[came_from]" value="--><?php //echo $model->came_from ?><!--">-->
<!--    </div>-->
<!--</div>-->

<input type="hidden" id="_bio_rows_4vuejs" value='<?= $model->bio_rows ?? '[]' ?>'>
<input type="hidden" id="_reg_rows_4vuejs" value='<?= $model->reg_rows ?? '[]' ?>'>
<div id="vue_app">
</div>
<script id="vue_bio_template" type="text/x-template">
    <div>
        <fieldset>
            <legend>Биография</legend>


            <input type="hidden" name="Person[bio_rows]" :value="JSON.stringify(bio_rows)">
            <input type="hidden" name="Person[reg_rows]" :value="JSON.stringify(reg_rows)">

            <div v-for="(bio, index) in bio_rows" style="border-bottom: 1px solid grey;margin-bottom: 1rem;">
                <div class="fields">
                    <div class="three wide field">
                        <label>Начало</label>
                        <input type="date" v-model="bio.date1">
                    </div>

                    <div class="fifteen  wide field">
                        <label>Организация</label>
                        <dadata :model.sync="bio.org" :model_address.sync="bio.address" :placeholder="'Начните вводить организацию'"
                                :options="optOrg"></dadata>

                    </div>
                </div>

                <div class="fields">
                    <div class="three wide field">
                        <label>Окончание</label>
                        <input type="date" v-model="bio.date2">
                    </div>

                    <div class="eleven wide field">
                        <label>Адрес</label>
                        <dadata :model.sync="bio.address" :placeholder="'Начните вводить адрес'" :options="optAddress"></dadata>

                    </div>
                    <div class="two wide field">
                        <label>Врем. прописка</label>
                        <input type="checkbox" @click="clickTempReg(bio)" v-model="bio.reg">
                    </div>
                    <div class="two wide field">
                        <label>Удалить</label>
                        <div class="ui tiny grey button" @click="delItem(reg_rows, index)">X</div>
                    </div>
                </div>

            </div>
            <div @click="addBio" class="ui tiny blue button">Добавить запись</div>
        </fieldset>
        <br><br>
        <fieldset>
            <legend>Прописка</legend>
        <div v-for="(reg, index) in reg_rows" style="border-bottom: 1px solid grey;margin-bottom: 1rem;">
                <div class="fields">
                    <div class="three wide field">
                        <label>Начало</label>
                        <input type="date" v-model="reg.date1">
                    </div>
                    <div class="three wide field">
                        <label>Окончание</label>
                        <input type="date" v-model="reg.date2">
                    </div>
                    <div class="thirteen wide field">
                        <label>Адрес</label>
                        <dadata :model.sync="reg.address" :placeholder="'Начните вводить адрес'" :options="optAddress"></dadata>

                    </div>
                    <div class="two wide field">
                        <label>Удалить</label>
           <div class="ui tiny grey button" @click="delItem(reg_rows, index)">X</div>
                     </div>
                </div>
            </div>
            <div @click="addReg" class="ui tiny blue button">Добавить запись</div>
        </fieldset>

    </div>
    </div>
</script>


<div class="fields">
    <div class="field">
        <?php echo $form->field($model, 'upload')->fileInput() ?>

        <?php if ($model->photo) { ?>
            <?= $form->field($model, 'del_upload')->checkbox() ?>
        <?php } ?>
    </div>
</div>
<a onclick="window.history.back();" class="ui labeled icon tiny grey button"><i class="cancel icon"></i>Возврат</a>
<button type="submit" href="/person/create" class="ui right floated labeled icon tiny green button"><i class="plus icon"></i>Сохранить</button>

<!--<button onclick="window.history.back();" class="ui grey button">Возврат</button>-->
<?php ActiveForm::end(); ?>


