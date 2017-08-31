<?php
use yii\helpers\Url;
?>

<div class="row">
<div class="col-lg-12">
	<div class="panel panel-default">
    		<div class="panel-heading">Looks like there was some trouble</div>
      	<div class="panel-body">
                <p> Please contact us if you need help checking out orpaying your bill.  </p>
			<a href="tel:1-602-790-8610" class="btn btn-danger btn-lg">Call Us</a>
			<a href="<?= Url::toRoute("/site/contact")?>"><img src="<?= Url::base().'/img/buttons/contact.png' ?>" alt="Contact Us"></a>
      	</div>
    </div>
    </div>
    </div>