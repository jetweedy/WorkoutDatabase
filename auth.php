<?php
  include('dbconfig.php');
  session_start();

// Check to make sure a user is logged in.  If they aren't, go to the login page.
// Set a flag $login_isadmin to indicate admin priveleges.
// Set $login_name to enable pages to identify the user by name in dialogue.
  $user_check = $_SESSION['login_user'];
  $ses_sql = mysqli_query($dbconnect,"SELECT * FROM users where username = '$user_check' ");
  $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
  $login_session = $row['username'];
  $login_name = $row['firstname'] . " " . $row['lastname'];
  $login_isadmin = $row['isadmin'];
   
  if(!isset($_SESSION['login_user'])){
    header("location: /login.php");
    die();
  }
?>