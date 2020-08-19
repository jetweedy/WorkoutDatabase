<?php
  session_start();
?>

<html>
   
  <head>
    <title>Login Page</title>
  </head>
   
    <!-- Create a dialog box to get login info.  Create buttons for password recovery
      and for new users to join. -->
    <body bgcolor = "#FFFFFF">
	
    <div align = "center">
      <div style = "width:300px; border: solid 1px #333333; " align = "left">
         <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            <div style = "margin:30px">

               <form action = "register.php">
                  <input type = "submit" value = " New user? Please click here to join "/><br />
               </form>

               <form action = "adminaction.php" method = "post">
               	  <input type='hidden' name='action' value='login'>
                  <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br/><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box"/><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>

               <form action = "pwrecover.php">
                  <input type = "submit" value = " Forgot your password? "/><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $_SESSION['login_error']; ?></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>