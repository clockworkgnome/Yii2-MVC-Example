<style>

@media screen and (max-width: 500px) {
	#chartCanvas{
		display:none;
	}
}
</style>


<div class="panel" id="barchart">
	<div class="panel-heading">
		<h3 class="panel-title myHeadings">Example of Real Time Statistics</h3>
	</div>
	<div class="panel-body">
		<canvas id="chartCanvas"></canvas>
		<div class="myHeadings">Average Sales:</div><canvas id="pieCanvas"></canvas>
		<div id="myLegend"></div>
	</div>
</div>

<script>
console.log("I am here ...");
var myCanvas = document.getElementById("chartCanvas");
myCanvas.width = 850;
myCanvas.height = 150;
//myCanvas.height =document.getElementById('barchart').clientHeight-50;
//myCanvas.width =document.getElementById('barchart').clientWidth-100;
var ctx = myCanvas.getContext("2d");
 var myPieCanvas= document.getElementById("pieCanvas");
 myPieCanvas.height=50;
 myPieCanvas.width =document.getElementById('barchart').clientWidth;
 var ctx2 = myPieCanvas.getContext("2d");
 
 $(function(){
	    resizeCanvas();
	});

	$(window).on('resize', function(){
	    resizeCanvas();
	});

	function resizeCanvas()
	{

		myCanvas.width =document.getElementById('barchart').clientWidth-100;
		
		 myPieCanvas.width =document.getElementById('barchart').clientWidth;
	}
// ctx: reference to the drawing context
// startX: the X coordinate of the line starting point
// startY: the Y coordinate of the line starting point
// endX: the X coordinate of the line end point
// endY: the Y coordinate of the line end point
function drawLine(ctx, startX, startY, endX, endY,width=1,color='#000000'){
    ctx.beginPath();
    ctx.moveTo(startX,startY);
    ctx.lineTo(endX,endY);
    ctx.lineWidth = width;
    ctx.strokeStyle = color;
    ctx.stroke();
}
function fillArea(ctx, startX, startY, endX, endY,color='#000000'){
	ctx.beginPath();
	ctx.moveTo(startX,startY); //go to first point
	ctx.lineTo(endX,endY); //draw to second point
	ctx.lineTo(endX,200); //draw to third point
	ctx.lineTo(startX,200); //draw to last point
	ctx.closePath();  //draw to first point
	ctx.fillStyle = color;//fill color 
	ctx.fill(); //fill the area
}
function drawBar(ctx, startX, startY,color='#000000'){
	ctx.beginPath();
	ctx.moveTo(startX,startY); //go to first point
	ctx.lineTo(startX+20,startY); //draw to second point
	ctx.lineTo(startX+20,myCanvas.height-20); //draw to third point
	ctx.lineTo(startX,myCanvas.height-20); //draw to last point
	ctx.closePath();  //draw to first point
	ctx.fillStyle = color;//fill color 
	ctx.fill(); //fill the area
}
//ctx: reference to the drawing context
//centerX: the X coordinate of the circle center
//centerY: the Y coordinate of the circle center
//radius: the X coordinate of the line end point
//startAngle: the start angle in radians where the portion of the circle starts
//endAngle: the end angle in radians where the portion of the circle ends
function drawArc(ctx, centerX, centerY, radius, startAngle, endAngle){
 ctx.beginPath();
 ctx.arc(centerX, centerY, radius, startAngle, endAngle);
 ctx.stroke();
}


//ctx: reference to the drawing context
//centerX: the X coordinate of the circle center
//centerY: the Y coordinate of the circle center
//radius: the X coordinate of the line end point
//startAngle: the start angle in radians where the portion of the circle starts
//endAngle: the end angle in radians where the portion of the circle ends
//color: the color used to fill the slice
//slice angle = 2 * PI * category value / total value
function drawPieSlice(ctx,centerX, centerY, radius, startAngle, endAngle, color ){
    ctx.fillStyle = color;
    ctx.beginPath();
    ctx.moveTo(centerX,centerY);
    ctx.arc(centerX, centerY, radius, startAngle, endAngle);
    ctx.closePath();
    ctx.fill();
}
//test drawing capabilityies

