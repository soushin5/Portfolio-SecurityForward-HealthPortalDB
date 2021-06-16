<!-- Vote main page -->
<?php
   session_start();
   header("X-XSS-Protection: 1; mode: block");
   if(!isset($_SESSION['user_id'])){
	   session_unset();
	   session_destroy();
	   header("Location:voterLogin.php");
   }
   // time in seconds
   if (isset($_SESSION["Last_Activity"]) && (time() - $_SESSION["Last_Activity"] > 1800)){
      session_unset();
	  session_destroy();
	  header("Location:voterLogin.php");
   }
   $_SESSION["Last_Activity"] = time();
?>
<html>
   <head>
      <title> Vote! </title>
	  <link href="" rel="stylesheet" type="text/css">
   </head>
   
   <body>
	  <form action="voteConfirm.php">
	     <fieldset>
		    <p>
		       <input type="submit" value="Vote">
			</p>
		 </fieldset>
	  </form>
	  <form action="voterLogout.php" >
	     <fieldset>
			<p>
			   <input type="submit" value="Logout">
			</p>
		 </fieldset>
	  </form>
	  <form action="rAuthenticate.php" >
	     <fieldset>
			<p>
			   <input type="submit" value="Reset Password">
			</p>
		 </fieldset>
	  </form>
	</body>
</html>  