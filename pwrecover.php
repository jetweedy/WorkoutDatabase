<?php

   include("dbconfig.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // info sent from form 
      
      // Does this user exist and is the user unique
      $myusername = mysqli_real_escape_string($dbconnect,$_POST['username']);
      $myemail = mysqli_real_escape_string($dbconnect,$_POST['email']); 
      $sql = "SELECT * FROM users WHERE username = '$myusername' and email = '$myemail'";
      $result = mysqli_query($dbconnect,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $myid = $row['id'];
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $myemail, table row must be 1 row
      if($count == 1) {

        $recoverycode = bin2hex(random_bytes(8));
        $sqlString = "UPDATE users SET recoverycode = '" . $recoverycode . "' WHERE id=".
        $myid;


        $query = mysqli_query($dbconnect, $sqlString)
          or die (mysqli_error($dbconnect));
      echo 
        "<h1>Normally we would email this, but we're going to do this on a page for now.  Click the link below to recover your password:</h1>
        <a href='pwrecover2.php?recoverycode=" . $recoverycode . "'>Click Here</a>";
          die;

      } else {
         $error = "Your Login Name or Email is invalid";
      }
      
   }
?>
<html>
   
   <head>
      <title>Password Recovery Page</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Please enter your information below, and you will receive a link to reset your password.</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>Username  :</label><input type = "text" name = "username" class = "box"/><br/><br/>
                  <label>Email address  :</label><input type = "text" name = "email" class = "box" /><br/><br/>
                  <input type = "submit" value = " Get recovery code "/><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>