<?php
// Make sure the user is logged in.  This also connects to the database.
require 'auth.php';

// Make sure the current user has admin authorization
if(!login_isadmin){
      header("location: /index.php");
      die();
   }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

<h1>Manage users</h1>

<table>
<tr>
  <td>Action</td>	
  <td>First Name</td>
  <td>Last Name</td>
  <td>UserName</td>
  <td>Email</td>
  <td>Admin? (1=yes, 0=no)</td>
</tr>

<?php

$query = mysqli_query($dbconnect, "SELECT * FROM users")
   or die (mysqli_error($dbconnect));

while ($row = mysqli_fetch_array($query)) {
  echo
   "<tr>
    <td>
      <form style='display: inline' action='adminaction.php' method='get'>
        <input type='hidden' name='action' value='deleteUser'>
        <button name='id' type='submit' value={$row['id']}>Delete</button>  
      </form>
      <form style='display: inline' action='adminedituser.php' method='get'>
        <button name='id' type='submit' value={$row['id']}>Edit</button>  
      </form>
    </td>
    <td>{$row['firstname']}</td>
    <td>{$row['lastname']}</td>
    <td>{$row['username']}</td>
    <td>{$row['email']}</td>
    <td>{$row['isadmin']}</td>
    </tr>\n";
}

?>

<tr>
  <td>
    <form style='display: inline' action="adminaction.php" id="form1" method="get">
      <input type="hidden" name="action" value="addUser">
      <input type="submit" value="Add new user">
    </form>    
  </td>
  <td><input type="text" name="firstname" form="form1"></td>
  <td><input type="text" name="lastname" form="form1"></td>
  <td><input type="text" name="username" form="form1"></td>
  <td><input type="text" name="email" form="form1"></td>
  <td><input type="text" name="isadmin" form="form1"></td>
<tr>

</table>

<br>
<br>

<form style='display: inline' action='index.php'>
  <button type='submit'>Return to workouts</button>  
</form>

<br>
<br>

<form style='display: inline' action='logout.php'>
  <button type='submit'>Log out</button>  
</form>


</html>