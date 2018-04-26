<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'css/site.css',
        'css/animate.css',
        'css/style.css',
    ];
    public $js = [
         'https://cdn.rawgit.com/konvajs/konva/1.6.7/konva.min.js',
//        'js/konva.edited.js',
        'js/mousewheel.js',
        'js/svg.js',
        'js/ireland.js',

        'js/data/castles.js',

        /* map  */
        'js/map/helper.js',
        'js/map/config.js',
        'js/map/client.js',

        'js/map/region.js',
        'js/map/map.js',
        'js/map/render.js',


    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}