<?php
/**
 * Created by PhpStorm.
 * User: Evgeny
 * Date: 17.12.2017
 * Time: 16:56
 */

?>
<style>
    /* VILLAGE */
    .village-item-wrap {
        float:left;
        padding: 10px;
    }
    .village-item {
        border-radius: 6px;
        border: solid 1px black;
        width: 60px;
        height:60px;
    }
    /* CHARACTERS */
    .character-item-wrap {
        float: left;
        padding: 10px;
    }
    .character-item {
        width: 70px;
        height: 70px;
        border: solid 4px #000;
        border-radius: 50%;
        position: relative;
    }
    .character-item img {
        border-radius: 50%;
        width: 100%;
        height:100%;
        border: 5px solid #fff;
    }
    .character-item .profession {
        position: absolute;
        right: -5px;
        bottom: -5px;
        border: solid 1px #000;
        border-radius: 50%;
        padding: 2px 6px 0px;
        background: #fff;
    }
    .character-item .shield {
        position: absolute;
        left: -5px;
        bottom: -5px;
        border: solid 1px #000;
        border-radius: 50%;
        width: 26px;
        height: 26px;
        background: url('/images/shield.jpg') no-repeat center;
        background-size: contain;
    }


    /*header {*/
        /*background: rgba(0,0,0,0.3) url('https://www.factroom.ru/facts/wp-content/uploads/2014/05/253.jpg') no-repeat center;*/
        /*background-size: contain;*/
        /*height: 300px;*/
        /*width: 100%;*/
    /*}*/
</style>

<header></header>

<div class="pull-right close">×</div>

<div class="right-menu-header h2"><?=$region['name']?></div>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aspernatur at autem explicabo inventore, ipsa magnam, necessitatibus nobis, perspiciatis quae reiciendis sed voluptas? Dolore enim modi rerum. Labore, possimus quia?</p>
<div class="right-menu-header h2">Castle</div>
<span class="glyphicon glyphicon-apple"></span>
<div class="">

    <span class="glyphicon glyphicon-user"></span>людей
    <span class="label label-default"><span class="glyphicon glyphicon-apple"></span> 145</span>
</div>

<!--glyphicon glyphicon-heart-->
<!--glyphicon glyphicon-fire-->
<!--glyphicon glyphicon-eye-open-->
<!--glyphicon glyphicon-tent-->
<!--glyphicon glyphicon-grain-->
<!--glyphicon glyphicon-education-->
<!--glyphicon glyphicon-thumbs-up-->
<!--glyphicon glyphicon-bookmark-->
<!--glyphicon glyphicon-star-->

<div class="h3">Characters</div>

<div class="">

    <div class="character-item-wrap">
        <div class="character-item">
            <img src="/images/character.jpg">
            <div class="shield">

            </div>
            <div class="profession">
                <span class="glyphicon glyphicon-certificate"></span>
            </div>
        </div>
    </div>

</div>

<div class="clearfix"></div>
<div class="h3">Guests</div>


<div class="">

    <div class="village-item">

    </div>

</div>

<div class="clearfix"></div>
<div class="right-menu-header h2">Villages</div>

<div class="">
    <?foreach($region->villages as $village):?>
        <div class="village-item-wrap">
            <div class="village-item">
                <span class="label label-default"><?=$village->population?></span>
            </div>
            <?=$village->name . ' ' . $village->id?><br>

            <?foreach(\app\models\Village::getProfessionArray() as $item):?>
                <span class="label label-default"><?=$item?>: <?=$village[$item]?></span><br>
            <?endforeach?>

        </div>
    <?endforeach?>
</div>

<div class="clearfix"></div>

<div class="right-menu-header h2">Army</div>
%progdir%\modules\php\%phpdriver%\php-win.exe

%progdir%\modules\wget\bin\wget.exe -q --no-cache -O /dev/null http://yii-strategy-project/server/test
%progdir%\modules\wget\bin\wget.exe -q --no-cache http://yii-strategy-project/server/test

CONSOLE
%progdir%\modules\php\%phpdriver%\php-win.exe -c %progdir%\userdata\temp\config\php.ini -q -f %sitedir%\site\yii loader/load 1 0
%progdir%\modules\php\%phpdriver%\php-win.exe -c %progdir%\userdata\config\PHP-5.6_php.ini -q -f %sitedir%\yii-strategy-project\yii\yii hello

<?
//    file_put_contents('PROVINCE.txt',date('H:i:s'));
?>

<span class="label label-default">100</span>

<span class="label label-default">По умолчанию 23</span>
<span class="label label-primary">Основной 33</span>
<span class="label label-success">Успех</span>
<span class="label label-info">Информация</span>
<span class="label label-warning">Предупреждение</span>
<span class="label label-danger">Опасность</span>


<span class="label label-default">По умолчанию 23</span>
<span class="label label-primary">Основной 33</span>
<span class="label label-info">Информация</span>

<span class="label label-danger">3</span>
<span class="label label-success">2</span>
<span class="label label-warning">4</span>
<span class="label label-info">6</span>


<script>
    $('#right-menu .close').on('click', function() {
        $('#right-menu').addClass('bounceOutRight');
        setTimeout(function(){
            $('#right-menu').removeClass('animated');
            $('#right-menu').removeClass('bounceInRight');
            $('#right-menu').removeClass('bounceOutRight');
        },500);
    });
</script>