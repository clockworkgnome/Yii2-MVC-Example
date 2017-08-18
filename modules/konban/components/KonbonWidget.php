<?php

namespace app\modules\konban\components;

use yii\base\Widget;
use yii;



class KonbonWidget extends Widget{
	
	public $ownerId;
	
	
	public function init(){
		// add your logic here
	}
	
	public function run(){
		$users = (new \yii\db\Query())
		->select(['username'])
		->from('user')
		->all();
		$userNamesList="[";
		for($i=0;$i<count($users);$i++){
			$userNamesList=$userNamesList.'"'.$users[$i]["username"].'",';
		}
		
		$projects = (new \yii\db\Query())
		->select(['*'])
		->from('projects')
		->all();
		
		$todo=(new \yii\db\Query())
		->select(['*'])
		->from('itemStatus')
		->where(['status'=>'todo'])
		->all();
		
		$done=(new \yii\db\Query())
		->select(['*'])
		->from('itemStatus')
		->where(['status'=>'done'])
		->all();
		
		$userNamesList=$userNamesList."]";
		Yii::$app->view->registerCssFile('js/jqueryui/jquery-ui.min.css');
		Yii::$app->view->registerJsFile('js/jqueryui/external/jquery/jquery.js',[ 'position' => \yii\web\View::POS_HEAD]);
		Yii::$app->view->registerJsFile('js/jqueryui/jquery-ui.min.js',[ 'position' => \yii\web\View::POS_HEAD]);
		return $this->render('Konban',[
				'userNamesList'=>$userNamesList,
				'projects'=>$projects,
				'mytodo'=>$todo,
				'mydone'=>$done,
		]);
	}
}