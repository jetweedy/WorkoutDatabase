<?php

// Connect to database.
include 'dbconfig.php';

$action = $_GET['action'];  // What I'm supposed to do

switch ($action) {
 	case 'deleteUser':
 	  $id = $_GET['id']; // Database index for me to work on
      $sqlString = "DELETE FROM users WHERE id=".$id;
      $query = mysqli_query($dbconnect, $sqlString)
        or die (mysqli_error($dbconnect));
 		break;

    case 'addUser':
      $newUsername = $_GET['username'];
      $newPassword = $_GET['password'];
      $newFirstname = $_GET['firstname'];
      $newLastname = $_GET['lastname'];
      $newIsadmin = $_GET['isadmin'];

      $adminText = 0;
      if ($newIsadmin == "true") {
        $adminText = 1;
      }

      $sqlString = "INSERT INTO users(username,password,isAdmin,firstname,lastname)VALUES ('" . $newUsername . "','" .$newPassword . "','" . $adminText . "','" . $newFirstname . "','" . $newLastname . "')";
      $query = mysqli_query($dbconnect, $sqlString)
        or die (mysqli_error($dbconnect));
        break;

    case 'editUser':
 	  $id = $_GET['id']; // Database index for me to work on
      $updatedFirstname = $_GET['firstname'];
      $updatedLastname = $_GET['lastname'];
      $updatedUsername = $_GET['username'];
      $updatedPassword = $_GET['password'];
      $updatedIsadmin = $_GET['isadmin'];
      $sqlString = "UPDATE users SET username='" . $updatedUsername . 
      "', password='" . $updatedPassword . "', firstname='" . $updatedFirstname . "', lastname='" 
      . $updatedLastname . "', isAdmin='" . $updatedIsadmin . "' WHERE id=" . $id;
      $query = mysqli_query($dbconnect, $sqlString)
        or die (mysqli_error($dbconnect));
        break;
 	
 	default:
 		// Nothing here here right now...
 		break;
 } 

 header('location: /admin.php');

?>