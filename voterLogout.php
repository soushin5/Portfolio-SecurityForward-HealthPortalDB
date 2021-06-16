<!-- Voter Logout page -->
<?php
   session_start();
   session_unset();
   session_destroy();
   header('Location:voterLogin.php');
?>