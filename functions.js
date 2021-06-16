<label class="left">Please enter a valid email for authentication purposes: </label>
	           <input type="text" name="email" class="textbox" size="16"/>
//rAuthenticate line 27

<?php
	     $msg = rand(1000,9999);
	     $msg = wordwrap($msg,70);
		 $_SESSION["digits"] = $msg;
		 $to = $_POST['email'];
		 $subject = "Authentication for Voter Registration";
		 mail($to,$subject,$msg);
	  ?
//authenticate submit line 24