<?php

// Connect to database.
include 'dbconfig.php';

$action = $_GET['action'];  // Which action has been requested

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
      $newEmail = $_GET['email'];
      $newIsadmin = $_GET['isadmin'];
      $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

      $adminText = 0;
      if ($newIsadmin == "true") {
        $adminText = 1;
      }

      $sqlString = "INSERT INTO users(username,password,isadmin,firstname,lastname,email)VALUES ('" . $newUsername . "','" .$hashedPassword . "','" . $adminText . "','" . $newFirstname . "','" . $newLastname . "','" . $newEmail . "')";

      $query = mysqli_query($dbconnect, $sqlString)
        or die (mysqli_error($dbconnect));
        break;

    case 'editUser':
 	  $id = $_GET['id']; // Database index for me to work on
      $updatedFirstname = $_GET['firstname'];
      $updatedLastname = $_GET['lastname'];
      $updatedUsername = $_GET['username'];
      $updatedEmail = $_GET['email'];
      $updatedIsadmin = $_GET['isadmin'];
      $sqlString = "UPDATE users SET username='" . $updatedUsername . 
      "', firstname='" . $updatedFirstname . "', lastname='" 
      . $updatedLastname . "', isadmin='" . $updatedIsadmin . "', email='" . $updatedEmail . "' WHERE id=" . $id;


      $query = mysqli_query($dbconnect, $sqlString)
        or die (mysqli_error($dbconnect));
        break;
 	default:
 		// Nothing here here right now...
 		break;
 } 

// go back to edit users page
 header('location: /admin.php');

?>