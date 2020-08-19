<?php
   session_start();

   // When user logs out, wipe out the session and go back to the login page
   
   if(session_destroy()) {
      header("Location: /login.php");
   }
?>