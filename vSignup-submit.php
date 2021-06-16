<!-- Voter Registration confirmation page -->
<?php
   session_start();
   header("X-XSS-Protection: 1; mode: block");
   // time in seconds
   if (isset($_SESSION["Creation"]) && (time() - $_SESSION["Creation"] > 1800)){
      session_unset();
	  session_destroy();
	  header("Location:voterSignup.php");
   }
   $_SESSION["Creation"] = time();
?>
<html>
   <head>
      <title> Sign-up Submit Page </title>
	  <link href="" rel="stylesheet" type="text/css">
   </head>
   
   <body>
	  <p>
	     <?php
		    if(isset($_POST['submit'])) {
	           $username = $_POST['uname'];
	           $secretKey = "6LeHh8UUAAAAAKIDXfYlTFCHUz7aPANhDY5Cltim";
	           $responseKey = $_POST['g-recaptcha-response'];
	           $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey";
	           $response = file_get_contents($url);
			   $response = json_decode($response);
	           if($response->success){
				   print "Verified as Human.";
			   }
			   else {
				   print "Not Verified as Human";
				   header("Location:voterSignup.php");
			   }
			}
		    if($_POST["fname"] == "" || $_POST["lname"] == "" || $_POST["sex"] == "" || $_POST["uname"] == "" || 
			   $_POST["pword"] == "" || $_POST["course"] == "" || $_POST["sponsor"] == ""){
			   print "One or more of your fields are empty. Please go back and correct the error.";
			} 
			else {
		 ?>
	           <br></br>
			   Thank You!
	           <br></br>
		       Your Vote is important to us, <?php print $_POST["fname"] ?>
	           </p>
			   <?php
	              // throwing the new entry into the database //
	              class DB_Functions {
			         public $conn;
			         private $query;
			 
			         public function register($image, $fname, $lname, $sex, $uname, $pword, $course, $sponsor){
		             $servername = "localhost";
                     $username = "root";
                     $password = "";
                     $db_name = "voter attributes";
				
				     //Form Connection with DB
				     $conn = mysqli_connect($servername, $username, $password, $db_name);	
			         // Check connection
                     if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
				     }
				     else{
				        //take the password and hash 
				        $pword=password_hash($pword, PASSWORD_BCRYPT);
				           // prepare and bind
						   //uses insert ignore into to stop duplicates
                        $stmt = $conn->prepare("INSERT IGNORE INTO `voter attributes` (`image`, `firstname`, `lastname`, `Sex`, 
					                              `username`, `password`, `course`, `sponsor`)
										        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                        $stmt->bind_param("ssssssss", $image, $fname, $lname, $sex, $uname, $pword, $course, $sponsor);
				           //original working query w/out prepared statement. Keep for reference
				           /*$query="INSERT INTO `voter attributes` (`image`, `firstname`, `lastname`, `Sex`, 
					                                         `username`, `password`, `course`, `sponsor`)
					         VALUES('".$image."', '".$fname."', '".$lname."', '".$sex."',
           							'".$uname."', '".$pword."', '".$course."', '".$sponsor."')";
				        $result=mysqli_query($conn, $query);*/
				        if($stmt->execute()){
					       echo "Registration Succeeded";
				        }
				        else{
					       echo "Registration Failed";
				       }
				     }	
                     $conn->close();				
			         }
		          }
	              $registration=new DB_Functions();
	              $registration->register($_POST['image'],$_POST['fname'],$_POST['lname'],$_POST['sex'],$_POST['uname'],
		                                  $_POST['pword'],$_POST['course'],$_POST['sponsor']);
	            ?>
			   <p>Now<a href="voterLogin.php"> log in to cast your vote!</a></p>
   </body>
</html>
<?php
			}
?>