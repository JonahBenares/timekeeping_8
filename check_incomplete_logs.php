<?php 
include 'includes/connection.php';
date_default_timezone_set('Asia/Manila');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';


function get_resolution($con_tk,$personal_id, $rec_date){
    $get_remarks = mysqli_query($con_tk, "SELECT remarks FROM timekeeping_resolve WHERE timekeeping_date = '$rec_date' AND personal_id='$personal_id'");
    $fetch_remarks = mysqli_fetch_array($get_remarks);
    return $fetch_remarks['remarks'];
}

function get_email($con_tk,$personal_id){
    $get = mysqli_query($con_tk, "SELECT email FROM personal_data WHERE personal_id = '$personal_id'");
    $fetch = mysqli_fetch_array($get);
    return $fetch['email'];
}

function email_incomplete($id,$email,$now){
        $today = date('Y-m-d', strtotime($now));
	 	$mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host     = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = "cenpri.timekeeping@gmail.com";
        $mail->Password = "CenpriBac0lod!";
        $mail->SMTPSecure = 'tls';
        $mail->Port     = 587;
        $mail->IsHTML(true);
        $mail->setFrom('cenpri.timekeeping@gmail.com', 'CENPRI');
        $mail->addReplyTo('cenpri.timekeeping@gmail.com', 'CENPRI');


        $mail->addAddress($email);

        
        $mail->Subject = 'CENPRI | Timekeeping Incomplete Logs';
        
      
        $mail->isHTML(true);
        
        // Email body content
        $mailContent = "You have incomplete logs today, ". date('F j, Y', strtotime($now)).".<br>";
        $mailContent.="Please inform HR Department to resolve immediately.<br><br>";
        $mailContent.="You may visit this <a href='http://cenpripower.com/online_timekeeping/employee_view.php?employee=".$id."&date_from=".$today."&date_to=".$today."'>link</a> to view your incomplete logs. <br><br>";

        $mailContent.="Note: Please disregard this email if you are on graveyard shift. Thank you.";
        $mail->Body = $mailContent;
        
        // Send email
        $mail->send();
				
}
  $now = date('Y-m-d');
  //$now='2020-08-12';
$count_rows = mysqli_query($con_tk,"SELECT COUNT(id) AS cnt, personal_id FROM timekeeping WHERE DATE_FORMAT(recorded_time, '%Y-%m-%d') = '$now' GROUP BY personal_id,DATE_FORMAT(recorded_time, '%Y-%m-%d')");
 while($fetch = mysqli_fetch_array($count_rows)){
 	 $remarks=get_resolution($con_tk,$fetch['personal_id'], $now);
 	 if($fetch['cnt'] % 2 != 0 && empty($remarks)){
 	 	$email = get_email($con_tk,$fetch['personal_id']);
 		email_incomplete($fetch['personal_id'],$email,$now);
 	}
 }

	   
  
?>