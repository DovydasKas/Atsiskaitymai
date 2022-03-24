<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['username'])) {

 //   include "includes/dbh-inc.php";

if (isset($_POST['op']) && isset($_POST['np']) && isset($_POST['c_np'])) {
    

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$op = validate($_POST['op']);
	$np = validate($_POST['np']);
	$c_np = validate($_POST['c_np']);
    
    if(empty($op)){
      header("Location: profilis.php?error=Old Password is required");
	  exit();
    }else if(empty($np)){
      header("Location: profilis.php?error=New Password is required");
	  exit();
    }else if($np !== $c_np){
      header("Location: profilis.php?error=The confirmation password  does not match");
	  exit();
    }else {
    	// hashing the password
    	$op = password_hash($op, PASSWORD_DEFAULT);
    	$np = password_hash($np, PASSWORD_DEFAULT);
        $username = $_SESSION['username'];

        $sql = "SELECT Slaptazodis FROM users WHERE Slapyvardis='$username'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) === 1){
        	
            $sql_2 = "UPDATE users SET Slaptazodis='$np' WHERE Slapyvardis='$username'";
            
        	mysqli_query($conn, $sql_2);
        	header("Location: profilis.php?success=Your password has been changed successfully");
	        exit();

        }else {
        	header("Location: profilis.php?error=Incorrect password");
	        exit();
        }

    }

    
}else{
	header("Location: profilis.php");
	exit();
}

}else{
     header("Location: index.php");
     exit();
}