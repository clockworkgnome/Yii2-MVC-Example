<?php

namespace app\components;

use yii\base\Widget;
use yii;



class KonbonWidget extends Widget{
	
	public $ownerId;
	
	
	public function init(){
		// add your logic here
	}
	
	public function run(){
		Yii::$app->view->registerCssFile('js/jqueryui/jquery-ui.min.css');
		Yii::$app->view->registerJsFile('js/jqueryui/external/jquery/jquery.js',[ 'position' => \yii\web\View::POS_HEAD]);
		Yii::$app->view->registerJsFile('js/jqueryui/jquery-ui.min.js',[ 'position' => \yii\web\View::POS_HEAD]);
		return $this->render('Konban',[
				
		]);
	}
}