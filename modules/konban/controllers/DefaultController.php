<?php
namespace app\modules\konban\controllers;
use app\modules\konban\models\Projects;
use app\modules\konban\models\Items;
use app\modules\konban\models\ItemsStatus;

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
	
	public function actionAdddoingitem(){
		$myItem= new Items();
		$myStatus= new ItemsStatus();

		$myItem->created=$_REQUEST["doingitemcreated"];
		$myItem->updated=$_REQUEST["doingitemupdated"];
		$myItem->ownerID=$_REQUEST["doingitemownerID"];
		$myItem->title=$_REQUEST["doingitemtitle"];
		$myItem->content=$_REQUEST["doingitemcontent"];
		
		if($myItem->validate()){
			$myItem->save();
			//echo "my key is ".$myItem->getPrimaryKey();
			$myStatus->itemID=$myItem->getPrimaryKey();
			$myStatus->status=$_REQUEST["doingitemstatus"];
			$myStatus->projectID=$_REQUEST["projectID"];
			$myStatus->catagory=$_REQUEST["doingitemcatagory"];
			$myStatus->urgency=$_REQUEST["doingitemurgency"];
			if($myStatus->validate()){
				$myStatus->save();
				echo 'saved,'.strtolower($myStatus->catagory).$myStatus->projectID.',
				<li class="ui-state-default cardItem" id="'.$myStatus->itemID.'">
					'.$myItem->content.'
				</li>

';
			}else{
				$errors = $myStatus->errors;
				foreach ($errors as $key=>$value){
					for($i=0;$i<count($value);$i++){
						echo $value[$i];
					}
				}
				
			}
			
		}else{
			$errors = $myItem->errors;
			foreach ($errors as $key=>$value){
				for($i=0;$i<count($value);$i++){
					echo $value[$i];
				}
			}
			
		}
		

		
		
	}
	
	public function actionAddproject(){
		$model= new Projects();

		$model->name=$_REQUEST["projectName"];
		$model->members=$_REQUEST["teamMembers"];
		$model->deadline=$_REQUEST["deadline"];
		$model->dateCreated=$_REQUEST["created"];
		$model->isNewRecord=true;
		
		if($model->validate()){
			$model->save();
			echo 'saved
					<li>
        				<div class="panel panel-default">
                  			<div class="panel-heading">
                    			<span class="panel-title">
                    				<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                    				'.$model->name.'
                    			</span>
								<button type="button" onclick="changeProjectID('.$model->getPrimaryKey().');" class="btn btn-default pull-right" data-toggle="modal" data-target="#adddoingitem">
      								<span class="glyphicon glyphicon-list-alt"></span> Add Item
    							</button>
                  			</div>
                          	<div class="panel-body">
                          		<!--project catagories -->
								
                          		<div class="row">
                          		
                              		<!--catagorie start -->
                              		<div class="col-sm-3 col-md-3 col-lg-3 padding-0">
        								<div class="panel panel-default">
                                          <div class="panel-heading">Plan</div>
                                          <div class="panel-body">
					          				<ul id="plan'.$model->getPrimaryKey().'" class="connectedSortable MyLists">
											</ul>
										</div>
                                        </div>
                                    </div>
    								<!--catagorie end -->
    								<!--catagorie start -->
                              		<div class="col-sm-3 col-md-3 col-lg-3 padding-0">
        								<div class="panel panel-default">
                                          <div class="panel-heading">Develop</div>
                                          <div class="panel-body">
											<ul id="develop'.$model->getPrimaryKey().'" class="connectedSortable MyLists">
											</ul>
                                          </div>
                                        </div>
                                    </div>
    								<!--catagorie end -->
    								<!--catagorie start -->
                              		<div class="col-sm-3 col-md-3 col-lg-3 padding-0">
        								<div class="panel panel-default">
                                          <div class="panel-heading">Test</div>
                                          <div class="panel-body">
											<ul id="test'.$model->getPrimaryKey().'" class="connectedSortable MyLists">
											</ul>
                                          </div>
                                        </div>
                                    </div>
    								<!--catagorie end -->
    								<!--catagorie start -->
                              		<div class="col-sm-3 col-md-3 col-lg-3 padding-0">
        								<div class="panel panel-default">
                                          <div class="panel-heading">Deploy</div>
                                          <div class="panel-body">
											<ul id="deploy'.$model->getPrimaryKey().'" class="connectedSortable MyLists">
											</ul>
                                          </div>
                                        </div>
                                    </div>
    								<!--catagorie end -->
								</div>
								<!--end project catagories -->
								<!--project details-->
								<div class="row">
									<span class="well"> Created:'.$model->dateCreated.'</span>
									<span class="well"> Due:'.$model->deadline.'</span>
									<span class="well">Project Members:'.$model->members.'</span>
								</div>
                          	</div>
                		</div>
            		</li>
            		<!-- end project pannel -->
<script>
$( function() {

		    $( "#plan'.$model->getPrimaryKey().',#develop'.$model->getPrimaryKey().',#test'.$model->getPrimaryKey().',#deploy'.$model->getPrimaryKey().'" ).sortable({
    		    connectWith: ".connectedSortable",
    		    receive: function( event, ui ) {
					console.log(event);
					alert(event.target.id);
					console.log(ui);
        		    }
		    }).disableSelection();
		  } );
</script>




';
		}else{
			$errors = $model->errors;
			foreach ($errors as $key=>$value){
				for($i=0;$i<count($value);$i++){
					echo $value[$i];
				}
			}
				
		}

	}
}