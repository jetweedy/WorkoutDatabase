<?php

// Connect to database.
include 'dbconfig.php';

$action = $_GET['action'];  // What I'm supposed to do

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

    case 'editWorkout':
 	  $workoutID = $_GET['workoutID']; // Database index for me to work on
      $updatedWeekday = $_GET['weekday'];
      $updatedHours = $_GET['hours'];
      $updatedDetails = $_GET['details'];
      $sqlString = "UPDATE daily_workouts SET weekday='" . $updatedWeekday . 
      "', hours='" . $updatedHours . "', details='" . $updatedDetails . 
      "' WHERE id=" . $workoutID;
      $query = mysqli_query($dbconnect, $sqlString)
        or die (mysqli_error($dbconnect));
        break;
 	
 	default:
 		// Nothing here here right now...
 		break;
 } 

 header('location: /index.php');

?>