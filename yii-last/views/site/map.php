<?php
/**
 * Created by PhpStorm.
 * User: Evgeny
 * Date: 29.07.2017
 * Time: 13:44
 */

?>

<div id="buttons">
    <button id="toTop">+</button>
    <button id="toBottom">-</button>
</div>

<div id="map-container"></div>


<style>
    #right-menu {
        /*transition: 0.5s;*/
        position: absolute;
        /*width: 50%;*/
        height:100%;
        background: #fff;
        top: 0px;
        right: 0px;
        z-index: 100;
        padding: 64px 32px;
        box-shadow: 0px 0px 10px rgba(0,0,0,0.15);
        display: none;
    }
    #right-menu.animated {
        display: block;
    }
    .close {
        font-size: 32px;
        font-weight: 100;
        top: 26px;
        position: relative;
    }
</style>
<div id="right-menu" class="col-md-4 col-sm-10 col-xs-11">
    <div class="pull-right close">×</div>
    <div class="right-menu-header h2">
        Province



    </div>

</div>