// drawLine(ctx,100,100,200,200);
// drawArc(ctx, 150,150,150, 0, Math.PI/3);
// drawPieSlice(ctx, 150,150,150, Math.PI/2, Math.PI/2 + Math.PI/4, '#ff0000');
//Draw the link
var Links = new Array(); // Links information
var hoverLink = ""; // Href of the link which cursor points at
function drawLink(ctx,x,y,href,title,data){
	   ctx.fillStyle = "rgba(173,216,230,0.5)"; // Default blue link color
       ctx.font = "8px Courier New"; // Monospace font for links
       ctx.textBaseline = "top"; // Makes left top point a start point for rendering text
	
    var linkTitle = title,
        linkX = x,
        linkY = y,
        linkWidth = ctx.measureText(linkTitle).width,
        linkHeight = parseInt(ctx.font); // Get lineheight out of fontsize

    // Draw the link
    ctx.fillText(linkTitle, linkX, linkY);

    // Add mouse listeners
    myCanvas.addEventListener("mousemove", on_mousemove, false);
    myCanvas.addEventListener("click", on_click, false);

    // Add link params to array
    Links.push(x + ";" + y + ";" + linkWidth + ";" + linkHeight + ";" + href+ ";" +data);
}
//make links work
var savedx=0,savedy=0;
//make hover work
var isDrawn=0;
      // Link hover
      function on_mousemove (ev) {
          var x, y;

          // Get the mouse position relative to the canvas element
          if (ev.layerX || ev.layerX == 0) { // For Firefox
              x = ev.layerX;
              y = ev.layerY;
          }

          // Link hover
          for (var i = Links.length - 1; i >= 0; i--) {
              var params = new Array();

              // Get link params back from array
              params = Links[i].split(";");

              var linkX = parseInt(params[0]),
                  linkY = parseInt(params[1]),
                  linkWidth = parseInt(params[2]),
                  linkHeight = parseInt(params[3]),
                  linkHref = params[4],
                  pointdata = params[5];
              // Check if cursor is in the link area
              if (x >= linkX && x <= (linkX + linkWidth) && y >= linkY && y <= (linkY + linkHeight)){
                  if(isDrawn===0){
                  	isDrawn=1;
              		ctx.fillStyle = "#000000";
                  	ctx.font = "bold 10px Arial";
                  	ctx.fillText(pointdata, linkX-12,linkY-18);
                  	savedx=linkX-12;
                  	savedy=linkY-18;
                  }
                  document.body.style.cursor = "pointer";
                  hoverLink = linkHref;
                  break;
              }
              else {
              	if(savedx>0 || savedy>0){
              		ctx.clearRect(savedx, savedy, 12, 10);
              		isDrawn=0;
              	}
                  document.body.style.cursor = "";
                  hoverLink = "";
              }
          };
      }
   // Link click
      function on_click(e) {
          if (hoverLink){
              window.open(hoverLink); // Use this to open in new tab
              //window.location = hoverLink; // Use this to open in current window
          }
      }
