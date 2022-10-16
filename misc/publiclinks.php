<?php require "../login/loginheader.php"; ?>
<?php require "../login/permissions/level2.php"; ?>
<?php include "../template/top.php"; ?>
<div id="about" class="container-fluid">
      <div class="row">
              <div class="col-sm-1">
    </div>
    <div class="col-sm-10">
        <h2>Penmen Pride Public Link Listing</h2>
	      </div>
	      <div class "col-sm-1">
	      </div>
	      <div class="row">
		      <div class="row">
			      <div class="col-sm-12">
<table class="tabledisplay">
<thead>
<tr>

<th>Last Name
</th>
<th>First Name
</th>
<th>Email Address
</th>
<th>Student ID
</th>
<th>Senator
</th>
<th>Faculty
</th>
<th>Portal
</th>
</tr>
</thead>
<?php
require '../mysqlkeys.php';
// Create connection
$conn = new mysqli($host, $user, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM ppv0008003.randomkeyswithlink order by Senator desc, faculty desc, StudentLastName, StudentFirstName";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       ?><tr><td><?php echo $row["StudentLastName"];
  	   ?></td><td><?php echo $row["StudentFirstName"];
  	   ?></td><td> <?php echo $row["email"];
	   ?></td><td><?php echo $row["StudentID"];
	   ?></td><td><?php if($row["Senator"]==1){ ?><span class="glyphicon glyphicon-ok"></span><?php } else { ?><span class="glyphicon glyphicon-remove"></span><?php }
	   ?></td><td><?php if($row["Faculty"]==1){ ?><span class="glyphicon glyphicon-ok"></span><?php } else { ?><span class="glyphicon glyphicon-remove"></span><?php }
	   ?></td><td><a href="<?php echo $row["link"];?>" target="_blank">Go to Portal</a></td></tr><?php
    }
} else {

}
$conn->close();
?>
<tfoot>
<tr>

<th>Last Name
</th>
<th>First Name
</th>
<th>Email Address
</th>
<th>Student ID
</th>
<th>Senator
</th>
<th>Faculty
</th>
<th>Portal
</th>
</tr>
</tfoot>
</table>
        </div>

  </div>
</div>
<?php include "../template/bottom.php" ?>
