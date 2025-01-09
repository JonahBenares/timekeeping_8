<?php 
include('includes/connection.php');
include('includes/functions.php');    
date_default_timezone_set('Asia/Manila');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';


$empno=$_POST['empno'];

//$id='85';
$timestamp = date('Y-m-d H:i:s');
$time_minutes = date('Y-m-d H:i');
$today = date('Y-m-d');

$get_exist = $con_tk->query("SELECT personal_id FROM personal_data WHERE emp_num = '$empno'");
$cnt_exist =$get_exist->num_rows;

if($cnt_exist == 0){
        echo "not found - "; 
} else {
        $get_email = $con_tk->query("SELECT personal_id, email, fname, lname FROM personal_data WHERE emp_num = '$empno'");
        $fetch_email = $get_email->fetch_array();
        $id = $fetch_email['personal_id'];

        $check_duplicates = $con_tk->query("SELECT id FROM timekeeping WHERE personal_id = '$id' AND recorded_time LIKE '$time_minutes%'");
        $cnt_duplicates =$check_duplicates->num_rows;

        $email= $fetch_email['email'];
        $fullname = $fetch_email['lname'] . ", " . $fetch_email['fname'];

    

                if($cnt_duplicates==0){
                	
                        	if($con_tk->query("INSERT INTO timekeeping (personal_id, recorded_time, login_type) VALUES ('$id', '$timestamp', 'Web') ON DUPLICATE KEY UPDATE recorded_time='$timestamp'")){

                                echo "success - ".$fullname;
                                $mail = new PHPMailer;
                                $mail->isSMTP();
                                $mail->Host     = 'smtp.gmail.com';
                                $mail->SMTPAuth = true;
                                $mail->Username = "cenpri.timekeeping@gmail.com";
                                $mail->Password = "CenpriBac0lod!";
                                $mail->SMTPSecure = 'tls';
                                $mail->Port     = 587;
                             
                                $mail->setFrom('cenpri.timekeeping@gmail.com', 'CENPRI');
                                $mail->addReplyTo('cenpri.timekeeping@gmail.com', 'CENPRI');


                                $mail->addAddress($email);

                                
                                $mail->Subject = 'CENPRI | Timekeeping';
                                
                              
                                $mail->isHTML(true);
                                
                                // Email body content
                                $mailContent = "You have logged in/out at: ". $timestamp."<br><br><h4 style='font-weight:bold;'></h4>";
                                $mail->Body = $mailContent;
                                
                                // Send email
                                $mail->send();
                        				  

                        		
                        	} else {
                        		echo "error - ";
                        	}
                            
                } else {
                	echo "duplicate - ".$fullname;
                }
        
}
?>