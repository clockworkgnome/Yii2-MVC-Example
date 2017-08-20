<?php
namespace app\modules\konban\controllers;
use app\modules\konban\models\Projects;
use app\modules\konban\models\Items;
use app\modules\konban\models\ItemsStatus;
use yii;
use yii\web\Controller;
use yii\helpers\Url;

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
	
	public function actionRemoveproject(){
	    $myPID=$_REQUEST["pID"];
	    
	    Yii::$app->db->createCommand()->delete('projects', 'projectID ='.$myPID)->execute();
	    
	    Yii::$app->db->createCommand()->update('itemStatus', [
	        'projectID' => "-1",
	        'status' => "todo",
	        'catagory' => "",
	    ], "projectID=$myPID")->execute();
	    
	    Yii::$app->db->createCommand()->update('messages', [
	        'projectID' => "-1",
	    ], "projectID=$myPID")->execute();
	    
	    $mytodo=(new \yii\db\Query())
	    ->select(['*'])
	    ->from('itemStatus')
	    ->where(['status'=>'todo'])
	    ->all();
	    
	    foreach ($mytodo as $td){
	        
	        $todoItems = (new \yii\db\Query())
	        ->select(['*'])
	        ->from('items')
	        ->where(['itemID' => $td["itemID"]])
	        ->one();
	        
	        echo '<li id="'.$td["itemID"].'">
	            
<div class="panel panel-default">
    <div class="panel-heading" id="title'.$td["itemID"].'">
        '.$todoItems["title"].'
        <button type="button" class="btn btn-xs btn-danger  pull-right" onclick="removeitem('.$td["itemID"].')">
            <span class="glyphicon glyphicon-remove"></span>
        </button>
    </div>
            
    <div class="panel-body" style="background-color:'.$td["urgency"].';" id="content'.$td["itemID"].'">
        '.$todoItems["content"].'
    </div>
            
    <div class="panel-footer">
       <div class="btn-group" role="group" aria-label="options">
                <button type="button" class="btn btn-xs btn-primary" onclick="addMessage('.$td["itemID"].')">
                    <span class="glyphicon glyphicon-comment"></span>
                </button>
                    
                <button type="button" class="btn btn-xs btn-primary" onclick="viewMessage('.$td["itemID"].')">
                    <span class="glyphicon glyphicon-envelope"></span>
                </button>
                    
                <button type="button" class="btn btn-xs btn-primary" onclick="addTeam('.$td["itemID"].')">
                    <span class="glyphicon glyphicon-user"></span>
                </button>
                    
                <button type="button" class="btn btn-xs btn-primary" onclick="editItem('.$td["itemID"].')">
                    <span class="glyphicon glyphicon-pencil"></span>
                </button>
                    
                <button type="button" class="btn btn-xs btn-primary" onclick="viewItem('.$td["itemID"].')">
                    <span class="glyphicon glyphicon-fullscreen"></span>
                </button>
        </div>
    </div>
</div>
                    
								</li>';
	        
	    }
	}
	
	public function actionUpdateedititems(){
	    $myItem=$_REQUEST["myItemID"];
	    $myTitle=$_REQUEST["myTitle"];
	    $myContent=$_REQUEST["myContent"];
	    $myUrgency=$_REQUEST["myUrgency"];
	    Yii::$app->db->createCommand()->update('itemStatus', [
	        'urgency' => $myUrgency,
	    ], "itemID=$myItem")->execute();
	    Yii::$app->db->createCommand()->update('items', [
	        'title' => $myTitle,
	        'content' => $myContent,
	    ], "itemID=$myItem")->execute();
	    
	}
	
	public function actionRemoveitem(){
	    $myItem=$_REQUEST["itemID"];
	    // DELETE (table name, condition)
	    Yii::$app->db->createCommand()->delete('items', 'itemID ='.$myItem)->execute();
	    Yii::$app->db->createCommand()->delete('itemStatus', 'itemID ='.$myItem)->execute();
	    Yii::$app->db->createCommand()->delete('messages', 'itemID ='.$myItem)->execute();
	    echo "item removed";
	}
	
	public function actionGetitemdetails(){
	    $itemID=$_REQUEST["itemID"];
	    $myItem = (new \yii\db\Query())
	    ->select(['*'])
	    ->from('items')
	    ->where(['itemID' => $itemID])
	    ->one();
	    
	    $myStatus = (new \yii\db\Query())
	    ->select(['*'])
	    ->from('itemStatus')
	    ->where(['itemID' => $itemID])
	    ->one();
	    
	    echo $myStatus["catagory"]."---".$myStatus["urgency"]."---".$myItem["title"]."---".$myItem["content"];
	    
	}
	
	public function actionUpdateitem(){
		
		$itemID=$_REQUEST["itemID"];
		$projectID=$_REQUEST["projectID"];
		$catagory=$_REQUEST["catagory"];
		if($catagory=="todo"){
			if(Yii::$app->db->createCommand()->update('itemStatus', [
					'projectID' => '-1',
					'catagory'=>'',
					'status'=>$catagory
					
			], "itemID=$itemID")->execute()){
				echo "sucess";
			}else{
				echo "failed";
			}
			
		}elseif ($catagory=="done"){
			if(Yii::$app->db->createCommand()->update('itemStatus', [
					'projectID' => '-1',
					'catagory'=>'',
					'status'=>$catagory
					
			], "itemID=$itemID")->execute()){
				echo "sucess";
			}else{
				echo "failed";
			}
			
		}else{
			// UPDATE (table name, column values, condition)
			if(Yii::$app->db->createCommand()->update('itemStatus', ['projectID' => $projectID,'catagory'=>$catagory,'status'=>'doing'], "itemID=$itemID")->execute()){
				echo "success";
			}else{
				echo "failed";
			}
		}
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
				$myAbstract=$myItem->content;
				$myAbstract=substr($myAbstract,0,50);
				echo 'saved---'.$myStatus->catagory.$myStatus->projectID.'---
<li id="'.$myStatus->itemID.'">

<div class="panel panel-default">
    <div class="panel-heading" id="title'.$myStatus->itemID.'">
        '.$myItem->title.'
        <button type="button" class="btn btn-xs btn-danger  pull-right" onclick="removeitem('.$myStatus->itemID.')">
            <span class="glyphicon glyphicon-remove"></span>
        </button>
    </div>

    <div class="panel-body" style="background-color:'.$myStatus->urgency.';" id="content'.$myStatus->itemID.'">
        '.$myAbstract.'
    </div>

    <div class="panel-footer">
       <div class="btn-group" role="group" aria-label="options">
                <button type="button" class="btn btn-xs btn-primary" onclick="addMessage('.$myStatus->itemID.')">
                    <span class="glyphicon glyphicon-comment"></span>
                </button>

                <button type="button" class="btn btn-xs btn-primary" onclick="viewMessage('.$myStatus->itemID.')">
                    <span class="glyphicon glyphicon-envelope"></span>
                </button>

                <button type="button" class="btn btn-xs btn-primary" onclick="addTeam('.$myStatus->itemID.')">
                    <span class="glyphicon glyphicon-user"></span>
                </button>

                <button type="button" class="btn btn-xs btn-primary" onclick="editItem('.$myStatus->itemID.')">
                    <span class="glyphicon glyphicon-pencil"></span>
                </button>

                <button type="button" class="btn btn-xs btn-primary" onclick="viewItem('.$myStatus->itemID.')">
                    <span class="glyphicon glyphicon-fullscreen"></span>
                </button>
        </div>
    </div>
</div>
										
								</li>';

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
					<li id="project'.$model->getPrimaryKey().'">
        				<div class="panel panel-default">
                  			<div class="panel-heading">
                    			<span class="panel-title">
                    				<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                    				'.$model->name.'
                    			</span>
                            <button type="button" class="btn btn-xs btn-danger  pull-right" onclick="removeProject('.$model->getPrimaryKey().')">
                                <span class="glyphicon glyphicon-remove"></span>
                            </button>
							<button type="button" onclick="changeProjectID('.$model->getPrimaryKey().');" class="btn btn-xs pull-right" data-toggle="modal" data-target="#adddoingitem">
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
					          			  <ul id="Plan'.$model->getPrimaryKey().'" class="connectedSortable MyLists">
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
                                           <ul id="Develop'.$model->getPrimaryKey().'" class="connectedSortable MyLists">
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
                                           <ul id="Test'.$model->getPrimaryKey().'" class="connectedSortable MyLists">
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
					          			   <ul id="Deploy'.$model->getPrimaryKey().'" class="connectedSortable MyLists">
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

		    $( "#Plan'.$model->getPrimaryKey().',#Develop'.$model->getPrimaryKey().',#Test'.$model->getPrimaryKey().',#Deploy'.$model->getPrimaryKey().'" ).sortable({
    		    connectWith: ".connectedSortable",
    		    connectWith: ".connectedSortable",
    		    receive: function( event, ui ) {
					//console.log(event);
					//console.log(ui);
					//console.log("catagoryProjectNumber="+event.target.id);
					//console.log("itemID="+ui.item[0].id);
					var composit=event.target.id;
					var itemID=ui.item[0].id;
					var projectID = composit.replace( /^\D+/g, "");
					var catagory= composit.replace(/[0-9]/g, "");
					console.log("itemID"+itemID);
					console.log("projectID"+projectID);
					console.log("catagory"+catagory);
					
					$.ajax({
			          url: "'.Url::toRoute("/konban/default/updateitem").'",
			          data: {
			          "itemID":itemID,
			          "projectID":projectID,
			          "catagory":catagory,
			          },
			          context: document.body,
			          type: "GET",
			          success: function(data) {
							//do stuff with data
							console.log(data);
			          }
			        });
								
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