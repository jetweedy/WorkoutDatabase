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

  <script type="text/javascript">
    function deleteWorkout(workoutID) {
      location.href = "deleteworkout.php?workoutID="+workoutID;
    }
  </script>

</head>

<body>


<?php

$hostname = "localhost";
$username = "dlargent";
$password = "asdfjkl";
$db = "workouts";

$dbconnect=mysqli_connect($hostname,$username,$password,$db);

if ($dbconnect->connect_error) {
  die("Database connection failed: " . $dbconnect->connect_error);
}

?>


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
    <td><button onclick=\"deleteWorkout({$row['id']})\">Delete</button></td>
    <td>{$row['weekday']}</td>
    <td>{$row['hours']}</td>
    <td>{$row['details']}</td>
   </tr>\n";
}

?>

<tr>
  <td>
    <form action="addworkout.php" id="form1">
      <input type="submit" value="Add workout">
    </form>    
  </td>
  <td><input type="text" name="weekday" form="form1"></td>
  <td><input type="text" name="hours" form="form1"></td>
  <td><input type="text" name="details" form="form1"></td>
<tr>

</table>

</html>