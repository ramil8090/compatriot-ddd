<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i',
        '/frontend/css/reset.css',
        '/frontend/fonts/fontawesome/css/all.min.css',
        '/frontend/css/main.css',
        '/frontend/css/header.css',
        '/frontend/css/content.css',
        '/frontend/css/footer.css',

    ];
    public $js = [
        '/frontend/js/script.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
