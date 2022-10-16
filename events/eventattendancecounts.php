<?php require "../login/loginheader.php"; ?>
<?php require "../login/permissions/level3.php"; ?>
<?php include "../template/top.php"; ?>
<div id="about" class="container-fluid">
      <div class="row">
              <div class="col-sm-1">
    </div>
    <div class="col-sm-10">
        <h2>Penmen Pride Event Attendance Numbers</h2>
<table class="tabledisplay">
<thead>
<tr>
<th>Event ID
</th>
<th>Event Name
</th>
<th>Event Date
</th>
<th>Points
</th>
<th>Event Type
</th>
<th>Event Host
</th>
<th>Total Scanned
</th>
<th>Total Known
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

$sql = "SELECT * from eventattendancebothcounts;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       ?><tr><td> <?php echo $row["eventid"];
	   ?></td><td><?php echo $row["eventname"];
	   ?></td><td><?php echo $row["eventdate"];
	   ?></td><td><?php echo $row["pointvalue"];
	   ?></td><td><?php echo $row["EventTypeName"];
     ?></td><td><?php echo $row["hostname"];
	   ?></td><td><?php echo $row["scannercount"];
	   ?></td><td><?php echo $row["fulltranscount"];
	   ?></td></tr><?php
    }
} else {

}
$conn->close();
?>
<tfoot>
<tr>
<th>Event ID
</th>
<th>Event Name
</th>
<th>Event Date
</th>
<th>Points
</th>
<th>Event Type
</th>
<th>Event Host
</th>
<th>Total Scanned
</th>
<th>Total Known
</th>
</tr>
</tfoot>
</table>
        </div>
    <div class="col-sm-1">
    </div>
  </div>
</div>
<?php include "../template/bottom.php" ?>
