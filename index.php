<?php
// Make sure the user is logged in.
require 'auth.php';

// Connect to database.
include 'dbconfig.php';
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>

  <style>

    h1 {
      background-color: black;
      color: white;
    }
    table {
      border-collapse: collapse;
    }
    table, th, td {
      border: 1px solid black;
    }  
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
  </style>

</head>

<body>

<h1>Doug's Weekly Workout Schedule</h1>
<table>
<tr>
  <td>Action</td>
  <td>Weekday</td>
  <td>Hours Needed</td>
  <td>Workout Details</td>
</tr>


<?php

$query = mysqli_query($dbconnect, "SELECT * FROM daily_workouts")
   or die (mysqli_error($dbconnect));

while ($row = mysqli_fetch_array($query)) {
  echo
   "<tr>
    <td>
      <form style='display: inline' action='databaseaction.php' method='get'>
        <input type='hidden' name='action' value='deleteWorkout'>
        <button name='workoutID' type='submit' value={$row['id']}>Delete</button>  
      </form>
      <a href=\"editworkout.php?workoutID={$row['id']})\">
        <button>Edit</button>
      </a>
    </td>
    <td>{$row['weekday']}</td>
    <td>{$row['hours']}</td>
    <td>{$row['details']}</td>
   </tr>\n";
}

?>

<tr>
  <td>
    <form style='display: inline' action="databaseaction.php" id="form1" method="get">
      <input type="hidden" name="action" value="addWorkout">
      <input type="submit" value="Add workout">
    </form>    
  </td>
  <td><input type="text" name="weekday" form="form1"></td>
  <td><input type="text" name="hours" form="form1"></td>
  <td><input type="text" name="details" form="form1"></td>
<tr>

</table>

<form style='display: inline' action='logout.php'>
  <button type='submit'>Log out</button>  
</form>


</html>