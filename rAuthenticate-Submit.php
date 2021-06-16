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
   $_SESSION['answer'] = $_POST['email'];
   if($_SESSION['answer'] == $_SESSION['correctA']){
	   header("Location:reset.php");
   }
   else{
	   header("Location:rAuthenticate.php");
   }
	   
?>
<html>
   <head>
      <title> Reset Submit </title>
	  <link href="" rel="stylesheet" type="text/css">
   </head>
   
   <body>
      
	  <br></br>
	  Please enter the 4 digit code provided in the space below.
	  <form action="reset.php" method="post">
	     <fieldset>
	        <label class="left">Please enter the 4 digit code: </label>
	        <input type="text" name="code" class="textbox" size="16"/>
		 </fieldset>
	  </form>
   </body>
</html>