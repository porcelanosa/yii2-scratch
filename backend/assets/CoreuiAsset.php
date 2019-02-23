<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class CoreuiAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'css/core-ui/admin-style.css',
    ];
    public $js = [
        'css/core-ui/dist/vendors/@coreui/coreui/js/coreui.min.js',
        'css/core-ui/dist/vendors/pace-progress/js/pace.min.js',
        'css/core-ui/dist/vendors/perfect-scrollbar/js/perfect-scrollbar.min.js'
    ];
    public $depends = [
        'yii\bootstrap4\BootstrapAsset',
    ];
}
