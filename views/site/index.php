<?php
use app\components\ChartWidget;
use yii\helpers\Url;
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
				<div class="row">
					<div class="col-lg-10">
						<?php echo ChartWidget::widget([]) ; ?> 
					</div>
					<div class="col-lg-2">

                    <div class="panel">
        					 <div class="panel-heading">
        						<h3 class="panel-title myHeadings">Custom Icons</h3>
        					</div>
        					<div class="panel-body">
                              <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                  <li data-target="#myCarousel" data-slide-to="1"></li>
                                  <li data-target="#myCarousel" data-slide-to="2"></li>
                                   <li data-target="#myCarousel" data-slide-to="3"></li>
                                    <li data-target="#myCarousel" data-slide-to="4"></li>
                                </ol>
                            
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                  <div class="item active">
                                    <img src="<?= Url::base().'/img/customicons/confession.png' ?>" alt="Confession Icon" style="width:100%;">
                                  </div>
                            
                                  <div class="item">
                                    <img src="<?= Url::base().'/img/customicons/helpdesk.png' ?>" alt="Help Desk Icon" style="width:100%;">
                                  </div>
                                
                                  <div class="item">
                                    <img src="<?= Url::base().'/img/customicons/live.png' ?>" alt="Live Icon" style="width:100%;">
                                  </div>
                                  
                                   <div class="item">
                                    		<img src="<?= Url::base().'/img/customicons/notification.png' ?>" alt="Notification Icon" style="width:100%;">
                                    </div>
                                    
                                    <div class="item">
                                    		<img src="<?= Url::base().'/img/customicons/results.png' ?>" alt="Results Icon" style="width:100%;">
                                    </div>
                                </div>
                            
                                <!-- Left and right controls -->
                                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                  <span class="glyphicon glyphicon-chevron-left"></span>
                                  <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                  <span class="glyphicon glyphicon-chevron-right"></span>
                                  <span class="sr-only">Next</span>
                                </a>
                              </div>
                              </div>
                              </div>
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

		
    </div>
</div>
