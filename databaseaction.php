<?php

$action = $_GET['action'];  // What I'm supposed to do

$hostname = "localhost";
$username = "dlargent";
$password = "asdfjkl";
$db = "workouts";

$dbconnect=mysqli_connect($hostname,$username,$password,$db);

if ($dbconnect->connect_error) {
  die("Database connection failed: " . $dbconnect->connect_error);
}

switch ($action) {
 	case 'deleteWorkout':
 	  $workoutID = $_GET['workoutID']; // Database index for me to work on
      $sqlString = "DELETE FROM daily_workouts WHERE id=".$workoutID;
      $query = mysqli_query($dbconnect, $sqlString)
        or die (mysqli_error($dbconnect));
 		break;

    case 'addWorkout':
      $newWeekday = $_GET['weekday'];
      $newHours = $_GET['hours'];
      $newDetails = $_GET['details'];
      $sqlString = "INSERT INTO daily_workouts(weekday,hours,details) VALUES ('".$newWeekday.
      "','".$newHours."','".$newDetails."')";
      $query = mysqli_query($dbconnect, $sqlString)
        or die (mysqli_error($dbconnect));
        break;
 	
 	default:
 		// Nothing here here right now...
 		break;
 } 

?>

<script type="text/javascript">
   location.href = "index.php";
</script>