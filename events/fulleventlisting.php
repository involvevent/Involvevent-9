<?php require "../login/loginheader.php"; ?>
<?php require "../login/permissions/level3.php"; ?>
<?php include "../template/top.php"; ?>
<div id="about" class="container-fluid">
      <div class="row">
              <div class="col-sm-1">
              </div>
              <div class="col-sm-10">
                <h2>Penmen Pride Event Listing</h2>
                  <table class="tabledisplay">
                    <thead>
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
                        <th>Edit Event</th>
                      </tr>
                    </thead>
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
    while ($row = $result->fetch_assoc()) { ?><tr>
            <td><?php echo $row["EventID"]; ?></td>
            <td><?php echo $row["EventName"]; ?></td>
            <td><?php echo $row["EventDate"]; ?></td>
            <td><?php echo $row["eventLocation"]; ?></td>
            <td><?php echo $row["semester"]; ?></td>
            <td><?php echo $row["PointValue"]; ?></td>
            <td><?php echo $row["DoublePoints"]; ?></td>
            <td><?php echo $row["DoNotTotal"]; ?></td>
            <td><?php echo $row["EventTypeName"]; ?></td>
            <td><?php echo $row["HostName"]; ?></td>
            <td><div id="id01" class="modal">
  <span onclick="document.getElementById('modal_id_<?php echo $row[
      "EventID"
  ]; ?>').style.display='none'" class="close" title="Close Modal">×</span>
  <form class="modal-content" action="/action_page.php">
    <div class="container">
    <form action="actionediteventinformation.php" method="post">
