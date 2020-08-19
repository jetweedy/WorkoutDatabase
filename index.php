<?php
// Make sure the user is logged in.  This also connects to the database.
require 'auth.php';
?>

<!-- This is the main page of the website.  It has a personalized
  greeting at the top of the page, and then lists daily workouts.
  There are buttons to edit or delete each workout, as well as empty
  fields to enter information to add an additional workout. 
  Finally, there are buttons to edit user list (for admins), and 
  a logout button. -->

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

<!-- Display personalized greeting. -->
<h1>Welcome 
  <?php echo $login_name;
    if ($login_isadmin) {
      echo " - Admin User";
    } 
  ?></h1>

<!-- This table has a row containing column titles, and then the table
  is filled with data from the daily_workouts table on the database.
  Each row has a button that calls a function to delete or edit the row.
  The last row in the table contains a form that allows the user to add
  an additional daily workout routine. -->  
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

// Loop through the records and print them to a table.  Create buttons to
// edit or delete the rows.
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

<!-- The final row in the table contains a form to create a new workout. -->
<tr>
  <td>
    <form style='display: inline' action="databaseaction.php" id="form1" method="post">
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

// Only if the user is an admin, create button to edit users.
  if ($login_isadmin) {
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

<!-- Logout button -->
<form style='display: inline' action='logout.php'>
  <button type='submit'>Log out</button>  
</form>


</html>