<?php require "../login/loginheader.php"; ?>
<?php require "../login/permissions/level6.php"; ?>
<?php include "../template/top.php"; ?>
<div id="about" class="container-fluid">
      <div class="row">
              <div class="col-sm-1">
    </div>
    <div class="col-sm-10">
        <h2>Penmen Pride Time Information</h2>
        <h3>Years</h3>
<table class="table table-striped">
      <col width="30%">
  <col width="25%">
      <col width="25%">
      <col width="25%">
<tr>
<th>School Year
</th>
<th>Begin Year
</th>
<th>End Year
</th>
<th>Edit School Year
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

$sql = "SELECT years.SchoolYear, years.begin, years.end from years;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       ?><tr><td> <?php echo $row["SchoolYear"];
	   ?></td><td><?php echo $row["begin"];
	   ?></td><td><?php echo $row["end"];
     ?></td><td><?php echo $row["begin"];
	   ?></td></tr><?php
    }
} else {

}
$conn->close();
?>
</table>
<h3>Semesters</h3>
<table class="table table-striped">
<col width="16%">
<col width="14%">
<col width="14%">
<col width="14%">
<col width="14%">
<col width="14%">
<col width="14%">
<tr>
<th>Semester
</th>
<th>School Year
</th>
<th>Semester Code
</th>
<th>Begin Date
</th>
<th>End Date
</th>
<th>Goal
</th>
<th>Semester Type
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

$sql = "SELECT semester.Semester, semester.BeginDate, semester.EndDate, semester.Goal, semester.SchoolYear, semester.SemType, semester.SemShort, semester.SemIDNum from semester;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
?><tr><td> <?php echo $row["Semester"];
?></td><td><?php echo $row["SchoolYear"];
?></td><td><?php echo $row["SemShort"];
?></td><td><?php echo $row["BeginDate"];
?></td><td><?php echo $row["EndDate"];
?></td><td><?php echo $row["Goal"];
?></td><td><?php echo $row["SemType"];
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