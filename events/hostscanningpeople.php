<?php require "../login/loginheader.php"; ?>
<?php require "../login/permissions/level4.php"; ?>
<?php include "../template/top.php"; ?>
<div id="about" class="container-fluid">
      <div class="row">
              <div class="col-sm-1">
    </div>
    <div class="col-sm-10">
        <h2>Penmen Pride Host Scanning People List</h2>
<table class="table table-striped">
      <col width="10%">
  <col width="10%">
      <col width="32%">
  <col width="16%">
      <col width="16%">
      <col width="16%">
      <thead>
<tr>
  <th>Delete
  </th>
  <th>Host ID
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

$sql = "SELECT * FROM ppv0008003.scanningeventsandhosts;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       ?><tr><td><a href=/actions/actiondeletescannerhost.php?hostscannerid=<?php echo $row["idscanninghostmember"];?> target="_blank"><div class="linkbuttontopublic">Delete</div></a></td><td> <?php echo $row["hostid"];
	   ?></td><td><?php echo $row["HostName"];
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
