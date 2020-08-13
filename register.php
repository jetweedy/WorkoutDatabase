<?php

   include("dbconfig.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // info sent from form 
      
      // put new user into users database

      
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
   }
?>
<html>
   
   <head>
      <title>Login Page</title>
      
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
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>New user registration</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>Choose username  :</label><input type = "text" name = "username" class = "box"/><br/><br/>
                  <label>Choose password  :</label><input type = "password" name = "password" class = "box" /><br/><br/>
                  <label>Your first name  :</label><input type = "text" name = "firstname" class = "box" /><br/><br/>
                  <label>Your last name  :</label><input type = "text" name = "lastname" class = "box" /><br/><br/>
                  <label>Your email address  :</label><input type = "text" name = "email" class = "box" /><br/><br/>
                  <input type = "submit" value = " Join "/><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>