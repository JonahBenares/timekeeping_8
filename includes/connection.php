<?php
	//$con_tk=mysqli_connect("localhost","admin_hris","1t@dm1N_cenpri","db_humanresource");
//$con_cenpri=mysqli_connect("localhost","root","","db_cenpri");
	$con_tk=mysqli_connect("cenpripower.com","admin_hris","1t@dm1N_cenpri","db_humanresource");
// 	 $con_tk=mysqli_connect("localhost","root","","db_hris");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL:".mysqli_connect_error();
		//$con_tk=mysqli_connect("localhost","root","","db_hris");
	}
;?>


