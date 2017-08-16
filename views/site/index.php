<?php
use app\components\ChartWidget;
use app\components\KonbonWidget;
/* @var $this yii\web\View */

$this->title = 'JuJu Gaming and Development';
?>
<div class="site-index">

				<div class="panel">
					 <div class="panel-heading">
						<h3 class="panel-title myHeadings">Introducing the Web 2.0 tailored for Your business</h3>
					</div>
					<div class="panel-body">
						<p class="lead">Let us help you discover what the web 2.0 can do for you.  
				        With our innovative approaches to responsive website design and software development we will 
				        enable you to display and track real time statistics related to all your business functions.  
				        Our goal is to make your business more successful.  To accomplish this we will take into account your 
				        company’s unique services and objectives as we design software and/or websites that will be responsive 
				        on various types of devices.  By recognizing that your website is the key component of your digital brand 
				        we will integrate imagery and advanced technology to create a website as unique as your business.</p>
					</div>
				</div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">

				 <div class="panel">
					 <div class="panel-heading">
						<h3 class="panel-title myHeadings">Custom Stats</h3>
					</div>
					<div class="panel-body">
						<p>JuJu Gaming can create custom data displays and advanced alogorymths to back them.
					                We can even automate your daily data entries for you. We can make your data pop with 3d charts and graphs
					                that make sense for your business. Each Chart can display real time data about any stats your business needs to keep track of.
					                Each chart title, colors, labels, and look can be updated to mach your companies theme so you can give the 
					                right impression  when it matters most.</p>
					</div>
					<div class="panel-footer">Panel footer</div>
				</div>
            </div>
            <div class="col-lg-4">
            	<div class="panel">
					 <div class="panel-heading">
						<h3 class="panel-title myHeadings">Professional Look<br> Modern Technology</h3>
					</div>
					<div class="panel-body">
						<p>JuJu Gaming and Development  LLC is a full service digital company with experience 
						in building web and mobile applications that will meet and even exceed all our business 
						partner’s needs. Our goal is to design modern websites and to develop responsive software 
						that will help your company track and improve its internal goals year after year.  
						All of our designs are modern looking, mobile compatible, easy to maintain, user friendly and 
						based on the latest programing technology. </p>
					</div>
					<div class="panel-footer">Panel footer</div>
				</div>
            </div>
            <div class="col-lg-4">
            	<div class="panel">
					 <div class="panel-heading">
						<h3 class="panel-title myHeadings">Elastic, Agile, and Secure</h3>
					</div>
					<div class="panel-body">
						<p>JuJu Gaming and Development LLC builds custom websites and software systems for business 
						innovators of all sizes that will power those companies into the future.  As a professional 
						software development company you can trust us to provide you with with a well written code 
						base that is also secure.  All our programming is based on the most efficient platforms, the 
						most up to date programming language, and solid frameworks.  Through the use of creative 
						technical solutions you can be sure that  we will take care of all your website and software 
						needs from the initial concept to the final application.  </p>
					</div>
					<div class="panel-footer">Panel footer</div>
				</div>
            </div>
        </div>

		<?php echo ChartWidget::widget([]) ; ?> 
    </div>
</div>
