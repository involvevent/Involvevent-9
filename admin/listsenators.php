<?php require "../login/loginheader.php"; ?>
<?php require "../login/permissions/level6.php"; ?>
<?php include "../template/top.php"; ?>
<div id="about" class="container-fluid">
      <div class="row">
              <div class="col-sm-1">
    </div>
    <div class="col-sm-10">
        <h2>Penmen Pride Senator Listing</h2>
	      </div>
	      <div class "col-sm-1">
	      </div>
	      <div class="row">
		      <div class="row">
			      <div class="col-sm-1">
            </div>
            <div class="col-sm-10">
              <h3>Current Students Listed as Senators</h3>
<table class="table table-striped">
      <col width="35%">
  <col width="10%">
      <col width="15%">
  <col width="15%">
      <col width="15%">
      <col width="10%">
<tr>
<th>Email Address
</th>
<th>Student ID
</th>
<th>Last Name
</th>
<th>First Name
</th>
<th>Senator
</th>
<th>Change Senator Status
</th>
</tr>

<?php
require '../mysqlkeys.php';
// Create connection
$conn = new mysqli($host, $user, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM ppv0008003.studentlisting where senator=1 and studentid!='0000001'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       ?><tr><td><?php echo $row["EmailAddress"];
	   ?></td><td><?php echo $row["StudentID"];
	   ?></td><td><?php echo $row["StudentLastName"];
	   ?></td><td><?php echo $row["StudentFirstName"];
	   ?></td><td><?php if($row["Senator"]==1){ ?><span class="glyphicon glyphicon-ok"></span><?php } else { ?><span class="glyphicon glyphicon-remove"></span><?php }
	   ?></td><td><form action="../actions/actionchangesenatorstatus.php" method="post"><input type="hidden" name="useremail" value="<?php echo $row["EmailAddress"]; ?>"> <input type="hidden" name="newstatus" value="0"><input type="submit" value="Change Status" /> </form></td></tr>
     <?php
    }
} else {

}
$conn->close();
?>
</table>
<h3>Current Students Not Listed as Senators</h3>
<table class="table table-striped">
      <col width="35%">
  <col width="10%">
      <col width="15%">
  <col width="15%">
      <col width="15%">
      <col width="10%">
<tr>
<th>Email Address
</th>
<th>Student ID
</th>
<th>Last Name
</th>
<th>First Name
</th>
<th>Senator
</th>
<th>Change Senator Status
</th>
</tr>

<?php
require '../mysqlkeys.php';
// Create connection
$conn = new mysqli($host, $user, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM ppv0008003.studentlisting where senator=0 and studentid!='0000001'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       ?><tr><td><?php echo $row["EmailAddress"];
	   ?></td><td><?php echo $row["StudentID"];
	   ?></td><td><?php echo $row["StudentLastName"];
	   ?></td><td><?php echo $row["StudentFirstName"];
	   ?></td><td><?php if($row["Senator"]==1){ ?><span class="glyphicon glyphicon-ok"></span><?php } else { ?><span class="glyphicon glyphicon-remove"></span><?php }
	   ?></td><td><form action="../actions/actionchangesenatorstatus.php" method="post"><input type="hidden" name="useremail" value="<?php echo $row["EmailAddress"]; ?>"> <input type="hidden" name="newstatus" value="1"><input type="submit" value="Change Status" /> </form></td></tr>
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
<?php include "../template/bottom.php" ?>
