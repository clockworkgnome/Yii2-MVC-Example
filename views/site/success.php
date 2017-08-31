<?php
use yii\helpers\Url;
?>

<div class="row">
<div class="col-lg-12">
	<div class="panel panel-default">
    		<div class="panel-heading">Thanks</div>
      	<div class="panel-body">
                <p> Thank you for your payment. If you have any questions feel free to contact us.  </p>
			<a href="tel:1-602-790-8610" class="btn btn-danger btn-lg">Call Us</a>
			<a href="<?= Url::toRoute("/site/contact")?>"><img src="<?= Url::base().'/img/buttons/contact.png' ?>" alt="Contact Us"></a>
      	</div>
    </div>
    </div>
    </div>