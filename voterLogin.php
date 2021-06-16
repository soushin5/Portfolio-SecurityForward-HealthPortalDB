<!-- Voter Log in page -->
<?php
   session_start();
   $_SESSION["Last_Activity"] = time();
   header("X-XSS-Protection: 1; mode: block");
?>
<html>
   <head>
      <title> Log-in </title>
	  <link href="" rel="stylesheet" type="text/css">
   </head>
   
   <body>
	  <form action="vLogin-submit.php" method="post">
	     <fieldset>
		    <p>
		       <label class="left">Username: </label>
			   <input type="text" name="loginU" class="textbox" size="16"/>
		    </p>
			<p>
			   <label class="left">Password: </label>
			   <input type="text" name="loginP" class="textbox" size="16"/>
			</p>
			<p>
		       <input type="submit" value="Login">
			   <button onclick="location.href='http://localhost/voters/voterSignup.php?'" type="button">
                  Sign-up
			   </button>
			</p>
		 </fieldset>
	  </form>
	</body>
</html>  