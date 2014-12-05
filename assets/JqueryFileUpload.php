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
class JqueryFileUpload extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = ['vendors/jquery-fileupload/css/blueimp-gallery.min.css',
                   'vendors/jquery-fileupload/css/jquery.fileupload.css',
                   'vendors/jquery-fileupload/css/jquery.fileupload-ui.css',
                    ];
    public $js = [
                  'vendors/jquery-ui-1.11.2/jquery-ui.min.js',
                  'vendors/jquery-fileupload/js/vendor/jquery.ui.widget.js',
                  'vendors/tmpl/tmpl.min.full.js',
                  'vendors/jquery-fileupload/js/load-image.all.min.js',
                  'vendors/jquery-fileupload/js/canvas-to-blob.min.js',
                  'vendors/jquery-fileupload/js/jquery.blueimp-gallery.min.js',
                  'vendors/jquery-fileupload/js/jquery.iframe-transport.js',
                  'vendors/jquery-fileupload/js/jquery.fileupload.js',
                  'vendors/jquery-fileupload/js/jquery.fileupload-process.js',
                  'vendors/jquery-fileupload/js/jquery.fileupload-image.js',
                  'vendors/jquery-fileupload/js/jquery.fileupload-audio.js',
                  'vendors/jquery-fileupload/js/jquery.fileupload-video.js',
                  'vendors/jquery-fileupload/js/jquery.fileupload-validate.js',
                  'vendors/jquery-fileupload/js/jquery.fileupload-ui.js',
                  //'vendors/jquery-fileupload/js/main.js',

                ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset'
    ];
}
