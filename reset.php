<!-- Reset Password page -->
<?php
   session_start();
   //check if they are logged in
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
   if($_POST['code'] !== $_SESSION['digits']){
	   header("Location:rAuthenticate.php");
   }
   else {   
?>
<html>
   <head>
      <title> Reset Password </title>
	  <link href="" rel="stylesheet" type="text/css">
   </head>
   
   <body>
	  <form action="reset-Submit.php" method="post" >
	     <fieldset>
		    <p>
			   <label class="left">Please enter your username: </label>
			   <input type="text" name="name" class="textbox" size="16"/>
			</p>
			<p>
			   <label class="left">Please enter your old password: </label>
			   <input type="text" name="oldP" class="textbox" size="16"/>
			</p>  
            <p>
			   <label class="left">Please enter your new password: </label>
			   <input type="text" name="newP" class="textbox" size="16"/>
			</p>			
			<p>
			   <input type="submit" value="Reset Password">
			</p>
		 </fieldset>
	  </form>
	</body>
</html>
<?php
   }
?>