//test links
//drawLink(ctx,95,93,"http://www.facebook.com/","Me at facebook");
//to make a line graph 
var LineGraph = function(options){
    this.options = options;
    this.canvas = options.canvas;
    this.ctx = this.canvas.getContext("2d");
    this.colors = options.colors;
    this.draw = function(){

        //this will get the number of skills for the x axis
        var total_value = 0;
        //this will be the average svg
        var myAvg = 0;
        for (var categ in this.options.data){
            total_value += 1;
        }
        //adds all svls
    	for (var skill in this.options.data){
            var svl = this.options.data[skill];
            myAvg+=svl;
    	}
    	//divide by the total number of svls then get the average rounding up
    	myAvg=Math.ceil(myAvg/total_value);
    	//make speedometer
    	var theRest=100-myAvg;
    	
var myVinyls = {
    "the rest": theRest,
    "average": myAvg,

};var myPiechart = new Piechart(
	    {
	        canvas:myPieCanvas,
	        data:myVinyls,
	        colors:["rgba(40, 251, 142, 0.64)","#0B504F"],
			   doughnutHoleSize:0.5,
	    }
	);
	myPiechart.draw();
	    	
	    	console.log("number of skills ="+total_value);
	    	console.log("Average of svl ="+myAvg);
	        // this will get the size of pixel per 1 unit on the x axis
	    	var XUnit=Math.ceil((this.canvas.width-80)/total_value);
	    	console.log("xunits ="+XUnit);
	    	//this will getthe number of pixels per 1 unit on the Y axis
	    	//per paul we will go 1-100%
	    	var subForLabels =this.canvas.height-20;
	    	var YUnit=subForLabels/100;
	    	console.log("yunits ="+YUnit);
	    	//draw the grid 
			var EndofCanvas = this.canvas.width;
			//y label
			var yLabel=100;
			//draw teh first Y line 
			drawLine(this.ctx,0, 0, EndofCanvas, 0);
			for(i=0;i<100;i+=20){
				
				drawLine(this.ctx,0, YUnit*i, EndofCanvas, YUnit*i);
				this.ctx.fillStyle = "#FFFFFF";
				this.ctx.font = "bold 14px Arial";
		        this.ctx.fillText(yLabel,(XUnit/2)-10,YUnit*i);
		        yLabel=yLabel-20;
			}
			//draw the lasty line
			drawLine(this.ctx,0, YUnit*100, EndofCanvas, YUnit*100);
			//get the top of canvas 
			var topofcanvas= this.canvas.height;
			//draw the X gridlines 
			var lastLine=XUnit*total_value;
			var Xpoint=0;
			for(i=0;i<lastLine;i++){
				drawLine(this.ctx,Xpoint, 0, Xpoint, topofcanvas,0.5,"#000000");
				Xpoint+=XUnit;
			}
			//draw the last x line
			drawLine(this.ctx,EndofCanvas, 0, EndofCanvas, topofcanvas,0.5,"#000000");
			//check to see if this is the first line
	    	var firstline=1;
	    	//these will build a line
	    	var startX=0;
	    	var startY=0;
	    	var endX=0;
	    	var endY=0;
	    	var xlabelX=-110, xlabelY=110;
	    	for (var skill in this.options.data){
	            var svl = this.options.data[skill];
	            var linkdata = svl;
	            if(firstline===1){
	            	firstline=0;
	            	//if this is the first point we cant draw teh line yet just make the first point
	            	startX=0;
	            	startY=(svl*YUnit)+20;
	            	//invertY for represenation
	            	startY=this.canvas.height-startY;
	            	//draw the first point link 
	            	drawLink(ctx,startX+XUnit*2,startY,"http://www.jujugaming.com","*",linkdata);
	            	drawBar(this.ctx,startX+XUnit+(XUnit/2)-10,startY,"#0B504F");

	            }else{
	            	endX=startX+XUnit;
	            	endY=(svl*YUnit)+20;
	            	//invert for representation
	            	endY=this.canvas.height-endY;
	            	//make the next point
	            	drawLink(ctx,endX+XUnit+(XUnit/2)-10,endY,"http://www.jujugaming.com","*",linkdata);
//	             	console.log("startX:"+startX);
//	             	console.log("startY:"+startY);
//	             	console.log("endX:"+endX);
//	             	console.log("endY:"+endY);
//	             	console.log("CTX:"+this.ctx);
					//draw the line
	            	//drawLine(this.ctx, startX, startY, endX, endY,1,"#0B504F");
	            	//fill teh area under the line rgba(0,255,255,0.5)
	            	//fillArea(this.ctx, startX, startY, endX, endY,"#0B504F");
	            	drawBar(this.ctx,endX+XUnit+(XUnit/2)-10,endY,"#0B504F");
	            	//set teh end point as teh start point 
	            	startX=endX;
	            	startY=endY;
	            }
	            
	        }
	    	//this draws teh labels 
	        var myX=10;
	    	for (var skill in this.options.data){
		    	//this draws the X label 
				myX=myX+XUnit;
				this.ctx.fillStyle = "#FFFFFF";
				this.ctx.font = "bold 14px Arial";
		        this.ctx.fillText(skill.substring(0, 10), myX,this.canvas.height-14);
		       
	    	}


	    	
	    }
	}
