<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\components\Alert;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="https://fonts.googleapis.com/css?family=Saira" rel="stylesheet">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

    <?php
    NavBar::begin([
        'brandLabel' => '<div class="pull-left mylogo"><img src="'.Url::base().'/img/logo-50.png" class="img-fluid" alt="JuJu Gaming and Development LLC."> JuJu Gaming And Development LLC.</div>',
    	'renderInnerContainer'=>FALSE,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'myNavBar',
        ],
    ]);
    
    $menuItems = [
    		['label' => 'Home', 'url' => ['/site/index'],'linkOptions' => ['class' => 'myLinks']],
    		['label' => 'About', 'url' => ['/site/about'],'linkOptions' => ['class' => 'myLinks']],
    		['label' => 'Contact', 'url' => ['/site/contact'],'linkOptions' => ['class' => 'myLinks']],
    ];
    if (Yii::$app->user->isGuest) {
    	$menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup'],'linkOptions' => ['class' => 'myLinks']];
    	$menuItems[] = ['label' => 'Login', 'url' => ['/site/login'],'linkOptions' => ['class' => 'myLinks']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="myContainer">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; JuJu Gaming and Development LLC.<?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
