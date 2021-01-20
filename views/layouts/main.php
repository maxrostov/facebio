<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;

//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
//use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link  rel="stylesheet" href="/css/my.css">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
</head>
<body style="background-color: #ccc;background-image: url(/img/bg3.jpg);">
<?php $this->beginBody();

?>
<?php if(!Yii::$app->user->isGuest){ ?>
<!--    <div class="app" style="box-shadow: 4px 4px grey">-->
<div class="ui container my_header_footer print_hide" style="padding: 2em; 1em;background-image: url(/img/header.png);">
<!--    <img src="/img/logo.jpg" style="padding-right: .5em;float: left;">-->
    Государственное автономное учреждение <br>социального обслуживания населения Ростовской области <br>
    <b style="font-size: 120%;text-shadow: 2px 2px 4px #180657;">«Комплексный социальный центр по оказанию помощи  <br> лицам без определённого места жительства <br> г. Ростова-на-Дону»</b></div>
    <div class="ui container" style="background-color: #fff;padding: 1rem;">
<!--    <div class="ui horizontal fitted divider"></div>-->



    <div id="top_nav" class="ui stackable menu print_hide">
<!--        <span class="item"><b>Face</b>Bio 360&deg;</span>-->
        <a href="/person" class="item"><i class="users icon"></i>Клиенты</a>
       <a href="/visit" class="item" id="menu-firms"><i class="list layout icon"></i>Визиты</a>

       <div class="right menu">

           <?php if(Yii::$app->user->identity->username=='admin') { ?>
            <div class="ui dropdown item">
                <i class="cog icon"></i><i class="dropdown icon"></i>
                <div class="menu">
                    <a  href="/org" class="item"><i class="building icon"></i>Организация</a>
                    <a  href="/branch"  class="item"><i class="building outline icon"></i>Подразделения</a>
                    <a class="item"><i class="address card outline icon"></i>Сканеры</a>
                    <a class="item"><i class="user outline icon"></i>Пользователи</a>
                </div>
            </div>
           <?php } ?>
            <a data-method="post" href="<?= yii\helpers\Url::to(['site/logout']) ?>" class="item">
                <i class="sign out icon"></i>
<!--                Выйти  -->
                <span style="font-size: 100%;"><?= Yii::$app->user->identity->username ?></span>
            </a>
           </div>
    </div>



    <div class="ui horizontal fitted divider"></div>


    <?= Alert::widget() ?>
    <?= $content ?>


</div>
        <div class="ui container my_header_footer print_hide" style="padding: 2em; 1em;background-image: url(/img/footer.png);">
            г. Ростов-на-Дону, пер. Семашко, 1Б<br>
            Телефон: 8(863) 263-01-12<br>
            Телефон горячей линии: 8(863) 263-01-14<br>
            Факс: 8(863) 263-01-11<br>
            Режим работы: пн-пт 9.00-17.30 <br>
           </div>

<?php }


elseif(Yii::$app->controller->action->id=='login') // временный хак, иначе показыает без логина персон.
{
    echo $content; // only for login form
}
else {
   echo '
<div class="ui container"><br><br>
<h3>Ошибка доступа</h3> <a href="/site/login">Войдите в систему</a>
</div>';
}?>
<!--    </div>-->
<?php $this->endBody() ?>

<!--    https://dadata.ru/suggestions/usage/address/#question-secure-token-->
<link href="https://cdn.jsdelivr.net/npm/suggestions-jquery@19.8.0/dist/css/suggestions.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/suggestions-jquery@19.8.0/dist/js/jquery.suggestions.min.js"></script>

<link href="https://www.unpkg.com/fullcalendar@3.10.1/dist/fullcalendar.min.css" rel="stylesheet" />
<!--    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.15/lodash.min.js"></script>-->
<script src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>
<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/clndr/1.5.1/clndr.min.js"></script>-->
<script src="https://www.unpkg.com/fullcalendar@3.10.1/dist/fullcalendar.min.js"></script>
<script src="https://www.unpkg.com/fullcalendar@3.10.1/dist/locale/ru.js"></script>


<script src="/js/dadata_vue.js"></script>
<script src="/js/_form_vue.js"></script>

</body>
</html>
<?php $this->endPage() ?>
