<!--  page -->
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
      <title> Authenticate </title>
	  <link href="" rel="stylesheet" type="text/css">
   </head>
   
   <body>
      <h2>Security Questions</h2>
	  <form action="rAuthenticate-Submit.php" method="post">
	     <fieldset>
		    <p>
	           <label class="left">What is your middle name: </label>
	           <input type="text" name="email" class="textbox" size="16"/>
			   <?php $_SESSION['correctA'] = "Ku";?>
			</p>
			<p>
			   <input type="submit" value="Proceed">
			</p>
		 </fieldset>
	  </form>
   </body>
</html>