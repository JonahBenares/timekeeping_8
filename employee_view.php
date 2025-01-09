<?php include("header_emp.php");
ini_set('max_execution_time', 0);
ini_set('memory_limit', '2048M');

function getname($conn,$personal_id){
    $get = mysqli_query($conn, "SELECT fname, lname FROM personal_data WHERE personal_id = '$personal_id'");
    $fetch = mysqli_fetch_array($get);
    $fullname = $fetch['fname'] . " " . $fetch['lname'];
    return $fullname;
}

function calculate_hours($conn,$personal_id,$date){
    $get_earliest = mysqli_query($conn,"SELECT MIN(recorded_time) as earliest FROM timekeeping WHERE personal_id = '$personal_id' AND DATE_FORMAT(recorded_time,'%Y-%m-%d') = '$date'");
    $fetch_earliest = mysqli_fetch_array($get_earliest);
    $earliest = date('H:i:s', strtotime($fetch_earliest['earliest']));

    $get_latest = mysqli_query($conn,"SELECT MAX(recorded_time) as latest FROM timekeeping WHERE personal_id = '$personal_id' AND DATE_FORMAT(recorded_time,'%Y-%m-%d') = '$date'");
    $fetch_latest = mysqli_fetch_array($get_latest);
    $latest = date('H:i:s', strtotime($fetch_latest['latest']));

    $hourdiff = round((strtotime($latest) - strtotime($earliest))/3600, 1);
    return $hourdiff;
}

function get_resolution($conn,$personal_id, $rec_date){
    $get_remarks = mysqli_query($conn, "SELECT remarks FROM timekeeping_resolve WHERE timekeeping_date = '$rec_date' AND personal_id='$personal_id'");
    $fetch_remarks = mysqli_fetch_array($get_remarks);
    return $fetch_remarks['remarks'];
}

$emp = mysqli_query($con_tk, "SELECT personal_id, fname, lname FROM personal_data WHERE status = 'Active'");

?>
<style type="text/css">
    table.dataTable tbody td{
        padding:5px;
        color: #000;
    }    
</style>

