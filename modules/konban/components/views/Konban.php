<?php 

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
    width: 142px;
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

  <script>
  //this timer give the page time to load JUI.js
  setTimeout(function(){
	  //this function connects all the sortable lists on the page
	  $( function() {
		    $( "#pannelSort" ).sortable();
		    $( "#pannelSort" ).disableSelection();
		    //this will dynamically get all the ids of the item lists and connect them
		    $( "#sortable1, #sortable2, #sortable3, #sortable4, #sortable5, #sortable6, #sortable7, #sortable8, #sortable9, #sortable10" ).sortable({
    		    connectWith: ".connectedSortable",
    		    receive: function( event, ui ) {
					console.log(event);
					alert(event.target.id);
					console.log(ui);
        		    }
		    }).disableSelection();
		  } );
		  
 },500);
  
  //this fuction is for the auto complete too look up team mates when creating a project
  $( function() {
	    var availableTags = <?= $userNamesList ?>;
	    $( "#userlookup" ).autocomplete({
	      source: availableTags
	    });
	  } );
  
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
  } );
  </script>
</head>
<body>
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
		<input type="hidden" name="created" value="<?= $myDateString ?>">
			<!-- this ends the form -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Save Project</button>
      </div>
    </div>
  </div>
</div>
<!-- end new project Modal -->
<div class="row">
	<!-- this is the todo pannel -->
	<div class="col-sm-2 col-md-2 col-lg-2 padding-0">
		<div class="panel panel-default">
  			<div class="panel-heading">
    			<h3 class="panel-title">To Do</h3>
  			</div>
          	<div class="panel-body">

                <ul id="sortable1" class="connectedSortable MyLists">
                 <li class="ui-state-default cardItem">Item 1</li>
                 <li class="ui-state-default cardItem">Item 2</li>
                 <li class="ui-state-default cardItem">Item 3</li>
                 <li class="ui-state-default cardItem">Item 4</li>
                 <li class="ui-state-default cardItem">Item 5</li>
                </ul>
 
          	</div>
		</div>
	</div>
	<!-- this is the doing pannel -->
	<div class="col-sm-8 col-md-8 col-lg-8 padding-0">
	
		<div class="panel panel-default">
  			<div class="panel-heading nopadds">
    			<span class="panel-title">Doing</span>
    			<button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#addProjectMod">
      				<span class="glyphicon glyphicon-file"></span> New Project
    			</button>
  			</div>
          	<div class="panel-body">
          		<!-- This begins the sortable pannels -->
          		<ul id="pannelSort">
          			
    				<!-- this is a project pannel -->
    				<li>
        				<div class="panel panel-default">
                  			<div class="panel-heading">
                    			<h3 class="panel-title">
                    			<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                    			project1
                    			</h3>
                  			</div>
                          	<div class="panel-body">
                          		<!--project catagories -->
                          		<div class="row">
                          		
                              		<!--catagorie start -->
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
    								<!--catagorie end -->
    								<!--catagorie start -->
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
    								<!--catagorie end -->
    								<!--catagorie start -->
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
    								<!--catagorie end -->
    								<!--catagorie start -->
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
    								<!--catagorie end -->
								</div>
								<!--end project catagories -->
                          	</div>
                		</div>
            		</li>
            		<!-- end project pannel -->
            		
    				<!-- this is a project pannel -->
    				<li>
        				<div class="panel panel-default">
                  			<div class="panel-heading">
                    			<h3 class="panel-title">
                    			<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                    			project2
                    			</h3>
                  			</div>
                          	<div class="panel-body">
                                <!--project catagories -->
                          		<div class="row">
                          		
                              		<!--catagorie start -->
                              		<div class="col-sm-3 col-md-3 col-lg-3 padding-0">
        								<div class="panel panel-default">
                                          <div class="panel-heading">Plan</div>
                                          <div class="panel-body">
                                            <ul id="sortable6" class="connectedSortable MyLists">
                                             <li class="ui-state-default cardItem">Item 1</li>
                                             <li class="ui-state-default cardItem">Item 2</li>
                                             <li class="ui-state-default cardItem">Item 3</li>
                                             <li class="ui-state-default cardItem">Item 4</li>
                                             <li class="ui-state-default cardItem">Item 5</li>
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
                                            <ul id="sortable7" class="connectedSortable MyLists">
                                             <li class="ui-state-default cardItem">Item 1</li>
                                             <li class="ui-state-default cardItem">Item 2</li>
                                             <li class="ui-state-default cardItem">Item 3</li>
                                             <li class="ui-state-default cardItem">Item 4</li>
                                             <li class="ui-state-default cardItem">Item 5</li>
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
                                            <ul id="sortable8" class="connectedSortable MyLists">
                                             <li class="ui-state-default cardItem">Item 1</li>
                                             <li class="ui-state-default cardItem">Item 2</li>
                                             <li class="ui-state-default cardItem">Item 3</li>
                                             <li class="ui-state-default cardItem">Item 4</li>
                                             <li class="ui-state-default cardItem">Item 5</li>
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
                                            <ul id="sortable9" class="connectedSortable MyLists">
                                             <li class="ui-state-default cardItem">Item 1</li>
                                             <li class="ui-state-default cardItem">Item 2</li>
                                             <li class="ui-state-default cardItem">Item 3</li>
                                             <li class="ui-state-default cardItem">Item 4</li>
                                             <li class="ui-state-default cardItem">Item 5</li>
                                            </ul>
                                          </div>
                                        </div>
                                    </div>
    								<!--catagorie end -->
								</div>
								<!--end project catagories -->
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
            	  <ul id="sortable10" class="connectedSortable MyLists">
                  <li class="ui-state-default cardItem">Item 1</li>
                  <li class="ui-state-default cardItem">Item 2</li>
                  <li class="ui-state-default cardItem">Item 3</li>
                  <li class="ui-state-default cardItem">Item 4</li>
                  <li class="ui-state-default cardItem">Item 5</li>
                </ul>
          	</div>
		</div>
	</div>
	
</div>
 
 
</body>
</html>