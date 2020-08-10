<?php

// Connect to database.
include 'dbconfig.php';

$workoutID = $_GET['workoutID']; // Database index for me to work on
$sqlString = "SELECT * FROM daily_workouts WHERE id=".$workoutID;
$query = mysqli_query($dbconnect, $sqlString)
  or die (mysqli_error($dbconnect));
$row = mysqli_fetch_array($query);

echo 
 "<link rel='stylesheet' type='text/css' href='style.css'>

 <h1>Please edit this workout and click 'Save Changes'.</h1> 
  <table>
  <tr>
    <td>Action</td>
    <td>Weekday</td>
    <td>Hours Needed</td>
    <td>Workout Details</td>
  </tr>
  <tr>
  <td>
    <form style='display: inline' action='databaseaction.php' id='form1' method='get'>
      <input type='hidden' name='action' value='editWorkout'>
      <input type='hidden' name='workoutID' value=" . $workoutID . ">
      <input type='submit' value='Save changes'>
    </form>    
  </td>
  <td><input type='text' name='weekday' form='form1' value='" . $row['weekday'] . "'></td>
  <td><input type='text' name='hours' form='form1' value='" . $row['hours'] . "'></td>
  <td><input type='text' name='details' form='form1' value='" . $row['details'] . "'></td>
  </tr>
</table>"

?>