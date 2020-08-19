<?php

   include("dbconfig.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      
      // put new password into users database

      $id = $_POST['id'];
      $newpassword = $_POST['newpassword'];
      $hashedpassword = password_hash($newpassword, PASSWORD_DEFAULT);
      $sqlString = "UPDATE users SET recoverycode = '', password = '" . $hashedpassword . "' WHERE id=" . $id;

      $query = mysqli_query($dbconnect, $sqlString)
        or die (mysqli_error($dbconnect));
      }else {
         $error = "Error - cannot change password.";
      }
   
?>
<html>
   
   <head>
      <title>Password Recovery Page</title>
   </head>
   
   <body bgcolor = "#FFFFFF">
	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Your password has changed.  Please click below to return to the login page.</b></div>
				
            <div style = "margin:30px">
               
               <form action = "index.php">
                  <input type = "submit" value = " Return to login page "/><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>