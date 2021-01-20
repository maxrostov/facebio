<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
//use yii\bootstrap\ActiveForm;
 ?>
 <div style="height:100%" class="ui middle aligned center aligned grid">
    <div style="max-width: 600px;background: #f2f2f2;padding: 4em 2em;" class="column">
        <h2 class="ui teal image header">
           <div class="content">
                Войти в систему
            </div>
        </h2>
        <form  method="post" action="/site/login" class="ui large form">
            <?=Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken)?>

            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input autofocus="true" type="text" name="LoginForm[username]" placeholder="Логин">
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password" name="LoginForm[password]" placeholder="Пароль">
                    </div>
                </div>
                <button type="submit" name="login-button" class="ui fluid large teal submit button">Войти</button>
            </div>
            <div class="ui error message"></div>
        </form>
     </div>
</div>