<?php
   include('dbconfig.php');
   session_start();

   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($dbconnect,"SELECT * FROM users where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];

   $login_name = $row['firstName'] . " " . $row['lastName'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
      die();
   }
?>