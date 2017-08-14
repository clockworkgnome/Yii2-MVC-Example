
  
  <style>
  .padding-0{
    padding-right:0;
    padding-left:0;
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
  </style>

  <script>
  setTimeout(function(){
	  $( function() {
		    $( "#pannelSort" ).sortable();
		    $( "#pannelSort" ).disableSelection();
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
  </script>
</head>
<body>

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
  			<div class="panel-heading">
    			<h3 class="panel-title">Doing</h3>
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