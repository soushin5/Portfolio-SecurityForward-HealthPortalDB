<!-- Login Submit page -->
<?php
   session_start();
   header("X-XSS-Protection: 1; mode: block");
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
      <title> Login-submit </title>
	  <link href="" rel="stylesheet" type="text/css">
   </head>
   
   <body>
      <?php
	     // Logging in to the DB //
	     class DB_Functions {
			 public $conn;
			 private $query;
			 
			 public function login($loginU, $loginP){
		        $servername = "localhost";
                $username = "root";
                $password = "";
                $db_name = "voter attributes";
				$plainLoginP= $loginP;
				
				//Form Connection with DB
				$conn = mysqli_connect($servername, $username, $password, $db_name);	
			    // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
				}
				else{
				   // prepare and bind
                   $stmt = $conn->prepare("SELECT `username`, `password` FROM `voter attributes` 
				                           WHERE `username`=?");
                   $stmt->bind_param("s", $loginU);
				   $stmt->execute();
				   $stmt->store_result();
				   if($stmt->num_rows===0) exit('No Rows');
				   $stmt->bind_result($loginU, $loginP);
				   $stmt->fetch();
				   if(password_verify($plainLoginP, $loginP)){
					   $_SESSION['user_id'] = $_POST['loginU'];
					   echo "Login Succeeded!
					         <br></br>
							 Welcome ";
					   print $_POST["loginU"];
					   echo "<br></br>";
					   echo "<a href='vote.php'> Cast Your Vote!</a>";
					   
				   }
				   else{
					   echo "Login Failed";
					   echo "<br></br>";
					   echo "'<a href='voterLogin.php'> Try Again.</a>'";
				   }
				}
			    $conn->close();
			 }
		 }
		 if(empty($_POST["loginU"]) || empty($_POST["loginP"])){
		    print "One or more of your fields are empty. Please go back and correct the error.";
		 } 
	     else {
	        $login=new DB_Functions();
	        $login->login($_POST['loginU'],$_POST['loginP']);
	     }
	  ?>
	</body>
</html>  