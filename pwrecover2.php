<?php

   include("dbconfig.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "GET") {
      
      // put new user into users database

      $recoverycode = $_GET['recoverycode'];

      $sqlString = "SELECT * FROM users WHERE recoverycode = '" . $recoverycode . "'";
        
      $query = mysqli_query($dbconnect, $sqlString)
        or die (mysqli_error($dbconnect));
      $row = mysqli_fetch_array($query,MYSQLI_ASSOC);

      $count = mysqli_num_rows($query);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         $firstname = $row['firstname'];
         $lastname = $row['lastname'];
      }else {
         $error = "Error - cannot change password.";
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
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Please enter a new password for <?php echo 
            $firstname . " ". $lastname; ?></b></div>
				
            <div style = "margin:30px">
               
               <form action = "pwrecover3.php" method = "POST">
                  <input type = "hidden" name = "id" value = "<?php echo $row['id']; ?>"/><br/><br/>
                  <label>Choose password  :</label><input type = "password" name = "newpassword" class = "box" /><br/><br/>
                  <input type = "submit" value = " Reset password "/><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>