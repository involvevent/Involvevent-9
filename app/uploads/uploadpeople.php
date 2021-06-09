<?php require "login/loginheader.php"; ?>
<?php require "login/permissions/level3.php"; ?>
<?php include "template/top.php"; ?>
<div id="about" class="container-fluid">
      <div class="row">
          <div class="col-sm-2">
          </div>
    <div class="col-sm-8">
<?php
$fileurl="TEST";
   if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
$file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

      $expensions= array("txt");

      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }

      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"uploads/".$file_name);
         echo "Success";
      }else{
         //print_r($errors);
      }
	  $fileurl = "uploads/".$file_name;
	  $myopenfile;
   }

   if($fileurl!="TEST"){
	   $eventid= $_POST["eventid"];
   echo $fileurl;
$myfile = fopen($fileurl, "r") or die("Unable to open file!");
ini_set('max_execution_time', 300);
                    require 'mysqlkeys.php';
                    $conn = new mysqli($host, $user, $password, $dbname);
                         if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$insertdaystmt = "INSERT INTO `ppv0008003`.`scanner` (`EventID`, `Scanner`) VALUES (".$eventid.", '0000001');";
	  echo $insertdaystmt;
	  echo "<br>";
            if ($conn->query($insertdaystmt) === TRUE) {
            } else {
                echo "Error: " . $insertdaystmt . "<br>" . $conn->error;
            }
// Output one line until end-of-file
while(!feof($myfile)) {
  $line = fgets($myfile);
  $linelength = strlen($line);

  if($linelength==18){
	  $lineremove = str_replace(array("\r", "\n"), '', $line);
	  $insertdaystmt = "INSERT INTO `ppv0008003`.`scanner` (`EventID`, `Scanner`) VALUES (".$eventid.", '".$lineremove."');";
	  echo $insertdaystmt;
	  echo "<br>";
            if ($conn->query($insertdaystmt) === TRUE) {
            } else {
                echo "Error: " . $insertdaystmt . "<br>" . $conn->error;
            }
  }
}
fclose($myfile);
if (!unlink($fileurl))
  {
  echo "Error deleting". $fileurl;
  }
else
  {
  echo "Deleted".$fileurl;
  }
   }
?>

      <h2>Penmen Pride File Uploader</h2>
      <form action="" method="POST" enctype="multipart/form-data">
	  <p><label>Event: </label>
<select name="eventid">
<option value="">Select Event</option>
<?php
require 'mysqlkeys.php';
$con=mysqli_connect($host , $user , $password , $dbname );

if (mysqli_connect_errno()){
	echo "Failed to connect:".mysqli_connect_errno();
	}
$query = "SELECT * FROM ppv0008003.eventnames order by eventnames.EventDate DESC;";
$results=mysqli_query($con, $query);

foreach ($results as $HostName){

?>
<option value="<?php echo $HostName["EventID"]; ?>"><?php echo $HostName["EventID"]." - ".$HostName["EventDate"]." - ". $HostName["EventName"]; ?></option>
<?php
}

?>
</select></p>
          <p><label>File: </label>
              <input type="file" name="image" /></p>
         <input type="submit"/>
      </form>
        </div>
        <div class="col-sm-2">
          </div>
            </div>
</div>
      <?php include "template/bottom.php" ?>
