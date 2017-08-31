<?php 
use yii\helpers\Url;
?>
<style>
#customIcons{
height:300px;
width:250px;
}
</style>
<div class="row">
<div class="col-lg-3">
<div class="well"  id="customIcons">
<h2>Graphics</h2>  
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
  
  
  <div class="col-lg-9">
  <div class="well"  id="earlyProjects">
<h2>Projects from 2004 to 2017</h2>  
  <div id="myCarousel2" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel2" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel2" data-slide-to="1"></li>
      <li data-target="#myCarousel2" data-slide-to="2"></li>
       <li data-target="#myCarousel2" data-slide-to="3"></li>
       <li data-target="#myCarousel2" data-slide-to="4"></li>
       <li data-target="#myCarousel2" data-slide-to="5"></li>
       <li data-target="#myCarousel2" data-slide-to="6"></li>
       <li data-target="#myCarousel2" data-slide-to="7"></li>
       <li data-target="#myCarousel2" data-slide-to="8"></li>
       <li data-target="#myCarousel2" data-slide-to="9"></li>
       <li data-target="#myCarousel2" data-slide-to="10"></li>

    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="<?= Url::base().'/img/screenshots/chiro1.png' ?>" alt="Chiropractor Site1" style="width:100%;">
      </div>

      <div class="item">
        <img src="<?= Url::base().'/img/screenshots/chiro2.png' ?>" alt="Chiropractor Site2" style="width:100%;">
      </div>
    
      <div class="item">
        <img src="<?= Url::base().'/img/screenshots/chiro3.png' ?>" alt="Chiropractor Site3" style="width:100%;">
      </div>
      
       <div class="item">
        		<img src="<?= Url::base().'/img/screenshots/ops1.png' ?>" alt="Chiropractor Site4" style="width:100%;">
        </div>
               <div class="item">
        		<img src="<?= Url::base().'/img/screenshots/ops2.png' ?>" alt="opstel dash" style="width:100%;">
        </div>
               <div class="item">
        		<img src="<?= Url::base().'/img/screenshots/ops3.png' ?>" alt="opstel dash" style="width:100%;">
        </div>
               <div class="item">
        		<img src="<?= Url::base().'/img/screenshots/ops4.png' ?>" alt="opstel dash" style="width:100%;">
        </div>
               <div class="item">
        		<img src="<?= Url::base().'/img/screenshots/ops5.png' ?>" alt="opstel dash" style="width:100%;">
        </div>
               <div class="item">
        		<img src="<?= Url::base().'/img/screenshots/ops6.png' ?>" alt="opstel dash" style="width:100%;">
        </div>
               <div class="item">
        		<img src="<?= Url::base().'/img/screenshots/ops7.png' ?>" alt="opstel dash" style="width:100%;">
        </div>
                       <div class="item">
        		<img src="<?= Url::base().'/img/screenshots/cscpromo.png' ?>" alt="Custom Specialties Company" style="width:100%;">
        </div>
        
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel2" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel2" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  </div>
  </div>
  </div>