<?php
// TODO: Post Field Verification
$eventname = $_POST["event"];
if (is_numeric($eventname)) {
    require "../mysqlkeys.php"; // Create connection
    $conn = new mysqli($host, $user, $password, $dbname); // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql =
        "SELECT * FROM ppv0008003.eventnames join eventhosts on eventnames.hostid=eventhosts.hostid where eventid=" .
        $eventname .
        ";";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while (
            $row = $result->fetch_assoc()
        ) { ?> <input type="hidden" name="eventid" value="<?php echo $eventname; ?>">
            <table class="table table-striped">
         <tr>
<th rowspan="2">Event Name</th>
           <td><input type="radio" name="checkeventname" value="0" checked> No Change</td>
           <td><label>The event name is currently listed as: &nbsp;&nbsp;</label><?php echo $row[
               "EventName"
           ]; ?> </td>
           </tr>
           <tr>
             <td><input type="radio" name="checkeventname" value="1"> Change</td>
            <td><label> New Event Name:   </label> <input type="text" name="eventname"/>
      </td>
    </tr>
    <tr>
      <th rowspan="2">Event Date</th>
      <td><input type="radio" name="checkeventdate" value="0" checked> No Change</td>
      <td><label>The event date is currently listed as: &nbsp;&nbsp;</label><?php echo $row[
          "EventDate"
      ]; ?> </td>
    </tr>
    <tr>
      <td><input type="radio" name="checkeventdate" value="1"> Change</td>
     <td><label> New Event Date:   </label> <input type="text" id="datepicker" name="eventdate"></td>
     </tr>
     <tr>
       <th rowspan="2">Event Location</th>
       <td><input type="radio" name="checkeventloc" value="0" checked> No Change</td>
       <td><label>The event date is currently listed as: &nbsp;&nbsp;</label><?php echo $row[
           "eventLocation"
       ]; ?> </td>
     </tr>
     <tr>
       
       <td><input type="radio" name="checkeventloc" value="1"> Change</td>
      <td><label> New Event Location:   </label> <input type="text" name="eventloc"></td>
      </tr>
     <tr>
      <th rowspan="2">Event Points</th>
      <td><input type="radio" name="checkpointvalue" value="0" checked> No Change</td>
      <td><label>The event point value is currently listed as: &nbsp;&nbsp;</label><?php echo $row[
          "PointValue"
      ]; ?> point(s)</td>
    </tr>
    <tr>
      <td><input type="radio" name="checkpointvalue" value="1"> Change</td>
      <td><label> New Point Value:   </label> <select name="pointvalue">
      <option value="0">0</option>
       <option value="1">1</option>
       <option value="2">2</option>
       <option value="3">3</option>
       <option value="4">4</option>
       <option value="5">5</option>
       <option value="6">6</option>
       

       
     </select></td>
   </tr>
   <tr>
     <th rowspan="2">Event Double Points</th>
     <td><input type="radio" name="checkdoublepoints" value="0" checked> No Change</td>
     <td><label>The event double points toggle is currently listed as: &nbsp;&nbsp;</label><?php if (
         $row["DoublePoints"] == 0
     ) {
         echo "Not Double Points";
     } else {
         echo "Double Points";
     } ?> </td>
     </tr>
     <tr>
       <td><input type="radio" name="checkdoublepoints" value="1"> Change</td>
      <td><label>New Double Points Marker:   </label> <select name="doublepoints">
       <option value="0">Not Double Points</option>
       <option value="1">Double Points</option>
       </select>
     </td>
   </tr>
   <tr>
     <th rowspan="2">Semester Giveaway</th>
     <td><input type="radio" name="checkgiveaway" value="0" checked> No Change</td>
     <td><label>The event semester giveaway toggle is currently listed as: &nbsp;&nbsp;</label><?php if (
         $row["SemesterGiveaway"] == 0
     ) {
         echo "Not Semester Giveaway (Normal Event)";
     } else {
         echo "Semester Giveaway";
     } ?> </td>
          </tr>
          <tr>
            <td><input type="radio" name="checkgiveaway" value="1"> Change</td>
            <td><label>New Semester Giveaway Marker:   </label> <select name="semestergiveaway">
       <option value="0">Not Semester Giveaway</option>
       <option value="1">Semester Giveaway</option>
     </select> </td>
   </tr>
   <tr><th rowspan="2">Do Not Total</th>
   <td><input type="radio" name="checkdonottotal" value="0" checked> No Change</td>
   <td><label>The event do not total toggle is currently listed as: &nbsp;&nbsp;</label><?php if (
       $row["DoNotTotal"] == 0
   ) {
       echo "Normal Totaling (Normal Event)";
   } else {
       echo "Do Not Total";
   } ?> </td>
          </tr>
          <tr>
            <td><input type="radio" name="checkdonottotal" value="1"> Change</td>
            <td><label>New Do Not Total Marker:   </label> <select name="donottotal">
       <option value="0">Normal Totaling</option>
       <option value="1">Do Not Total</option>
     </select></td>
   </tr>
   <tr>
    <th rowspan="2">Event Host</th>
     <td><input type="radio" name="checkeventhost" value="0" checked> No Change</td>
     <td><label>The event host is currently listed as: &nbsp;&nbsp;</label> <?php echo $row[
         "HostName"
     ]; ?> </td>
     </tr>
     <tr>
       <td><input type="radio" name="checkeventhost" value="1"> Change</td>
       <td><label>New Event Host:   </label>
       <select name="hostname">
       <?php
       $query = "select * from eventhosts order by HostName;";
       $results = mysqli_query($conn, $query);
       foreach ($results as $HostName) { ?>
       <option value="<?php echo $HostName["HostID"]; ?>"><?php echo $HostName[
    "HostName"
]; ?></option>
       <?php }
       ?>
       </select> </td>
     </tr>
     <tr>
      <th rowspan="2">Event Type</th>
       <td><input type="radio" name="checkeventtype" value="0" checked> No Change</td>
       <td><label>The event type is currently listed as: &nbsp;&nbsp;</label> <?php echo $row[
           "EventType"
       ]; ?> </td>
       </tr>
       <tr>
         <td><input type="radio" name="checkeventtype" value="1"> Change</td>
         <td><label>New Event Type:   </label>
         <select name="eventtype">
           <?php
           require "../mysqlkeys.php";
           $con = mysqli_connect($host, $user, $password, $dbname);
           if (mysqli_connect_errno()) {
               echo "Failed to connect:" . mysqli_connect_errno();
           }
           $query = "select * from eventtypes;";
           $results = mysqli_query($con, $query);
           foreach ($results as $HostName) { ?>
           <option value="<?php echo $HostName[
               "IDEventTypes"
           ]; ?>"><?php echo $HostName["EventTypeName"]; ?></option>
           <?php }
           ?>
         </select> </td>
       </tr>
   </table>
       <script>
 $( function() {
   $( "#datepicker" ).datepicker();
 } );
 </script>
     <?php // echo $row["HostID"];

            }
    } else {
    }
    $conn->close();
}
?>
<p> <input type="submit" /> </p>
</form>
    </div>
  </form>
</div>
<form action="/actions/editeventinformation.php" method="post">
  <input type="hidden" name="event" value="<?php echo $row["EventID"]; ?>">
  <input type="submit" value="Edit">
</form></td>
          </tr><?php }
} else {
}
$conn->close();
?>
<tfoot>
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
</tfoot>
</table>
        </div>
    <div class="col-sm-1">
    </div>
  </div>
</div>
<?php include "../template/bottom.php"; ?>
