<html>
   
   <head>
      <title>New User Registration Page</title>
   </head>
   
   <body bgcolor = "#FFFFFF">
	   
      <!-- Create a dialog box to prompt a new user to register their information.
         Then POST the information to the adminaction page to be stored. -->
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>New user registration</b></div>
				
            <div style = "margin:30px">
               
               <form action = "adminaction.php" method = "post">
                  <input type='hidden' name='action' value='registernewuser'>
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