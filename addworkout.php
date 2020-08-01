
<?php

$newWeekday = $_GET['weekday'];
$newHours = $_GET['hours'];
$newDetails = $_GET['details'];


echo "Adding new workout to database: ", $newWeekday, ", ", $newHours, ", ", $newDetails;


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

	//(", $newWeekday, ",", $newHours, ",", $newDetails, ";")
   or die (mysqli_error($dbconnect));





?>