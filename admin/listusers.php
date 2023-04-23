<?php require "../login/loginheader.php"; ?>
<?php require "../login/permissions/level5.php"; ?>
<?php include "../template/top.php"; ?>
<div id="about" class="container-fluid">
      <div class="row">
              <div class="col-sm-1">
    </div>
    <div class="col-sm-10">
        <h2>Penmen Pride Database User Listing</h2>
<table class="table table-striped">
      <!-- <col width="10%">
  <col width="35%">
      <col width="15%">
  <col width="10%">
      <col width="10%">
  <col width="20%"> -->
  <thead>
<tr>
<th>Last Name
</th>
<th>First Name
</th>
<th>Username
</th>
<th>Email
</th>
<th>User Level
</th>
<th>User Disabled</th>
<th>Access Prize Give Away</th>
<th>Access Statistics</th>
<th>Can Upload Data</th>
<th>Can Send Email Mail Merges</th>
<th>Can Administer Users</th>
<th>Super Admin (Cannot Be Deleted)</th>
</tr>
</thead>

<?php
require '../mysqlkeys.php';
// Create connection
$conn = new mysqli($host, $user, $password, $logindbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "select * from userlist;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       ?><tr><td> <?php echo $row["lastname"];
	   ?></td><td><?php echo $row["firstname"];
	   ?></td><td><?php echo $row["username"];
	   ?></td><td><?php echo $row["email"];
	   ?></td><td><?php echo $row["adminlevel"];
	   ?></td><td><?php if($row["dis"]==1){ ?><span class="glyphicon glyphicon-ok"></span><?php } else { ?><span class="glyphicon glyphicon-remove"></span><?php }
	   ?></td><td><?php if($row["giv"]==1){ ?><span class="glyphicon glyphicon-ok"></span><?php } else { ?><span class="glyphicon glyphicon-remove"></span><?php }
	   ?></td><td><?php if($row["stat"]==1){ ?><span class="glyphicon glyphicon-ok"></span><?php } else { ?><span class="glyphicon glyphicon-remove"></span><?php }
	   ?></td><td><?php if($row["data"]==1){ ?><span class="glyphicon glyphicon-ok"></span><?php } else { ?><span class="glyphicon glyphicon-remove"></span><?php }
	   ?></td><td><?php if($row["send"]==1){ ?><span class="glyphicon glyphicon-ok"></span><?php } else { ?><span class="glyphicon glyphicon-remove"></span><?php }
	   ?></td><td><?php if($row["admin"]==1){ ?><span class="glyphicon glyphicon-ok"></span><?php } else { ?><span class="glyphicon glyphicon-remove"></span><?php }
	   ?></td><td><?php if($row["super"]==1){ ?><span class="glyphicon glyphicon-ok"></span><?php } else { ?><span class="glyphicon glyphicon-remove"></span><?php }
	   ?></td></tr><?php
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
<?php include "../template/bottom.php" ?>
