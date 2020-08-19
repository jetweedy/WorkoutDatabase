<?php

session_start();

// Connect to database.
include 'dbconfig.php';

$action = $_POST['action'];  // Which action has been requested

switch ($action) {

  // Handle the logic for logging in a user.
  case 'login':
    $myusername = mysqli_real_escape_string($dbconnect,$_POST['username']);
    $mypassword = mysqli_real_escape_string($dbconnect,$_POST['password']);

    $sql = "SELECT * FROM users WHERE username = '$myusername'";

    $result = mysqli_query($dbconnect,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);
    if (($count == 1) && (password_verify($_POST['password'], $row['password']))) {
       $_SESSION['login_user'] = $myusername;
       header("location: /index.php");
    } else {
       $_SESSION['login_error'] = "Your Login Name or Password is invalid";
       header("location: /login.php");
    }
    break;

  // Register a new user.
  case 'registernewuser':
    $myusername = mysqli_real_escape_string($dbconnect,$_POST['username']);
    $mypassword = mysqli_real_escape_string($dbconnect,$_POST['password']); 
    $myfirstname = mysqli_real_escape_string($dbconnect,$_POST['firstname']); 
    $mylastname = mysqli_real_escape_string($dbconnect,$_POST['lastname']); 
    $myemail = mysqli_real_escape_string($dbconnect,$_POST['email']); 
    $hashedpassword = password_hash($mypassword, PASSWORD_DEFAULT);
    $sqlString = "INSERT INTO users (username, password, isadmin, firstname, lastname, email) VALUES ('" .
        $myusername . "','" . $hashedpassword . "',false,'" . $myfirstname . "','" . $mylastname . "','" .
          $myemail . "')";
        
    $query = mysqli_query($dbconnect, $sqlString)
      or die (mysqli_error($dbconnect));
    
    // Now log the new user in.

    $sql = "SELECT id FROM users WHERE username = '$myusername' and password = '$hashedpassword'";
    $result = mysqli_query($dbconnect,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);
      
    // If result matched $myusername and $mypassword, table row must be 1 row
    
    if($count == 1) {
       $_SESSION['login_user'] = $myusername;
       header("location: /index.php");
    }else {
       $error = "Your Login Name or Password is invalid";
    }

    break;


  // Delete the user with id $id from the database
 	case 'deleteUser':
 	  $id = $_POST['id'];
      $sqlString = "DELETE FROM users WHERE id=".$id;
      $query = mysqli_query($dbconnect, $sqlString)
        or die (mysqli_error($dbconnect));
        header('location: /admin.php');
 		break;

  // Adds a new user with all personal info into a database row.
  // Hash the password on the way in.  If the new user has admin
  // status, set the 'isadmin' flag to 1 
  case 'addUser':
    $newUsername = $_POST['username'];
    $newPassword = $_POST['password'];
    $newFirstname = $_POST['firstname'];
    $newLastname = $_POST['lastname'];
    $newEmail = $_POST['email'];
    $newIsadmin = $_POST['isadmin'];
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $adminText = 0;
    if ($newIsadmin == "true") {
      $adminText = 1;
    }
    $sqlString = "INSERT INTO users(username,password,isadmin,firstname,lastname,email)VALUES ('" . $newUsername . "','" .$hashedPassword . "','" . $adminText . "','" . $newFirstname . "','" . $newLastname . "','" . $newEmail . "')";

    $query = mysqli_query($dbconnect, $sqlString)
      or die (mysqli_error($dbconnect));
      header('location: /admin.php');

    break;

  // This updates a row in the users table based on updated information
  // sent from a form.
  case 'editUser':
 	  $id = $_POST['id'];
    $updatedFirstname = $_POST['firstname'];
    $updatedLastname = $_POST['lastname'];
    $updatedUsername = $_POST['username'];
    $updatedEmail = $_POST['email'];
    $updatedIsadmin = $_POST['isadmin'];
    $sqlString = "UPDATE users SET username='" . $updatedUsername . 
      "', firstname='" . $updatedFirstname . "', lastname='" 
      . $updatedLastname . "', isadmin='" . $updatedIsadmin . "', email='" . $updatedEmail . "' WHERE id=" . $id;
    $query = mysqli_query($dbconnect, $sqlString)
      or die (mysqli_error($dbconnect));
      header('location: /admin.php');
    break;

 	default:
 		// No default action for this switch.
 		break;
 } 

?>