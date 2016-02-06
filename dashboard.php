<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Mobile Sensor Cloud</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    
    
    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>
    
    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>
    
    
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="highcharts.js"></script>
<script src="highcharts-3d.js"></script>
<script src="exporting.js"></script>
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    <style>
	#container{
		width: 1300px;
		height: 1300px;	
	}
	
	.sensors{
	   width: 200px;
	   height: 90px;
	   cursor: pointer;
	}
	</style>
    <script>

var temp = [];
var tempname = [];
var temp1 = [];
var tempname1 = [];
var temp2 = [];
function sensorSelect(id){
	var element=document.getElementById(id);
	var temp2 = [];
	$.ajax({
    url: "sensorwater.php",
    type: 'GET',
	dataType:'json',
	data: { id : id },
    success: function (data) 
	{

		$(data).each(function(index,value)
		{
		temp2.push(parseInt(value.sensor_value));
		});
		temp2.reverse();
		linechart(temp2);
	},
	error: function(e){
        alert('Error: '+ e.message);
    }  
});
	
}
function calldata()
{
$.ajax({
    url: "sensortemp.php" ,
    type: 'GET',
	dataType:'json',
    success: function (data) 
	{	
		$(data).each(function(index,value){
		  temp1.push(parseInt(value.sensor_value));
		  tempname1.push(value.sensor_name);
		});
		loadchart(temp1,tempname1);
	},
	error: function(e){
        alert('Error: '+ e.message);
    }  
});

$.ajax({
    url: "sensortemp2.php" ,
    type: 'GET',
	dataType:'json',
    success: function (data) 
	{	
		$(data).each(function(index,value){
		  temp.push(parseInt(value.sensor_value));
		  tempname.push(value.sensor_name);
		});
		loadchart2(temp,tempname);
	},
	error: function(e){
        alert('Error: '+ e.message);
    }  
});

}

