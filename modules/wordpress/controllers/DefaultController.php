<?php
namespace app\modules\wordpress\controllers;

use yii\web\Controller;


class DefaultController extends Controller
{

    /**
     * Renders the index view for the module
     * 
     * @return string
     */

    public function actionIndex()
    {
        return $this->render('index.php', []);
    }
    
    
}