<?php

$newWeekday = $_GET['weekday'];
$newHours = $_GET['hours'];
$newDetails = $_GET['details'];

$hostname = "localhost";
$username = "dlargent";
$password = "asdfjkl";
$db = "workouts";

$dbconnect=mysqli_connect($hostname,$username,$password,$db);

if ($dbconnect->connect_error) {
  die("Database connection failed: " . $dbconnect->connect_error);
}

$sqlString = "INSERT INTO daily_workouts(weekday,hours,details) VALUES ('".$newWeekday."','".$newHours."','".$newDetails."')";
$query = mysqli_query($dbconnect, $sqlString)
   or die (mysqli_error($dbconnect));

?>

<script type="text/javascript">
 location.href = "index.php";
</script>