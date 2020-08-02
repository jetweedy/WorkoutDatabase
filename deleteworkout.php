<?php

$workoutID = $_GET['workoutID'];

$hostname = "localhost";
$username = "dlargent";
$password = "asdfjkl";
$db = "workouts";

$dbconnect=mysqli_connect($hostname,$username,$password,$db);

if ($dbconnect->connect_error) {
  die("Database connection failed: " . $dbconnect->connect_error);
}

$sqlString = "DELETE FROM daily_workouts WHERE id=".$workoutID;
$query = mysqli_query($dbconnect, $sqlString)
  or die (mysqli_error($dbconnect));

?>

<script type="text/javascript">
   location.href = "index.php";
</script>