function loadchart2(temp,tempname) {
	 var chart = new Highcharts.Chart({
        chart: {
            type: 'column',
			renderTo: 'cont2',
            margin: 75,
            options3d: {
                enabled: true,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: 'Water-level Sensor Values'
        },
        subtitle: {
            text: 'Measured in feet'
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        xAxis: {
            categories: tempname
        },
        yAxis: {
            title: {
                text: 'feet'
            }
        },
        series: [{
            name: 'Water-level',
            data: temp
        }]
    });
}

function loadchart(temp1,tempname1) {
	 var chart = new Highcharts.Chart({
        chart: {
            type: 'column',
			renderTo: 'cont',
            margin: 75,
            options3d: {
                enabled: true,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: 'Temperature Sensor Values'
        },
        subtitle: {
            text: 'Measured in Celsius'
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        xAxis: {
            categories: tempname1
        },
        yAxis: {
            title: {
                text: '°Celcius'
            }
        },
        series: [{
            name: 'Temperature',
            data: temp1
        }]
    });
}

function linechart(temp2) {
var chart2 = new Highcharts.Chart({
	chart: {
		renderTo: 'high',
	},
        title: {
            text: 'Last 5 Sensor readings',
            x: -20 //center
        },
        subtitle: {
            text: 'Comparing last 5 Sensor values',
            x: -20
        },
        xAxis: {
            categories: ['1','2','3','4','5','6']
        },
        yAxis: {
            title: {
                text: 'Gallons'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ' Units'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'sensor values',
            data: temp2
        }]
    });
}
	
	</script>
    <script>
	$(document).ready(function(){
    $(".sensors").hover(function(){
		  $(this).css("background-color", "pink");
        }, function(){
		  $(this).css("background-color", "white");
    	});
	});
	
	</script>
 
</head>
<body onLoad="calldata()"> 

<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">    
    
    <!--   
        
        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" 
        Tip 2: you can also add an image using data-image tag
        
    -->
    
    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                   Mobile Sensor Cloud
                </a>
            </div>
                       
            <ul class="nav">
                <li class="active">
                    <a href="dashboard.php">
                        <i class="pe-7s-graph"></i> 
                        <p>Dashboard</p>
                    </a>            
                </li>
                <li>
                    <a href="user.html">
                        <i class="pe-7s-user"></i> 
                        <p>User Profile</p>
                    </a>
                </li> 
                <li>
                    <a href="table.php">
                        <i class="pe-7s-note2"></i> 
                        <p>Table List</p>
                    </a>        
                </li>
                <li>
                    <a href="typography.html">
                        <i class="pe-7s-news-paper"></i> 
                        <p>Sensor</p>
                    </a>        
                </li>
                
                <li>
                    <a href="billing.php">
                        <i class="pe-7s-news-paper"></i> 
                        <p>Billing Details</p>
                    </a>        
                </li>
                
                <li>
                    <a href="maps.html">
                        <i class="pe-7s-map-marker"></i> 
                        <p>Maps</p>
                    </a>        
                </li>
                
            </ul> 
    	</div>
    </div>
    
    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">    
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="dashboard.html">Dashboard</a>
                </div>
                <div class="collapse navbar-collapse">       
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-dashboard"></i>
                            </a>
                        </li>
                        
                        <li>
                           <a href="">
                                <i class="fa fa-search"></i>
                            </a>
                        </li> 
                    </ul>
                    
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="user.html">
                               Account
                            </a>
                        </li>
                        
                        <li>
                            <a href="#">
                                Log out
                            </a>
                        </li> 
                    </ul>
                </div>
            </div>
        </nav>
                     
                     
        <div class="content">
            <div class="container-fluid">    
                <div class="row">
                  <div class="header">
                      <h4 class="title">Temperature Sensors</h4>
                  </div>
                  <div class="col-md-12">
                  	<div class="card">                          
                      <div class="content"> 
                        <div id="cont" style="height: 400px"></div>
                      </div>
                    </div>
                   </div>                                   
                 </div>
                 <div class="row">
                 <?php
				  $servername = "172.99.75.178";
				  $username = "root";
				  $password = "root";
				  $dbname = "SensorInfo";
				  $rows = array();
				  $conn = new mysqli($servername, $username, $password, $dbname);
				  
				  if ($conn->connect_error) {
					  die("Connection failed: " . $conn->connect_error);
				  }
				  
				  $sql = "SELECT * FROM sensor_info WHERE type='temp'";
				  
				  $result = $conn->query($sql);
				  $str="";
				  if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						$str=$str.'<div class="col-md-3"><div class="card"> <div class="content"><div name="'.$row["type"].'" id="'.$row["id"].'" class="sensors text-center" data-toggle="modal" data-target="#myModal" onclick="sensorSelect(this.id) ">'.$row["name"].' <br><img src="images/temp-sensor.png" height="42" width="42"> </div></div></div></div>';
						}
					}
				  echo $str;
				  $conn->close();
				 ?>
                 
                  </div>                                   
                </div>    
                
                
                <div class="row">
                  <div class="header">
                      <h4 class="title">Water-Level Sensors</h4>
                  </div>
                  <div class="col-md-12">
                      <div class="card">                          
                          <div class="content"> 
                          	<div id="cont2" style="height: 400px"></div>
                          </div>
                      </div>
                   </div>                                   
                 </div>
                 
                 <div class="row">
                   <?php
				  $servername = "172.99.75.178";
				  $username = "root";
				  $password = "root";
				  $dbname = "SensorInfo";
				  $rows = array();
				  $conn = new mysqli($servername, $username, $password, $dbname);
				  
				  if ($conn->connect_error) {
					  die("Connection failed: " . $conn->connect_error);
				  }
				  
				  $sql = "SELECT * FROM sensor_info WHERE type='water-level'";
				  
				  $result = $conn->query($sql);
				  $str="";
				  
				  if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						$str=$str.'<div class="col-md-3"><div class="card"> <div class="content"><div name="'.$row["type"].'" id="'.$row["id"].'" class="sensors text-center" data-toggle="modal" data-target="#myModal" onclick="sensorSelect(this.id)">'.$row["name"].'<br><img src="images/water-sensor.png" height="42" width="42"></div></div></div></div>';
						}
					}
				  echo $str;
				  $conn->close();
				 ?>                              
                </div>    
                      
            </div>    
        </div>
        
                <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portfolio
                            </a>
                        </li>
                        <li>
                            <a href="#">
                               Blog
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; 2015 <a href="#">Cloud Nine</a>
                </p>
            </div>
        </footer>
        
    </div>   
</div>
<div class="modal fade" id="myModal">
          <div class="modal-dialog">
              <div class="modal-content">
                  <!-- Modal Header -->
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Sensor Values comparison chart</h4>
                  </div>
                  <!-- Modal Body -->
                  <form role="form" id="the_form" method="post">
                  <div class="modal-body">
                        <div id="high" style="height: 400px;width: 570px;"></div>
                  </div>
                  <!-- Modal Footer -->
                  <div class="modal-footer">              
                  </div>
              </div>
              </form>
          </div>
      </div>


</body>

    <!--   Core JS Files   -->
    
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>
	
	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>
    
    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
	
    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>
	
	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>
	
	<script type="text/javascript">
    	$(document).ready(function(){
        	
        	demo.initChartist();
        	
        	$.notify({
            	icon: 'pe-7s-gift',
            	message: "Welcome to <b>your Dashboard</b> - an easy way to customize your sensors."
            	
            },{
                type: 'info',
                timer: 4000
            });
            
    	});
	</script>
    
</html>