<link href="css/buttons.dataTables.min.css" rel="stylesheet">
<script src="scripts/jquery.min.js"></script> 
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <!-- /navbar -->
        <div class="wrapper">
            <div id="loader" >
                <figure class="one">Please Wait</figure>
                <figure class="two">loading</figure>
            </div>
 

            <div class="modal fade" id="resolve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Resolve
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </h5>                            
                        </div>                      
                        <div class="modal-body">
                            <center>
                                <textarea class="form-control" rows="5" name='remarks' id='remarks' placeholder="Remarks" style="width: 95%"></textarea>
                            </center>
                        </div>
                        <div class="modal-footer">
                            <input type='hidden' name='id' id='id'>
                            <input type='hidden' name='rec_date' id='rec_date'>
                            <input type="button" class="btn btn-success" data-dismiss="modal" name='add_resolve' onClick='add_resolve()' value='Resolve'>
                        </div>                       
                    </div>
                </div>
            </div>

            <div id="contents" style = "display:none">
                <div class="container-fluid">
                    <div class="content">                          
                        <div class="module">
                            <div class="module-head">
                                <h2 style="margin: 0px 0px 0px!important">Report</h2>                                 
                            </div>
                            
                            <div class="module-body" >
                                <form method="GET"> 
                                    <table width="100%">
                                        <tr>
                                             <td width="10%"><label class="control-label" for="basicinput">Employee:</label></td>
                                            <td width="25%"><select class="select2" name='employee'>
                                                <option value=''>-Search Employee-</option>
                                              <?php 
                                              while($fetch_emp = mysqli_fetch_array($emp)){ 
                                                ?>
                                                <option value='<?php echo $fetch_emp['personal_id']; ?>'><?php echo $fetch_emp['lname'] . ", " . $fetch_emp['fname']; ?></option>
                                            <?php } ?>
                                               

                                            </select></td>
                                            <td width="10%"><label class="control-label" for="basicinput">FROM:</label></td>
                                            <td width="25%"><input type="date" id="date_from" name = "date_from" class="span4"></td>
                                            <td width="10%"><label class="control-label" for="basicinput">TO:</label></td>
                                            <td width="25%"><input type="date" id="date_to" name = "date_to" class="span4"></td>
                                            <td width="10%"><input type = "submit" id = "submit" class = "btn btn-primary" value = "Generate"></td>
                                        </tr>
                                    </table>                                    
                                </form> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="content">                          
                        <div class="module">
                            <div class="module-body" >
                                <table  class="table table-bordered" width="100%" id="example">
                                    <thead>
                                        <tr>
                                            <th style="font-size: 11px" width="15%">Name</th>
                                            <th style="font-size: 11px">Date</th>
                                            <th style="font-size: 11px">Day</th>
                                            <th style="font-size: 11px">In</th>
                                            <th style="font-size: 11px">Out</th>
                                            <th style="font-size: 11px">In</th>
                                            <th style="font-size: 11px">Out</th>
                                            <th style="font-size: 11px">In</th>
                                            <th style="font-size: 11px">Out</th>
                                            <th style="font-size: 11px">In</th>
                                            <th style="font-size: 11px">Out</th>
                                            <th style="font-size: 11px" width="%">Remarks</th>
                                            <th style="font-size: 11px" width="10%">Others</th>
                                        </tr>
                                    </thead>
                                    <tbody>      
                                        <?php 
                                            $sql = "SELECT DISTINCT personal_id, DATE_FORMAT(recorded_time, '%Y-%m-%d') as rec FROM timekeeping ";
                                            $where = ' WHERE';
                                            $url="";
                                            if(!empty($_GET)){
                                                    $emp = $_GET['employee'];
                                                    if(!empty($emp)){
                                                        $where.=" personal_id='$emp' AND ";
                                                    }
                                                      if(!empty($_GET['date_from']) && !empty($_GET['date_to'])){
                                                    $from = date('Y-m-d', strtotime($_GET['date_from']));
                                                    $to = date('Y-m-d', strtotime($_GET['date_to']));

                                                  
                                                    $where.= " DATE_FORMAT(recorded_time, '%Y-%m-%d') >= '$from' AND DATE_FORMAT(recorded_time, '%Y-%m-%d') <= '$to' AND";
                                                    }
                                            }
                                            $where = substr($where, 0, -4);
                                            $sql .= $where;
                                            // /echo $sql;
                                            $query = mysqli_query($con_tk,$sql);
                                            while($fetch = mysqli_fetch_array($query)){
                                                $remarks=get_resolution($con_tk,$fetch['personal_id'], $fetch['rec']);
                                            $count_rows = mysqli_query($con_tk,"SELECT id, recorded_time FROM timekeeping WHERE personal_id= '$fetch[personal_id]' AND DATE_FORMAT(recorded_time, '%Y-%m-%d') = '$fetch[rec]'");
                                        $cnt = mysqli_num_rows($count_rows);
                                        if($cnt<8){
                                            $needed_loop = 8-$cnt;
                                        } else {
                                            $needed_loop=0;
                                        }
                                        ?>

                                        <tr <?php echo (($cnt % 2 != 0 && empty($remarks)) ? "style='background-color:#FAAC9B'" : ""); ?>> 
                                            <td><?php echo getname($con_tk, $fetch['personal_id']); ?></td>
                                            <td><?php echo $fetch['rec']; ?></td>
                                            <td><?php echo date('l', strtotime($fetch['rec'])); ?></td>
                                            <?php 
                                           $x=1;
                                            while($fetch_rows = mysqli_fetch_array($count_rows)){  
                                                if($x<=8){?>
                                                <td><?php echo date('H:i:s', strtotime($fetch_rows['recorded_time'])); ?></td>
                                            <?php }
                                            $x++;
                                            } 
                                            for($a=0;$a<$needed_loop;$a++){ ?>
                                                <td></td>
                                            <?php } ?>
                                            <td><?php echo $remarks; ?></td>
                                            <td align="center">

                                                <center>
                                                    <a href="javascript:void(0)" class="btn btn-primary" onclick="others('<?php echo $fetch['personal_id']; ?>','<?php echo $fetch['rec']; ?>')">
                                                        <span style="color:#fff!important" class="fa fa-eye"></span>
                                                    </a>
                                                   
                                                </center>
                                            </td>
                                        </tr>
                                    <?php }

                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            window.onload = function () {
                var myVar;
                myVar   =setTimeout(showPage,2000);
            };
            function showPage() {
                document.getElementById("loader").style.display = "none";
                document.getElementById("contents").style.display = "block";            
            }
        </script>
        <script>
     
        function others() {         
          window.open("report_other_emp.php?id=", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=120,left=440,width=400,height=400");
        }

        $(document).on('click', '#resolve_button', function(e){
            e.preventDefault();
            var id = $(this).data('id');  
            var rec_date = $(this).data('date');  
            document.getElementById("id").value = id;
            document.getElementById("rec_date").value = rec_date;
        });

        function add_resolve(){
          
            var id = $("#id").val();
            var rec_date = $("#rec_date").val();
            var remarks = $("#remarks").val();
            var info = "id="+id+"&rec_date="+rec_date+"&remarks="+remarks;
           
            $.ajax({
                data: info,
                type: "post",
                url: "add_resolve.php",
                success: function(output){
                    //console.log(output);
                    if(output==true){

                        alert('Successfully resolved!');
                        location.reload()

                    }
                }
            }); 

        }
        $(document).ready(function() {
            $('.select2').select2();
        });
        </script>
        <?php //include('footer2.php')?>
