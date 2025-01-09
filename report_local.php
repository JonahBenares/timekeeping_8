<?php include("header3.php");
$id=$_GET['id'];
$date=$_GET['date'];

function getname($con_ck,$personal_id){
     $get = mysqli_query($con_ck, "SELECT fname, lname FROM personal_data WHERE personal_id = '$personal_id'");
    $fetch = mysqli_fetch_array($get);
     $fullname = $fetch['fname'] . " " . $fetch['lname'];
     return $fullname;
 }

 $select = mysqli_query($con_ck, "SELECT * FROM timekeeping WHERE personal_id = '$id' AND DATE_FORMAT(recorded_time, '%Y-%m-%d') = '$date'");

 $type = array('In','Out');
 ?> 

<div style="padding: 30px">
    <div style="background: #fff">
        <center>
            <b><h3>LOCAL REPORT</h3></b>
        </center>
                <table width="100%" class="table-bordered table">
            <tr>
                <td colspan="2">
                    <h4 style="margin:0px"><b><?php echo getname($con_ck, $id) . " / " . $date; ?></b></h4>

                </td>
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
                <td width=""><?php echo $t; ?></td>
                <td><?php echo date('H:i:s', strtotime($fetch['recorded_time'])); ?></td>
            </tr>
            <?php $x++;
            } ?>
        </table>
    </div>
</div>
<?php include("footer2.php") ?>
