<?php require "../login/loginheader.php"; ?>
<?php require "../login/permissions/level3.php"; ?>
<?php include "../template/top.php"; ?>
<div id="about" class="container-fluid">
      <div class="row">
              <div class="col-sm-1">
    </div>
    <div class="col-sm-10">
        <h2>Penmen Pride Event Listing</h2>
<table id="datalisting" class="table table-striped">
      <col width="10%">
      <col width="25%">
      <col width="7%">
      <col width="10%">
      <col width="8%">
      <col width="6%">
      <col width="7%">
      <col width="7%">
      <col width="20%">
      <tr>
        <th>Event ID</th>
        <th>Event Name</th>
        <th>Event Date</th>
        <th>Event Location</th>
        <th>Semester</th>
        <th>Points</th>
        <th>Double Points</th>
        <th>Do Not Total</th>
        <th>Event Type</th>
        <th>Host Name</th>
      </tr>

<?php
require "../mysqlkeys.php"; // Create connection
$conn = new mysqli($host, $user, $password, $dbname); // Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql =
    "SELECT n.EventID, n.EventName, n.EventDate, n.PointValue, n.DoNotTotal, n.DoublePoints, t.EventTypeName, h.HostName, s.semester, n.eventLocation FROM eventnames n join eventhosts h on n.HostID=h.HostID join eventtypes t on t.ideventtypes=n.eventtype join datestosemesters d on n.EventDate=d.Date join semester s on d.semester=s.Semester order by n.EventDate DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      ?><tr>
          <td> <?php echo $row["EventID"]; ?></td>
          <td><?php echo $row["EventName"]; ?></td>
          <td><?php echo $row["EventDate"]; ?></td>
          <td><?php echo $row["eventLocation"]; ?></td>
          <td><?php echo $row["semester"]; ?></td>
          <td><?php echo $row["PointValue"]; ?></td>
          <td><?php echo $row["DoublePoints"]; ?></td>
          <td><?php echo $row["DoNotTotal"]; ?></td>
          <td><?php echo $row["EventTypeName"]; ?></td>
          <td><?php echo $row["HostName"]; ?></td>
        </tr><?php }
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
<?php include "../template/bottom.php"; ?>
