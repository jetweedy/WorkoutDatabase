<?php

// Connect to database.
include 'dbconfig.php';

// What action has been requested?
$action = $_POST['action'];

switch ($action) {
  // Delete a workout row from the daily_workouts table
  case 'deleteWorkout':
    $workoutID = $_POST['workoutID']; // Database index for me to work on
    $sqlString = "DELETE FROM daily_workouts WHERE id=".$workoutID;
    $query = mysqli_query($dbconnect, $sqlString)
      or die (mysqli_error($dbconnect));
 	break;

    // Add a new row to the daily_workouts table
  case 'addWorkout':
    $newWeekday = $_POST['weekday'];
    $newHours = $_POST['hours'];
    $newDetails = $_POST['details'];
    $sqlString = "INSERT INTO daily_workouts(weekday,hours,details) VALUES ('".$newWeekday.
    "','".$newHours."','".$newDetails."')";
    $query = mysqli_query($dbconnect, $sqlString)
      or die (mysqli_error($dbconnect));
    break;

  // Update data in a row of the daily_workouts table with the id $workoutID
  case 'editWorkout':
    $workoutID = $_POST['workoutID']; // Database index for me to work on
    $updatedWeekday = $_POST['weekday'];
    $updatedHours = $_POST['hours'];
    $updatedDetails = $_POST['details'];
    $sqlString = "UPDATE daily_workouts SET weekday='" . $updatedWeekday . 
      "', hours='" . $updatedHours . "', details='" . $updatedDetails . 
      "' WHERE id=" . $workoutID;
    $query = mysqli_query($dbconnect, $sqlString)
      or die (mysqli_error($dbconnect));
    break;
 	
  default:
 		// Nothing here here right now.
  break;
} 

// Go back to workouts display.
header('location: /index.php');

?>