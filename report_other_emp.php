<?php include("header_emp2.php");


$id=$_GET['id'];
$date=$_GET['date'];

function getname($conn,$personal_id){
    $get = mysqli_query($conn, "SELECT fname, lname FROM personal_data WHERE personal_id = '$personal_id'");
    $fetch = mysqli_fetch_array($get);
    $fullname = $fetch['fname'] . " " . $fetch['lname'];
    return $fullname;
}

$select = mysqli_query($conn, "SELECT * FROM timekeeping WHERE personal_id = '$id' AND DATE_FORMAT(recorded_time, '%Y-%m-%d') = '$date'");

$type = array('In','Out');
 ?>

<div style="padding: 30px">
    <div style="background: #fff">
        <table width="100%" class="table-bordered table">
            <tr>
                <td colspan="2">
                    <h4 style="margin:0px"><b>Employee name</b></h4>

                </td>
            </tr>
            <tr>
                <td>In</td>
                <td>Out</td>
            </tr>
           <?php
            $x=0; 
            while($fetch = mysqli_fetch_array($select)){ 
                 if($x>1){
                     $x=0; 
                 }
                if($x==0){
                    $t = $type[$x];
                } else {
                    $t = $type[$x];
                } ?>
            <tr>
                <td><?php echo $t; ?></td>
                <td><?php echo date('H:i:s', strtotime($fetch['recorded_time'])); ?></td>
            </tr>
            <?php $x++;
            } ?>
        </table>
    </div>
</div>
<?php include("footer2.php") ?>
