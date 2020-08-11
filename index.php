<?php
// Make sure the user is logged in.  This also connects to the database.
require 'auth.php';
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

<h1>Welcome 
  <?php echo $login_name;
    if ($login_isAdmin) {
      echo " - Admin User";
    } 
  ?></h1>
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
      <form style='display: inline' action='databaseedit.php' method='get'>
        <button name='workoutID' type='submit' value={$row['id']}>Edit</button>  
      </form>
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
      <input type="submit" value="Add new workout">
    </form>    
  </td>
  <td><input type="text" name="weekday" form="form1"></td>
  <td><input type="text" name="hours" form="form1"></td>
  <td><input type="text" name="details" form="form1"></td>
<tr>

</table>

<?php

  if ($login_isAdmin) {
      echo 
      "<br>
      <br>
      <form style='display: inline' action='admin.php'>
        <button type='submit'>Manage users</button>  
      </form>";
    }
      
?>

<br>
<br>

<form style='display: inline' action='logout.php'>
  <button type='submit'>Log out</button>  
</form>


</html>