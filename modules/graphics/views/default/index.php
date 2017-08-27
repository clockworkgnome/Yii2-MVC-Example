<?php 
use yii\helpers\Url;
?>
<style>
#customIcons{
height:300px;
width:250px;
}
</style>
<div class="well"  id="customIcons">
<h2>Custom Icons</h2>  
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