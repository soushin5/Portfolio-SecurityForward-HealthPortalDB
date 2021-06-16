<!-- REset submit page -->
<?php
   session_start();
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
      <title> Reset Submit </title>
	  <link href="" rel="stylesheet" type="text/css">
   </head>
   
   <body>
	  <?php
	     // Logging in to the DB
	      class DB_Functions {
			 public $conn;
			 private $query;
			 
			 public function resetPassword($name,$oldP, $newP){
		        $servername = "localhost";
                $username = "root";
                $password = "";
                $db_name = "voter attributes";
				$plainP= $oldP;
				
				//Form Connection with DB
				$conn = mysqli_connect($servername, $username, $password, $db_name);	
			    // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
				}
				else{
				   // prepare and bind
                   $stmt = $conn->prepare("SELECT `username`,`password` FROM `voter attributes` 
				                           WHERE `username`=?");					   
                   $stmt->bind_param("s", $name);
				   $stmt->execute();
				   $stmt->store_result();
				   if($stmt->num_rows===0) exit('No Rows');
				   $stmt->bind_result($name,$oldP);
				   $stmt->fetch();
				   if(password_verify($plainP, $oldP)){
					   echo "passwords match";
					   echo "<br></br>";
					   //take the password and hash 
				        $newP=password_hash($newP, PASSWORD_BCRYPT);
				           // prepare and bind
                        $stmt2 = $conn->prepare("UPDATE `voter attributes` 
						                         SET `password`=?
										         WHERE `username`=?");
                        $stmt2->bind_param("ss",$newP,$name);
						if($stmt2->execute()){
					       echo "Password Change Succeeded";
						   echo "<p>Return to<a href='vote.php'> Vote!</a></p>";
				        }
				        else{
					       echo "Password Change Failed";
						   echo "<p><a href='reset.php'> Try again?</a></p>";
				       }
				   }
				   else {
					   echo "Passwords do not match";
					   echo "<p><a href='reset.php'> Try again?</a></p>";
				   }
				}
			    $conn->close();
			 }
		  }
	         if(empty($_POST["name"]) || empty($_POST["oldP"]) || empty($_POST["oldP"])){
		        print "One or more of your fields are empty. Please go back and correct the error.";
	         }
             else {	   
		        $reset=new DB_Functions();
	            $reset->resetPassword($_POST['name'],$_POST['oldP'],$_POST['newP']);
			 }		 
	  ?>
   </body>
</html> 