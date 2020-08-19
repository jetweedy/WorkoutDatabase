<?php

// Connect to database.
include 'dbconfig.php';

// Pull the information for the requested user from the users database table.
$id = $_POST['id']; 
$sqlString = "SELECT * FROM users WHERE id=".$id;
$query = mysqli_query($dbconnect, $sqlString)
  or die (mysqli_error($dbconnect));
$row = mysqli_fetch_array($query);

// Create a table to display a form where the admin user can edit user info.
// POST the info to my adminaction.php page.
echo 
  "<link rel='stylesheet' type='text/css' href='style.css'>

  <h1>Please edit this user's information and click 'Save Changes'.</h1> 
  <table>
  <tr>
  <td>Action</td> 
  <td>First Name</td>
  <td>Last Name</td>
  <td>UserName</td>
  <td>Email</td>
  <td>Admin? (1=yes, 0=no)</td>
  </tr>

  <tr>
  <td>
    <form style='display: inline' action='adminaction.php' id='form1' method='POST'>
      <input type='hidden' name='action' value='editUser'>
      <input type='hidden' name='id' value=" . $id . ">
      <input type='submit' value='Save changes'>
    </form>    
  </td>
  <td><input type='text' name='firstname' form='form1' value='" . $row['firstname'] . "'></td>
  <td><input type='text' name='lastname' form='form1' value='" . $row['lastname'] . "'></td>
  <td><input type='text' name='username' form='form1' value='" . $row['username'] . "'></td>
  <td><input type='text' name='email' form='form1' value='" . $row['email'] . "'></td>
  <td><input type='text' name='isadmin' form='form1' value='" . $row['isadmin'] . "'></td>
  </tr>
</table>"

?>