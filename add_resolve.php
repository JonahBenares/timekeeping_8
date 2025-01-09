<?php  include 'includes/connection.php';


$id= $_POST['id'];
$rec_date= $_POST['rec_date'];
$remarks= $_POST['remarks'];
//echo "INSERT INTO timekeeping_resolve (timekeeping_date, personal_id, remarks) VALUES ('$id','$rec_date','$remarks')";
$insert = mysqli_query($con_tk,"INSERT INTO timekeeping_resolve (timekeeping_date, personal_id, remarks) VALUES ('$rec_date','$id','$remarks')");
echo true;

?>