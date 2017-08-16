<?php
namespace app\modules\konban\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
	/**
	 * Renders the index view for the module
	 * @return string
	 */
	//public $defaultAction = 'build';
	//public $layout = false;
	public function actionIndex(){
		return $this->render('index.php',[]);
	}
}