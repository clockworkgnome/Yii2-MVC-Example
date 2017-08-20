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
			'css/site.css',
			'js/jqueryui/jquery-ui.min.css'
	];
	public $js = [
			'js/jqueryui/external/jquery/jquery.js',
			'js/jqueryui/jquery-ui.min.js',
	        'js/jquery.ui.touch-punch.min.js',
	        'js/touche/src/touche.js'
	];
	public $depends = [
			'yii\web\YiiAsset',
			'yii\bootstrap\BootstrapAsset',
	];
}
