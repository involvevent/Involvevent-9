<?php
include '../template/publictop.php';
require 'publicmysqlkeys.php';
// Create connection
$conn = new mysqli($host, $user, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$idnumnotsafe = $_GET["id"];
$idnumlenchecked;
if (strlen($idnumnotsafe)!=32){
$idnumlenchecked="65d610c1ef2cf3dc6885d76536b62c92";
}
else{
$idnumlenchecked = $idnumnotsafe;
}
$idnumlower = strtolower($idnumlenchecked);
$vowels = array("select", "and", "or", "insert", "update", "delete", "execute", "show", "view", "create", "alter", "references", "index", "create", "view", " ", "routine", "event", "drop", "trigger", "grant", "option", "temporary", "table", "lock", ";",  ",", "echo", "$");
$idnocommands = str_replace($vowels,"",$idnumlower);
$idclean;

if (strlen($idnocommands)!=32){
$idclean="65d610c1ef2cf3dc6885d76536b62c92";
}
else{
$idclean = $idnocommands;
}
$sql = "SELECT * FROM ppv0008004.pubtotalpointsandeventcurrentsem where Pubrandomkeycol='".$idclean."';";

$result = $conn->query($sql);
$totevents;
$totpoints;
$name;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       $totevents = $row["TotalEvents"];

	    $totpoints = $row["TotalPoints"];

	    $name = $row["PubFirstName"];


	     }
}
else {

}
$sql = "SELECT * FROM ppv0008004.pubranking where Pubrandomkeycol='".$idclean."';";

$result = $conn->query($sql);
$totrank;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       $totrank = $row["Pubranking"];


	     }
}
else {
$totrank=5000;
}
if ($totpoints==0){
$totevents=0;
}
else{
}
	   ?>
<div id="about" class="container-fluid">
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-7">
		<div class="row">
		<div class="col-sm-12">
            <h2>Welcome
                <?php echo $name; ?>,</h2>
            <h3>This semester you have earned
                <?php echo $totpoints; ?> point<?php if ($totpoints!=1){echo "s";}?> and attended
                <?php echo $totevents; ?> event<?php if ($totevents!=1){echo "s";}?>. Your current ranking is: <?php echo $totrank; ?>.</h3>
                  <h3>Please Note: Scans may take 24 hours to appear. Additionally, club meeting attendance may take up to two weeks to appear. Any issues or concerns of missing points can be directed to the Penmen Pride Committee via email at <a href = "mailto:sga@snhu.edu">sga@snhu.edu</a> </h3>

	    </div>
		</div>

	<div class="row">
	    <div class="col-sm-6 graphbox">
		    <h4>Number of Points Per Semester</h4>
		    <div class="chart-container">
      <canvas id="mycanvas1"></canvas>
		    </div></div>
		<div class="col-sm-6 graphbox">
		<h4>Number of Events Per Semester</h4>
		    <div class="chart-container">
      <canvas id="mycanvas2"></canvas>
    </div>
			 </div>
		</div>
	    </div>
		<div class="col-sm-3">
			<table class="table table-striped">
                <col width="10%">
                <col width="35%">
                <col width="15%">
                <tr>
                    <th>Semester
                    </th>
                    <th>Events
                    </th>
                    <th>Points
                    </th>
                </tr>

                <?php
$sql = "SELECT PubSemester, totpoints, totevents FROM ppv0008004.pointspersemesterordered where Pubrandomkeycol='".$idclean."';";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       ?>
                    <tr>
                        <td>
                            <?php echo $row["PubSemester"];
	   ?>
                        </td>
                        <td>
                            <?php echo $row["totevents"];
	   ?>
                        </td>
                        <td>
                            <?php echo $row["totpoints"];
	   ?>
                        </td>
                    </tr>
                    <?php
    }
} else {

}
				?>
			</table>
		</div>

		<script>
			$(document).ready(function(){
  $.ajax({
	  <?php
	  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

$url = $protocol . $_SERVER['HTTP_HOST'];
	  ?>
    url : "<?php echo $url; ?>/public/chart1data.php?id=<?php echo $idclean; ?>",
    type : "GET",
    success : function(data){
      console.log(data);
      var PubSemester = [];
      var totpoints = [];
      for(var i in data) {
        PubSemester.push(data[i].PubSemester);
        totpoints.push(data[i].totpoints);
      }
      var chartdata = {
        labels: PubSemester,
        datasets: [
          {
            label: "Total Points",
            fill: false,
            lineTension: 0.1,
            backgroundColor: "rgba(0, 30, 96, 1)",
            //borderColor: "rgba(59, 89, 152, 1)",
		  borderColor: "rgba(255, 255, 255, 1)",
            pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
            pointHoverBorderColor: "rgba(59, 89, 152, 1)",
            data: totpoints
          }

        ]
      };
      var ctx = $("#mycanvas1");
      var LineGraph = new Chart(ctx, {
        type: 'horizontalBar',
        data: chartdata,
	options: {
     		legend: {
            		display: false
         		}
	      }
      });
    },
    error : function(data) {
    }
  });
});
			$(document).ready(function(){
  $.ajax({
	  <?php
	  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

$url = $protocol . $_SERVER['HTTP_HOST'];
	  ?>
    url : "<?php echo $url; ?>/public/chart2data.php?id=<?php echo $idclean; ?>",
    type : "GET",
    success : function(data){
      console.log(data);
      var PubSemester = [];
      var totevents = [];
      for(var i in data) {
        PubSemester.push(data[i].PubSemester);
        totevents.push(data[i].totevents);
      }
      var chartdata = {
        labels: PubSemester,
        datasets: [
          {
            label: "totevents",
            fill: false,
            lineTension: 0.1,
            backgroundColor: "rgba(0, 30, 96, 1)",
            //borderColor: "rgba(59, 89, 152, 1)",
		  borderColor: "rgba(255, 255, 255, 1)",
            pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
            pointHoverBorderColor: "rgba(59, 89, 152, 1)",
            data: totevents
          }

        ]
      };
      var ctx = $("#mycanvas2");
      var LineGraph = new Chart(ctx, {
        type: 'doughnut',
        data: chartdata,
	options: {
     		legend: {
            		display: false
         		}
	      }
      });
    },
    error : function(data) {
    }
  });
});
		</script>

        <div class="col-sm-1">
        </div>
    </div>
	<div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-10 graphbox">
		<h3>You Have Attended the Following Events:</h3>
            <table class="tabledisplay">
<thead>
                <tr>
                    <th>Event Date
                    </th>
                    <th>Event Name
                    </th>
                    <th>Event Host
                    </th>
                    <th>Semester
                    </th>
                    <th>Points
                    </th>
                </tr>
</thead>
                <?php
$sql = "SELECT * FROM ppv0008004.pubscanner where Pubrandomkeycol='".$idclean."' order by PubEventDate desc;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       ?>
                    <tr>
                        <td>
                            <?php echo $row["PubEventDate"];
	   ?>
                        </td>
                        <td>
                            <?php echo $row["PubEventName"];
	   ?>
                        </td>
                        <td>
                            <?php echo $row["PubEventHost"];
	   ?>
                        </td>
                        <td>
                            <?php echo $row["PubSemester"];
	   ?>
                        </td>
                        <td>
                            <?php echo $row["PubPointValue"];
	   ?>
                        </td>
                    </tr>
                    <?php
    }
} else {

}
$conn->close();
?>
            </table>
        </div>
        <div class="col-sm-1">
        </div>
    </div>
</div>
<?php include '../template/bottom.php' ?>
