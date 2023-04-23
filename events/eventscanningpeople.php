<?php require "../login/loginheader.php"; ?>
<?php require "../login/permissions/level4.php"; ?>
<?php include "../template/top.php"; ?>
<div id="about" class="container-fluid">
      <div class="row">
              <div class="col-sm-1">
    </div>
    <div class="col-sm-10">
        <h2>Penmen Pride Event Scanning People List</h2>
<table class="table table-striped">


      <col width="10%">
  <col width="35%">
      <col width="15%">
  <col width="6%">
      <col width="7%">
      <col width="7%">
  <col width="20%">
  <thead>
<tr>
  <th>Delete
  </th>
  <th>Event ID
</th>
<th>Event Name
</th>
<th>Event Date
</th>
<th>Event Host
</th>
<th>Scanner First Name
</th>
<th>Scanner Last Name
</th>
<th>Scanner Username
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

$sql = "SELECT * FROM ppv0008003.scanningeventsandpeople;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       ?><tr><td><a href=/actions/actiondeletescannerperson.php?personscannerid=<?php echo $row["idscanningpeople"];?> target="_blank"><div class="linkbuttontopublic">Delete</div></a></td><td> <?php echo $row["eventid"];
	   ?></td><td><?php echo $row["eventname"];
	   ?></td><td><?php echo $row["eventdate"];
	   ?></td><td><?php echo $row["hostname"];
	   ?></td><td><?php echo $row["firstname"];
     ?></td><td><?php echo $row["lastname"];
	   ?></td><td><?php echo $row["username"];
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
