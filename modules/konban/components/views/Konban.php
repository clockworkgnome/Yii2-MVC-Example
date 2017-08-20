<?php 
//NOTES:
//The only element ID on this page with out a prefix should be an item!
// only item elements have pure integers for ID's 
use yii\helpers\Url;
$myDate= new dateTime();
$myDateString = $myDate->format('Y-m-d H:i');
?>
  <style>
  .padding-0{
    padding-right:0;
    padding-left:0;
}
.nopadds{
padding: 5px 0 15px 0;
}
.MyLists{
    border: 1px solid #eee;
    width: 100%;
    min-height: 20px;
    list-style-type: none;
    margin: 0;
    padding: 5px 0 0 0;
    float: left;
    margin-right: 10px;
  }
 .cardItem {
    margin: 0 5px 5px 5px;
    padding: 5px;
    font-size: 1.2em;
    width: 120px;
  }
  #pannelSort{
   list-style-type: none;
   margin: 0 0 0 0;
   padding: 5px;
  }
.ui-autocomplete {
  position: fixed;
  top: 100%;
  left: 0;
  z-index: 1051 !important;

}
  </style>
<?php 
//this will mak ethe list for javascript sortable connection
$mysortables="#todo, #done";
foreach($projects as $p) {
	$mysortables=$mysortables.", #Plan".$p["projectID"].","." #Develop".$p["projectID"].","." #Test".$p["projectID"].","." #Deploy".$p["projectID"];
}
?>
  <script>
  //this timer give the page time to load JUI.js
  setTimeout(function(){
	  //this function connects all the sortable lists on the page
	  $( function() {
		    $( "#pannelSort" ).sortable();
		    $( "#pannelSort" ).disableSelection();
		    //this will dynamically get all the ids of the item lists and connect them
		    $( "<?=$mysortables?>" ).sortable({
    		    connectWith: ".connectedSortable",
    		    receive: function( event, ui ) {
					//console.log(event);
					//console.log(ui);
					//console.log("catagoryProjectNumber="+event.target.id);
					//console.log("itemID="+ui.item[0].id);
					var composit=event.target.id;
					var itemID=ui.item[0].id;
					var projectID = composit.replace( /^\D+/g, '');
					var catagory= composit.replace(/[0-9]/g, '');
					console.log("itemID"+itemID);
					console.log("projectID"+projectID);
					console.log("catagory"+catagory);
					
					$.ajax({
			          url: "<?= Url::toRoute("/konban/default/updateitem")?>",
			          data: {
			          'itemID':itemID,
			          'projectID':projectID,
			          'catagory':catagory,
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
		  
 },500);
//this is the code for the add team mate button on create a new project modal
  function addTeamMember(){
	  var userName= $("#userlookup").val();
	  var currentTeam=$("#teamMembers").val();
	  console.log(userName);
	  $("#teamMembers").val(currentTeam+userName+",");
	  $("#userlookup").val("");
  }
  
  //this is the code for the project deadline date picker
    $( function() {
    	$( "#deadline" ).datepicker();
    	$( "#deadline" ).datepicker( "option", "dateFormat", "yy-mm-dd");
        
  } );
  //this is to set the project id when creating a new item
  function changeProjectID(myID){
	  $("#projectID").val(myID);
  }

  //this is the code to remove an item 
  function removeitem(itemID){
	  if(confirm("Are you sure you want to permanently delete this item?")){
        	  $.ajax({
                  url: "<?= Url::toRoute("/konban/default/removeitem")?>",
                  data: {
                  'itemID':itemID,
                  },
                  context: document.body,
                  type: "GET",
                  success: function(data) {
        				//do stuff with data
                	  		$("#"+itemID).remove();
        
                  }
                });
	  }
	  
  }
  
  //this is for the save item button on the doing section
  function saveDoingItem(){
	  //alert("I am here");
  		var doingitemstatus=$("#doingitemstatus").val();
  		var projectID=$("#projectID").val();
  		var doingitemcreated=$("#doingitemcreated").val();
  		var doingitemupdated=$("#doingitemupdated").val();
  		var doingitemownerID=$("#doingitemownerID").val();
  		var doingitemcatagory=$("#doingitemcatagory").val();
  		var doingitemurgency=$("#doingitemurgency").val();
  		var doingitemtitle=$("#doingitemtitle").val();
  		var doingitemcontent=$("#doingitemcontent").val();
  
  	$.ajax({
          url: "<?= Url::toRoute("/konban/default/adddoingitem")?>",
          data: {
          'doingitemstatus':doingitemstatus,
          'projectID':projectID,
          'doingitemcreated':doingitemcreated,
          'doingitemupdated':doingitemupdated,
          'doingitemownerID':doingitemownerID,
          'doingitemcatagory':doingitemcatagory,
          'doingitemurgency':doingitemurgency,
          'doingitemtitle':doingitemtitle,
          'doingitemcontent':doingitemcontent,
          },
          context: document.body,
          type: "GET",
          success: function(data) {
				//do stuff with data
				var mydata=data.split("---");
				if(mydata[0]==="saved"){
					$('#adddoingitem').modal('toggle');
					console.log('#'+mydata[1]);
					$('#'+mydata[1]).append(mydata[2]);
					
				}else{
					$('#doingItemErr').html("<p>"+data+"</p>");
				}
          }
        });
};
  
  
  //this is for the save button on the new projects form 
  function saveProject(){
	  //alert("I am here");
  	var myprojectName=$("#projectName").val();
  	var myteamMembers=$("#teamMembers").val();
  	var mydeadline=$("#deadline").val();
  	var mycreated=$("#created").val();
  
  	$.ajax({
          url: "<?= Url::toRoute("/konban/default/addproject")?>",
          data: {'projectName':myprojectName,'teamMembers':myteamMembers,'deadline':mydeadline,'created':mycreated},
          context: document.body,
          type: "GET",
          success: function(data) {
				//do stuff with data
				console.log("my string"+data.substring(0,5));
				if(data.substring(0,5)==="saved"){
					$('#addProjectMod').modal('toggle');
					$('#pannelSort').append(data);
				}else{
					$('#newProjectErr').html("<p>"+data+"</p>");
				}
          }
        });
};

//this is to populate and open the edit item modal 
function editItem(itemID){
  	$.ajax({
        url: "<?= Url::toRoute("/konban/default/getitemdetails")?>",
        data: {'itemID':itemID},
        context: document.body,
        type: "GET",
        success: function(data) {
        		var mydata=data.split("---");
        		$('#editItemDial').modal('toggle');
        		$('#edititemurgency').val(mydata[1]);
        		$('#edititemtitle').val(mydata[2]);
        		$('#edititemcontent').val(mydata[3]);
        		$('#edititemid').val(itemID);
        	
        }
      });
	
}
// this is the code to update the item in the update modal
function saveediteditem(){
	
	var myUrgency=$('#edititemurgency').val();
	var myTitle=$('#edititemtitle').val();
	var myContent=$('#edititemcontent').val();
	var myItemID=$('#edititemid').val();
	
  	$.ajax({
        url: "<?= Url::toRoute("/konban/default/updateedititems")?>",
        data: {'myItemID':myItemID,
        	'myUrgency':myUrgency,
        	'myTitle':myTitle,
        	'myContent':myContent,
            },
        context: document.body,
        type: "GET",
        success: function(data) {
            var myhead ='<button type="button" class="btn btn-xs btn-danger  pull-right" onclick="removeitem('+myItemID+')"><span class="glyphicon glyphicon-remove"></span></button>';
        		$('#editItemDial').modal('toggle');
        		$('#title'+myItemID).html(myTitle+myhead);
        		$('#content'+myItemID).css("background-color",myUrgency);
        		$('#content'+myItemID).html(myContent);
        }
      });
	
}

//this is the code for the remove project button
function removeProject(pID){
	  if(confirm("Are you sure you want to permanently delete this project?")){
    	  $.ajax({
              url: "<?= Url::toRoute("/konban/default/removeproject")?>",
              data: {
              'pID':pID,
              },
              context: document.body,
              type: "GET",
              success: function(data) {
    				//do stuff with data
            	  		$("#project"+pID).remove();
            	  		$("#todo").empty();
            	  		$("#todo").html(data);
    
              }
            });
  }
	
}

//this code is for the view item modal
function viewItem(itemID){
	$.ajax({
        url: "<?= Url::toRoute("/konban/default/getitemdetails")?>",
        data: {'itemID':itemID},
        context: document.body,
        type: "GET",
        success: function(data) {
        		var mydata=data.split("---");
        		$('#viewitemmodal').modal('toggle');
        		$('#viewitemcontent').css("background-color",mydata[1]);
        		$('#viewitemtitle').html(mydata[2]);
        		$('#viewitemcontent').html(mydata[3]);
        		
        	
        }
      });
	
}

  //this fuction is for the auto complete too look up team mates when creating a project
  $( function() {
	    var availableTags = <?= $userNamesList ?>;
	    $( "#userlookup" ).autocomplete({
	      source: availableTags
	    });
	  } );
  
  
  </script>
</head>
<body>
<!-- this is for ajax to load javascripts -->
<div id="myScripts"></div>

<!-- this is the veiw item modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="viewitemmodal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="viewitemtitle">Modal title</h4>
      </div>
      <div class="modal-body" id="viewitemcontent">
        <p>One fine body&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- This ends the view item modal -->

<!-- this is the modal to edit an item -->
<div class="modal fade" tabindex="-1" role="dialog" id="editItemDial">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Item</h4>
      </div>
      <div class="modal-body">
        <!-- this begins the form -->

  		<div class="form-group row">
  			<label for="edititemurgency" class="col-sm-4 col-md-4 col-lg-4 col-form-label">urgency:</label>
  			<div class="col-sm-8 col-md-8 col-lg-8 ">
    			<input class="form-control" type="color" id="edititemurgency" value="#FFFFFF">
  			</div>
		</div>
      	<div class="form-group row">
  			<label for="edititemtitle" class="col-sm-4 col-md-4 col-lg-4 col-form-label">Title:</label>
  			<div class="col-sm-8 col-md-8 col-lg-8 ">
    			<input class="form-control" type="text" id="edititemtitle">
  			</div>
		</div>
		<div class="form-group">
    		<label for="edititemcontent">Content:</label>
    		<textarea class="form-control" id="edititemcontent" rows="3"></textarea>
  		</div>

		<input type="hidden" id="edititemupdated" value="<?= $myDateString ?>">
		<input type="hidden" id="edititemid" value="<?= $myDateString ?>">
		
		<div id="editItemErr"></div>
			<!-- this ends the form -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="editItemSave" onclick="saveediteditem()"><span class="glyphicon glyphicon-floppy-disk"></span> Save Item</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- new project Modal -->
<div class="modal fade" id="addProjectMod" tabindex="-1" role="dialog" aria-labelledby="AddProjectlabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="AddProjectlabel">Add Project</h4>
      </div>
      <div class="modal-body">
      	<!-- this begins the form -->
      	<div class="form-group row">
  			<label for="projectName" class="col-sm-4 col-md-4 col-lg-4 col-form-label">Project Name:</label>
  			<div class="col-sm-8 col-md-8 col-lg-8 ">
    			<input class="form-control" type="text" id="projectName">
  			</div>
		</div>
		<div class="form-group row">
  			<label for="userlookup" class="col-sm-4 col-md-4 col-lg-4  col-form-label"><span class="glyphicon glyphicon-search"></span> Lookup User:</label>
  			<div class="col-sm-6 col-md-6 col-lg-6 ">
    			<input class="form-control" type="text" id="userlookup">
    		</div>
  			<div class="col-sm-2 col-md-2 col-lg-2 ">
  				<button type="button" class="btn btn-primary" onclick="addTeamMember()"><span class="glyphicon glyphicon-plus"></span> Add</button>
  			</div>
		</div>
		<div class="form-group row">
  			<label for="teamMembers" class="col-sm-4 col-md-4 col-lg-4 col-form-label">Team Members:</label>
  			<div class="col-sm-8 col-md-8 col-lg-8 ">
    			<input class="form-control" type="text" id="teamMembers">
  			</div>
		</div>
		<div class="form-group row">
  			<label for="deadline" class="col-sm-4 col-md-4 col-lg-4 col-form-label">Deadline:</label>
  			<div class="col-sm-8 col-md-8 col-lg-8 ">
    			<input class="form-control" type="text" id="deadline">
  			</div>
		</div>
		<input type="hidden" id="created" value="<?= $myDateString ?>">
		<div id="newProjectErr"></div>
			<!-- this ends the form -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="newProjectSave" onclick="saveProject()"><span class="glyphicon glyphicon-floppy-disk"></span> Save Project</button>
      </div>
    </div>
  </div>
</div>
<!-- end new project Modal -->
<!-- new item Modal -->
<div class="modal fade" id="adddoingitem" tabindex="-1" role="dialog" aria-labelledby="additemlabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="additemlabel">Add Item</h4>
      </div>
      <div class="modal-body">
      	<!-- this begins the form -->
      	<div class="form-group">
    		<label for="catagory">Select a catagory:</label>
    		<select class="form-control" id="doingitemcatagory">
      			<option>Plan</option>
      			<option>Develop</option>
      			<option>Test</option>
      			<option>Deploy</option>
    		</select>
  		</div>
  		<div class="form-group row">
  			<label for="urgency" class="col-sm-4 col-md-4 col-lg-4 col-form-label">urgency:</label>
  			<div class="col-sm-8 col-md-8 col-lg-8 ">
    			<input class="form-control" type="color" id="doingitemurgency" value="#FFFFFF">
  			</div>
		</div>
      	<div class="form-group row">
  			<label for="title" class="col-sm-4 col-md-4 col-lg-4 col-form-label">Title:</label>
  			<div class="col-sm-8 col-md-8 col-lg-8 ">
    			<input class="form-control" type="text" id="doingitemtitle">
  			</div>
		</div>
		<div class="form-group">
    		<label for="content">Content:</label>
    		<textarea class="form-control" id="doingitemcontent" rows="3"></textarea>
  		</div>
  		<input type="hidden" id="doingitemstatus" value="doing">
		<input type="hidden" id="projectID" value="">
		<input type="hidden" id="doingitemcreated" value="<?= $myDateString ?>">
		<input type="hidden" id="doingitemupdated" value="<?= $myDateString ?>">
		<input type="hidden" id="doingitemownerID" value="<?php echo Yii::$app->user->id;?>">
		
		<div id="doingItemErr"></div>
			<!-- this ends the form -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="newProjectSave" onclick="saveDoingItem()"><span class="glyphicon glyphicon-floppy-disk"></span> Save Item</button>
      </div>
    </div>
  </div>
</div>
<!-- end new item Modal -->
<div class="row">
	<!-- this is the todo pannel -->
	<div class="col-sm-2 col-md-2 col-lg-2 padding-0">
		<div class="panel panel-default">
  			<div class="panel-heading">
    			<h3 class="panel-title">To Do</h3>
  			</div>
          	<div class="panel-body">

                <ul id="todo" class="connectedSortable MyLists">
					<?php 
						foreach ($mytodo as $td){
							
							$todoItems = (new \yii\db\Query())
							->select(['*'])
							->from('items')
							->where(['itemID' => $td["itemID"]])
							->one();
							$myAbstract=$todoItems["content"];
							$myAbstract=substr($myAbstract,0,50);
							
							echo '<li id="'.$td["itemID"].'">

<div class="panel panel-default">
    <div class="panel-heading" id="title'.$td["itemID"].'">
        '.$todoItems["title"].'
        <button type="button" class="btn btn-xs btn-danger  pull-right" onclick="removeitem('.$td["itemID"].')">
            <span class="glyphicon glyphicon-remove"></span>
        </button>
    </div>

    <div class="panel-body" style="background-color:'.$td["urgency"].';" id="content'.$td["itemID"].'">
        '.$myAbstract.'
    </div>

    <div class="panel-footer">
       <div class="btn-group" role="group" aria-label="options">
                <button id="addMessageButton'.$td["itemID"].'" type="button" class="btn btn-xs btn-primary">
                    <span class="glyphicon glyphicon-comment"></span>
                </button>

                <button id="viewMessageButton'.$td["itemID"].'" type="button" class="btn btn-xs btn-primary">
                    <span class="glyphicon glyphicon-envelope"></span>
                </button>

                <button id="addTeamButton'.$td["itemID"].'" type="button" class="btn btn-xs btn-primary">
                    <span class="glyphicon glyphicon-user"></span>
                </button>

                <button id="editItemButton'.$td["itemID"].'" type="button" class="btn btn-xs btn-primary">
                    <span class="glyphicon glyphicon-pencil"></span>
                </button>

                <button id="viewItemButton'.$td["itemID"].'" type="button" class="btn btn-xs btn-primary">
                    <span class="glyphicon glyphicon-fullscreen"></span>
                </button>
        </div>
        <script>
            $("#addMessageButton'.$td["itemID"].'").on("click", addMessage('.$td["itemID"].'));
            $("#viewMessageButton'.$td["itemID"].'").on("click", viewMessage('.$td["itemID"].'));
            $("#addTeamButton'.$td["itemID"].'").on("click", addTeam('.$td["itemID"].'));
            $("#editItemButton'.$td["itemID"].'").on("click", editItem('.$td["itemID"].'));
            $("#viewItemButton'.$td["itemID"].'").on("click", viewItem('.$td["itemID"].'));
        </script>
    </div>
</div>
										
								</li>';
							
						}
					?>
                </ul>
 
          	</div>
		</div>
	</div>
	<!-- this is the doing pannel -->
	<div class="col-sm-8 col-md-8 col-lg-8 padding-0">
	
		<div class="panel panel-default">
  			<div class="panel-heading nopadds" id="doinghead">
    			<span class="panel-title">Doing</span>
    			<button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#addProjectMod">
      				<span class="glyphicon glyphicon-file"></span> New Project
    			</button>
  			</div>
          	<div class="panel-body">
          		<!-- This begins the sortable pannels -->
          		<ul id="pannelSort">
          			<?php 
          			foreach($projects as $p) {
          				//var_dump($p);
          				
          				echo'
					<li id="project'.$p["projectID"].'">
        				<div class="panel panel-default">
                  			<div class="panel-heading">
                    			<span class="panel-title">
                    				<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                    				'.$p["name"].'
                    			</span>
                            <button type="button" class="btn btn-xs btn-danger  pull-right" onclick="removeProject('.$p["projectID"].')">
                                <span class="glyphicon glyphicon-remove"></span>
                            </button>
							<button type="button" onclick="changeProjectID('.$p["projectID"].');" class="btn btn-xs pull-right" data-toggle="modal" data-target="#adddoingitem">
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
                                          <div class="panel-body">';
					          				$plans = (new \yii\db\Query())
					          				->select(['itemID','urgency'])
					          				->from('itemStatus')
					          				->where(['projectID' => $p["projectID"],'catagory'=>'Plan','status'=>'doing'])
					          				->all();
					          		echo '<ul id="Plan'.$p["projectID"].'" class="connectedSortable MyLists">';
					          				
					          				foreach($plans as $pl){
					          					//var_dump($pl);
					          					$planItems = (new \yii\db\Query())
					          					->select(['*'])
					          					->from('items')
					          					->where(['itemID' => $pl["itemID"]])
					          					->one();
					          					$myAbstract=$planItems["content"];
					          					$myAbstract=substr($myAbstract,0,50);
					          					echo '<li id="'.$pl["itemID"].'">
			              
<div class="panel panel-default">
    <div class="panel-heading" id="title'.$pl["itemID"].'">
        '.$planItems["title"].'
        <button type="button" class="btn btn-xs btn-danger  pull-right" onclick="removeitem('.$pl["itemID"].')">
            <span class="glyphicon glyphicon-remove"></span>
        </button>
    </div>
							    
    <div class="panel-body" style="background-color:'.$pl["urgency"].';" id="content'.$pl["itemID"].'">
        '.$myAbstract.'
    </div>
      
    <div class="panel-footer">
       <div class="btn-group" role="group" aria-label="options">
                <button type="button" class="btn btn-xs btn-primary" onclick="addMessage('.$pl["itemID"].')">
                    <span class="glyphicon glyphicon-comment"></span>
                </button>
      
                <button type="button" class="btn btn-xs btn-primary" onclick="viewMessage('.$pl["itemID"].')">
                    <span class="glyphicon glyphicon-envelope"></span>
                </button>
      
                <button type="button" class="btn btn-xs btn-primary" onclick="addTeam('.$pl["itemID"].')">
                    <span class="glyphicon glyphicon-user"></span>
                </button>
	      
                <button type="button" class="btn btn-xs btn-primary" onclick="editItem('.$pl["itemID"].')">
                    <span class="glyphicon glyphicon-pencil"></span>
                </button>
                      
                <button type="button" class="btn btn-xs btn-primary" onclick="viewItem('.$pl["itemID"].')">
                    <span class="glyphicon glyphicon-fullscreen"></span>
                </button>
        </div>
    </div>
</div>
                      
								</li>';
					          					
					          					}
					
                           	 echo '       </ul>
										</div>
                                        </div>
                                    </div>
    								<!--catagorie end -->
    								<!--catagorie start -->
                              		<div class="col-sm-3 col-md-3 col-lg-3 padding-0">
        								<div class="panel panel-default">
                                          <div class="panel-heading">Develop</div>
                                          <div class="panel-body">';
					          				$plans = (new \yii\db\Query())
					          				->select(['itemID','urgency'])
					          				->from('itemStatus')
					          				->where(['projectID' => $p["projectID"],'catagory'=>'Develop','status'=>'doing'])
					          				->all();
					          		echo '<ul id="Develop'.$p["projectID"].'" class="connectedSortable MyLists">';
					          				
					          				foreach($plans as $pl){
					          					//var_dump($pl);
					          					$planItems = (new \yii\db\Query())
					          					->select(['*'])
					          					->from('items')
					          					->where(['itemID' => $pl["itemID"]])
					          					->one();
					          					$myAbstract=$planItems["content"];
					          					$myAbstract=substr($myAbstract,0,50);
					          					echo '<li id="'.$pl["itemID"].'">
				    
<div class="panel panel-default">
    <div class="panel-heading" id="title'.$pl["itemID"].'">
        '.$planItems["title"].'
        <button type="button" class="btn btn-xs btn-danger  pull-right" onclick="removeitem('.$pl["itemID"].')">
            <span class="glyphicon glyphicon-remove"></span>
        </button>
    </div>
            
    <div class="panel-body" style="background-color:'.$pl["urgency"].';" id="content'.$pl["itemID"].'">
        '.$myAbstract.'
    </div>
  	    
    <div class="panel-footer">
       <div class="btn-group" role="group" aria-label="options">
                <button type="button" class="btn btn-xs btn-primary" onclick="addMessage('.$pl["itemID"].')">
                    <span class="glyphicon glyphicon-comment"></span>
                </button>
              
                <button type="button" class="btn btn-xs btn-primary" onclick="viewMessage('.$pl["itemID"].')">
                    <span class="glyphicon glyphicon-envelope"></span>
                </button>
				    
                <button type="button" class="btn btn-xs btn-primary" onclick="addTeam('.$pl["itemID"].')">
                    <span class="glyphicon glyphicon-user"></span>
                </button>
            
                <button type="button" class="btn btn-xs btn-primary" onclick="editItem('.$pl["itemID"].')">
                    <span class="glyphicon glyphicon-pencil"></span>
                </button>
	          
                <button type="button" class="btn btn-xs btn-primary" onclick="viewItem('.$pl["itemID"].')">
                    <span class="glyphicon glyphicon-fullscreen"></span>
                </button>
        </div>
    </div>
</div>
    
								</li>';
					          					
					          					}
					
                           	 echo '       </ul>

                                          </div>
                                        </div>
                                    </div>
    								<!--catagorie end -->
    								<!--catagorie start -->
                              		<div class="col-sm-3 col-md-3 col-lg-3 padding-0">
        								<div class="panel panel-default">
                                          <div class="panel-heading">Test</div>
                                          <div class="panel-body">';
					          				$plans = (new \yii\db\Query())
					          				->select(['itemID','urgency'])
					          				->from('itemStatus')
					          				->where(['projectID' => $p["projectID"],'catagory'=>'Test','status'=>'doing'])
					          				->all();
					          		echo '<ul id="Test'.$p["projectID"].'" class="connectedSortable MyLists">';
					          				
					          				foreach($plans as $pl){
					          					//var_dump($pl);
					          					$planItems = (new \yii\db\Query())
					          					->select(['*'])
					          					->from('items')
					          					->where(['itemID' => $pl["itemID"]])
					          					->one();
					          					$myAbstract=$planItems["content"];
					          					$myAbstract=substr($myAbstract,0,50);
					          					echo '<li id="'.$pl["itemID"].'">
  			    
<div class="panel panel-default">
    <div class="panel-heading" id="title'.$pl["itemID"].'">
        '.$planItems["title"].'
        <button type="button" class="btn btn-xs btn-danger  pull-right" onclick="removeitem('.$pl["itemID"].')">
            <span class="glyphicon glyphicon-remove"></span>
        </button>
    </div>
		    
    <div class="panel-body" style="background-color:'.$pl["urgency"].';" id="content'.$pl["itemID"].'">
        '.$myAbstract.'
    </div>
            
    <div class="panel-footer">
       <div class="btn-group" role="group" aria-label="options">
                <button type="button" class="btn btn-xs btn-primary" onclick="addMessage('.$pl["itemID"].')">
                    <span class="glyphicon glyphicon-comment"></span>
                </button>
            
                <button type="button" class="btn btn-xs btn-primary" onclick="viewMessage('.$pl["itemID"].')">
                    <span class="glyphicon glyphicon-envelope"></span>
                </button>
      
                <button type="button" class="btn btn-xs btn-primary" onclick="addTeam('.$pl["itemID"].')">
                    <span class="glyphicon glyphicon-user"></span>
                </button>
            
                <button type="button" class="btn btn-xs btn-primary" onclick="editItem('.$pl["itemID"].')">
                    <span class="glyphicon glyphicon-pencil"></span>
                </button>
    		    
                <button type="button" class="btn btn-xs btn-primary" onclick="viewItem('.$pl["itemID"].')">
                   <span class="glyphicon glyphicon-fullscreen"></span>
                </button>
        </div>
    </div>
</div>
      			    
								</li>';
					          					
					          					}
					
                           	 echo '       </ul>

                                          </div>
                                        </div>
                                    </div>
    								<!--catagorie end -->
    								<!--catagorie start -->
                              		<div class="col-sm-3 col-md-3 col-lg-3 padding-0">
        								<div class="panel panel-default">
                                          <div class="panel-heading">Deploy</div>
                                          <div class="panel-body">';
					          				$plans = (new \yii\db\Query())
					          				->select(['itemID','urgency'])
					          				->from('itemStatus')
					          				->where(['projectID' => $p["projectID"],'catagory'=>'Deploy','status'=>'doing'])
					          				->all();
					          		echo '<ul id="Deploy'.$p["projectID"].'" class="connectedSortable MyLists">';
					          				
					          				foreach($plans as $pl){
					          					//var_dump($pl);
					          					$planItems = (new \yii\db\Query())
					          					->select(['*'])
					          					->from('items')
					          					->where(['itemID' => $pl["itemID"]])
					          					->one();
					          					$myAbstract=$planItems["content"];
					          					$myAbstract=substr($myAbstract,0,50);
					          					echo '<li id="'.$pl["itemID"].'">
    
<div class="panel panel-default">
    <div class="panel-heading" id="title'.$pl["itemID"].'">
        '.$planItems["title"].'
        <button type="button" class="btn btn-xs btn-danger  pull-right" onclick="removeitem('.$pl["itemID"].')">
            <span class="glyphicon glyphicon-remove"></span>
        </button>
    </div>
    			    
    <div class="panel-body" style="background-color:'.$pl["urgency"].';" id="content'.$pl["itemID"].'">
        '.$myAbstract.'
    </div>
							    
    <div class="panel-footer">
       <div class="btn-group" role="group" aria-label="options">
                <button type="button" class="btn btn-xs btn-primary" onclick="addMessage('.$pl["itemID"].')">
                    <span class="glyphicon glyphicon-comment"></span>
                </button>
        
                <button type="button" class="btn btn-xs btn-primary" onclick="viewMessage('.$pl["itemID"].')">
                    <span class="glyphicon glyphicon-envelope"></span>
                </button>
                
                <button type="button" class="btn btn-xs btn-primary" onclick="addTeam('.$pl["itemID"].')">
                    <span class="glyphicon glyphicon-user"></span>
                </button>
           
                <button type="button" class="btn btn-xs btn-primary" onclick="editItem('.$pl["itemID"].')">
                    <span class="glyphicon glyphicon-pencil"></span>
                </button>
                    
                <button type="button" class="btn btn-xs btn-primary" onclick="viewItem('.$pl["itemID"].')">
                    <span class="glyphicon glyphicon-fullscreen"></span>
                </button>
        </div>
    </div>
</div>
                    
								</li>';
					          					
					          					}
					
                           	 echo '       </ul>

                                          </div>
                                        </div>
                                    </div>
    								<!--catagorie end -->
								</div>
								<!--end project catagories -->
								<!--project details-->
								<div class="row">
									<span class="well"> Created:'.$p["dateCreated"].'</span>
									<span class="well"> Due:'.$p["deadline"].'</span>
									<span class="well">Project Members:'.$p["members"].'</span>
								</div>
                          	</div>
                		</div>
            		</li>
            		<!-- end project pannel -->






';
          					
          			}
          			?>
    				<!-- this is a project pannel 
    				<li>
        				<div class="panel panel-default">
                  			<div class="panel-heading">
                    			<h3 class="panel-title">
                    			<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                    			project1
                    			</h3>
                  			</div>
                          	<div class="panel-body">
                          		<!--project catagories 
                          		<div class="row">
                          		
                              		<!--catagorie start 
                              		<div class="col-sm-3 col-md-3 col-lg-3 padding-0">
        								<div class="panel panel-default">
                                          <div class="panel-heading">Plan</div>
                                          <div class="panel-body">
                                             <ul id="sortable2" class="connectedSortable MyLists">
                                              <li class="ui-state-default cardItem">Item 1</li>
                                              <li class="ui-state-default cardItem">Item 2</li>
                                              <li class="ui-state-default cardItem">Item 3</li>
                                              <li class="ui-state-default cardItem">Item 4</li>
                                              <li class="ui-state-default cardItem">Item 5</li>
                                            </ul>
                                          </div>
                                        </div>
                                    </div>
    								<!--catagorie end 
    								<!--catagorie start 
                              		<div class="col-sm-3 col-md-3 col-lg-3 padding-0">
        								<div class="panel panel-default">
                                          <div class="panel-heading">Develop</div>
                                          <div class="panel-body">
                                            <ul id="sortable3" class="connectedSortable MyLists">
                                             <li class="ui-state-default cardItem">Item 1</li>
                                             <li class="ui-state-default cardItem">Item 2</li>
                                             <li class="ui-state-default cardItem">Item 3</li>
                                             <li class="ui-state-default cardItem">Item 4</li>
                                             <li class="ui-state-default cardItem">Item 5</li>
                                            </ul>
                                          </div>
                                        </div>
                                    </div>
    								<!--catagorie end 
    								<!--catagorie start 
                              		<div class="col-sm-3 col-md-3 col-lg-3 padding-0">
        								<div class="panel panel-default">
                                          <div class="panel-heading">Test</div>
                                          <div class="panel-body">
                                            <ul id="sortable4" class="connectedSortable MyLists">
                                             <li class="ui-state-default cardItem">Item 1</li>
                                             <li class="ui-state-default cardItem">Item 2</li>
                                             <li class="ui-state-default cardItem">Item 3</li>
                                             <li class="ui-state-default cardItem">Item 4</li>
                                             <li class="ui-state-default cardItem">Item 5</li>
                                            </ul>
                                          </div>
                                        </div>
                                    </div>
    								<!--catagorie end 
    								<!--catagorie start 
                              		<div class="col-sm-3 col-md-3 col-lg-3 padding-0">
        								<div class="panel panel-default">
                                          <div class="panel-heading">Deploy</div>
                                          <div class="panel-body">
                                            <ul id="sortable5" class="connectedSortable MyLists">
                                             <li class="ui-state-default cardItem">Item 1</li>
                                             <li class="ui-state-default cardItem">Item 2</li>
                                             <li class="ui-state-default cardItem">Item 3</li>
                                             <li class="ui-state-default cardItem">Item 4</li>
                                             <li class="ui-state-default cardItem">Item 5</li>
                                            </ul>
                                          </div>
                                        </div>
                                    </div>
    								<!--catagorie end 
								</div>
								<!--end project catagories 
                          	</div>
                		</div>
            		</li>
            		<!-- end project pannel -->
            		
            		
 				</ul>
 				<!-- This ends the sortable pannels -->
          	</div>
		</div>
	</div>
	
	<!-- this is the done pannel -->
	<div class="col-sm-2 col-md-2 col-lg-2 padding-0">
		<div class="panel panel-default">
  			<div class="panel-heading">
    			<h3 class="panel-title">Done</h3>
  			</div>
          	<div class="panel-body">
            	  <ul id="done" class="connectedSortable MyLists">
					<?php
					foreach ($mydone as $d){
						
						$doneItems = (new \yii\db\Query())
						->select(['*'])
						->from('items')
						->where(['itemID' => $d["itemID"]])
						->one();
						$myAbstract=$doneItems["content"];
						$myAbstract=substr($myAbstract,0,50);

						echo '<li id="'.$d["itemID"].'">
        
<div class="panel panel-default">
    <div class="panel-heading" id="title'.$d["itemID"].'">
        '.$doneItems["title"].'
        <button type="button" class="btn btn-xs btn-danger  pull-right" onclick="removeitem('.$d["itemID"].')">
            <span class="glyphicon glyphicon-remove"></span>
        </button>
    </div>
        
    <div class="panel-body" style="background-color:'.$d["urgency"].';" id="content'.$d["itemID"].'">
        '.$myAbstract.'
    </div>
      
    <div class="panel-footer">
       <div class="btn-group" role="group" aria-label="options">
                <button type="button" class="btn btn-xs btn-primary" onclick="addMessage('.$d["itemID"].')">
                    <span class="glyphicon glyphicon-comment"></span>
                </button>
	    
                <button type="button" class="btn btn-xs btn-primary" onclick="viewMessage('.$d["itemID"].')">
                    <span class="glyphicon glyphicon-envelope"></span>
                </button>
	      
                <button type="button" class="btn btn-xs btn-primary" onclick="addTeam('.$d["itemID"].')">
                    <span class="glyphicon glyphicon-user"></span>
                </button>
		        
                <button type="button" class="btn btn-xs btn-primary" onclick="editItem('.$d["itemID"].')">
                    <span class="glyphicon glyphicon-pencil"></span>
                </button>
					    
                <button type="button" class="btn btn-xs btn-primary" onclick="viewItem('.$d["itemID"].')">
                    <span class="glyphicon glyphicon-fullscreen"></span>
                </button>
        </div>
    </div>
</div>
					    
								</li>';
						
					}
				
					?>
                </ul>
          	</div>
		</div>
	</div>
	
</div>
 
 
</body>
</html>