<?php
   session_start();
   $_SESSION["Creation"] = time();
   header("X-XSS-Protection: 1; mode: block");
   if(isset($_POST['submit'])) {
	   $username = $_POST['uname'];
	   $secretKey = "6LeHh8UUAAAAAKIDXfYlTFCHUz7aPANhDY5Cltim";
	   $responseKey = $_POST['g-recaptcha-response'];
	   $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=responseKey";
	   $response = file_get_contents($url);
	   echo $response;
   }
   
?>
<!-- Voter Registraition page -->
<html>
   <head>
      <title> Sign-up Page </title>
	  <link href="" rel="stylesheet" type="text/css">
	  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
   </head>
   
   <body>  
	  <form method="post" action="vSignup-submit.php">
	     <fieldset>
		    <p>
		       Image: <input name="image" type="text">
			</p>
			<p>
	           Name: <input name="fname" type="text"> <input name="lname" type="text">
		    </p>
			<p>
		       Sex: <input name="sex" type="text">
		    </p>
            <p>			
		       Username: <input name="uname" type="text">
			</p>   
		    <p>
		       Password: <input name="pword" type="text">
			</p>
		    <p>
		       Course: <input name="course" type="text">
			</p>   
		    <p>
		       Sponsor: <input name="sponsor" type="text"> 
		    </p>
			<p>
			   <div class="g-recaptcha" data-sitekey="6LeHh8UUAAAAAHn6mKfcQvGnrbiehyqfmSw1RiDS"></div>
               <br></br>
               <input type="submit" name="submit" value="Submit">
			</p>
		 </fieldset>
	  </form>
	  
   </body>
</html>