<?php require "../login/loginheader.php"; ?>
<?php require "../login/permissions/level3.php"; ?>
<?php include "../template/top.php"; ?>
<div id="about" class="container-fluid">
      <div class="row">
              <div class="col-sm-1">
    </div>
    <div class="col-sm-10">
        <h2>Penmen Pride Host Listing</h2>
<table class="tabledisplay">
<thead>
  <tr>
    <th>Host Name
    </th>

  <th>Host Type
  </th>
  <th>Host Email
  </th>
  <th>Host ID
  </th>
  <th>Host Inactive
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

$sql = "SELECT * FROM ppv0008003.eventhosts order by HostName";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       ?><tr><td><?php echo $row["HostName"];
	   ?></td><td><?php echo $row["HostType"];
	   ?></td><td><a href="mailto:<?php echo $row["HostEmail"]; ?>"><?php echo $row["HostEmail"]; ?></a></td><td> <?php echo $row["HostID"];
   ?></td><td><?php if( $row["HostInactive"]==1){ echo 'Yes';} else{ echo 'No';};
	   ?></td></tr><?php
    }
} else {

}
$conn->close();
?>
<tfoot>
<tr>
  <th>Host Name
  </th>

<th>Host Type
</th>
<th>Host Email
</th>
<th>Host ID
</th>
<th>Host Inactive
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