//to make a pie chart 
var Piechart = function(options){
  this.options = options;
  this.canvas = options.canvas;
  this.ctx = this.canvas.getContext("2d");
  this.colors = options.colors;

  this.draw = function(){
      var total_value = 0;
      var color_index = 0;
      for (var categ in this.options.data){
          var val = this.options.data[categ];
          total_value += val;
      }

      var start_angle = 0;
      for (categ in this.options.data){
          val = this.options.data[categ];
          var slice_angle = 2 * Math.PI * val / total_value;

          drawPieSlice(
              this.ctx,
              (this.canvas.width/2),
              (this.canvas.height/2),
              Math.min(this.canvas.width/2,this.canvas.height/2),
              start_angle,
              start_angle+slice_angle,
              this.colors[color_index%this.colors.length]
          );
          start_angle += slice_angle;
          color_index++;
      }
    //drawing a white circle over the chart
      //to create the doughnut chart
      if (this.options.doughnutHoleSize){
          drawPieSlice(
              this.ctx,
              (this.canvas.width/2),
              (this.canvas.height/2),
              this.options.doughnutHoleSize * Math.min(this.canvas.width/2,this.canvas.height/2),
              0,
              2 * Math.PI,
              "rgba(46, 138, 196, 0.6)"
          );
      }
    //make the labels first find mid point of radius of each pie slice then the mid point of each angle of the slice 
      start_angle = 0;
      for (categ in this.options.data){
          val = this.options.data[categ];
          slice_angle = 2 * Math.PI * val / total_value;
          var pieRadius = Math.min(this.canvas.width/2,this.canvas.height/2);
          var labelX = this.canvas.width/2 + (pieRadius / 2) * Math.cos(start_angle + slice_angle/2);
          var labelY = this.canvas.height/2 + (pieRadius / 2) * Math.sin(start_angle + slice_angle/2);
       
          if (this.options.doughnutHoleSize){
              var offset = (pieRadius * this.options.doughnutHoleSize ) / 4;
              labelX = (this.canvas.width/2)+ (offset + pieRadius / 4) * Math.cos(start_angle + slice_angle/2);
              labelY = (this.canvas.height/2) + (offset + pieRadius / 4) * Math.sin(start_angle + slice_angle/2);               
          }
       
          var labelText = Math.round(100 * val / total_value);
          this.ctx.fillStyle = "white";
          this.ctx.font = "bold 10px Arial";
          this.ctx.fillText(labelText+"%", labelX,labelY);
          start_angle += slice_angle;
      }
      // make the legend 
      if (this.options.legend){
          color_index = 0;
          var legendHTML = "";
          for (categ in this.options.data){
              legendHTML += "<div><span style='display:inline-block;width:20px;background-color:"+this.colors[color_index++]+";'>&nbsp;</span> "+categ+"</div>";
          }
          this.options.legend.innerHTML = legendHTML;
      }

  }
}
var nIntervId;

function chartData() {
  nIntervId = setInterval(Makedata, 1000);
}
function stopChart() {
    clearInterval(nIntervId);
  }
function Makedata(){
	var myData = {
	"Tech Support": Math.floor(Math.random() * 100) + 1,
	"Home Health": Math.floor(Math.random() * 100) + 1,
	"Billing": Math.floor(Math.random() * 100) + 1,
	"Service": Math.floor(Math.random() * 100) + 1,
	"Roadside": Math.floor(Math.random() * 100) + 1,
	"Sales":Math.floor(Math.random() * 100) + 1,
	"Sales2":Math.floor(Math.random() * 100) + 1,
	"Sales3":Math.floor(Math.random() * 100) + 1,
	"Sales4":Math.floor(Math.random() * 100) + 1,
	"Sales5":Math.floor(Math.random() * 100) + 1,
	"Sales6":Math.floor(Math.random() * 100) + 1,
	};
	
	
	
	var myLineGraph = new LineGraph(
	{
	    canvas:chartCanvas,
	    data:myData,
	    colors:["#fde23e","#f16e23", "#57d9ff","#937e88"]
	}
	);
	ctx.clearRect(0, 0, myCanvas.width, myCanvas.height);
	ctx2.clearRect(0, 0, myPieCanvas.width, myPieCanvas.height);
	myLineGraph.draw();
}
chartData();
//example data example pie chart 
//var myVinyls = {
//"the rest": 30,
//"average": 60,

//};
//var myPiechart = new Piechart(
//{
//canvas:myCanvas,
//data:myVinyls,
//colors:["#fde23e","#f16e23", "#57d9ff","#937e88"],
//   doughnutHoleSize:0.5,
//   legend:myLegend
//}
//);
//myPiechart.draw();

</script>