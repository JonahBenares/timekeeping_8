<?php 
    include('includes/connection.php');
    session_start();
	if(isset($_POST['login_time'])){
    	foreach($_POST AS $var=>$value)
        $$var = mysqli_real_escape_string($con_tk,$value);
		$sql=$con_tk->query("SELECT * FROM user WHERE username = '$username' AND password = '$password'");
		$rows=$sql->num_rows;
		if($rows==0){
			echo "<script>alert('Username and password not existing. Please contact IT administrator'); window.location = 'index.php'; </script>";
		} else {
			$fetch = $sql->fetch_array();
			$_SESSION['userid'] = $fetch['user_id'];
			$_SESSION['fullname'] = $fetch['fullname'];
			$_SESSION['username'] = $fetch['username'];
			$_SESSION['usertype'] = 'admin';
			echo "<script>window.location = 'home.php';</script>";
		}
	}
?>