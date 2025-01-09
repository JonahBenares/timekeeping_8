<?php
//include 'includes/connection.php';

// Create connection

$con_local=mysqli_connect("localhost","root","1t@dm1N","db_hris");
$con_online=mysqli_connect("cenpripower.com","admin_hris","1t@dm1N","db_humanresource");
// Check connection

$local = $con_local->query("SELECT * FROM timekeeping WHERE dump='0'");
$rows_local = $local->num_rows;
if($rows_local != 0) {
		while($row = $local->fetch_assoc()){
        $online = $con_online->query("INSERT INTO timekeeping (personal_id, recorded_time) VALUES ('$row[personal_id]', '$row[recorded_time]')");

        $update_local =$con_local->query("UPDATE timekeeping SET dump='1' WHERE id='$row[id]'");

    	}
}
?>