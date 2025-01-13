<?php include("header.php");
ini_set('max_execution_time', 0);
ini_set('memory_limit', '2048M');

function getname($con_tk,$personal_id){
    $get = mysqli_query($con_tk, "SELECT fname, lname FROM personal_data WHERE personal_id = '$personal_id'");
    $fetch = mysqli_fetch_array($get);
    $fullname = $fetch['fname'] . " " . $fetch['lname'];
    return $fullname;
}

function calculate_hours($con_tk,$personal_id,$date){
    $get_earliest = mysqli_query($con_tk,"SELECT MIN(recorded_time) as earliest FROM timekeeping WHERE personal_id = '$personal_id' AND DATE_FORMAT(recorded_time,'%Y-%m-%d') = '$date'");
    $fetch_earliest = mysqli_fetch_array($get_earliest);
    $earliest = date('H:i:s', strtotime($fetch_earliest['earliest']));

    $get_latest = mysqli_query($con_tk,"SELECT MAX(recorded_time) as latest FROM timekeeping WHERE personal_id = '$personal_id' AND DATE_FORMAT(recorded_time,'%Y-%m-%d') = '$date'");
    $fetch_latest = mysqli_fetch_array($get_latest);
    $latest = date('H:i:s', strtotime($fetch_latest['latest']));

    $hourdiff = round((strtotime($latest) - strtotime($earliest))/3600, 1);
    return $hourdiff;
}

function get_resolution($con_tk,$personal_id, $rec_date){
    $get_remarks = mysqli_query($con_tk, "SELECT remarks FROM timekeeping_resolve WHERE timekeeping_date = '$rec_date' AND personal_id='$personal_id'");
    $count_remarks = mysqli_num_rows($get_remarks);

    $fetch_remarks = mysqli_fetch_array($get_remarks);
    return $fetch_remarks['remarks'] ?? '';
}

?>
<style type="text/css">
    table.dataTable tbody td{
        padding:5px;
        color: #000;
    }    
</style>

<link href="css/buttons.dataTables.min.css" rel="stylesheet">
<script src="scripts/jquery.min.js"></script>
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
                                            <td width="15%"><label class="control-label" for="basicinput">Cut off Date FROM:</label></td>
                                            <td width="35%"><input type="date" id="date_from" name = "date_from" class="span4"></td>
                                            <td width="15%"><label class="control-label" for="basicinput">Cut off Date TO:</label></td>
                                            <td width="35%"><input type="date" id="date_to" name = "date_to" class="span4"></td>
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
                                <div class="pull-right" style="margin-right: 15px">
                                    <a href="local_to_online.php" class="btn btn-success btn-sm ">Import Time</a>
                                </div>
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
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                           
                                            $url="";
                                            if(!empty($_GET)){
                                              $sql = "SELECT DISTINCT personal_id, DATE_FORMAT(recorded_time, '%Y-%m-%d') as rec FROM timekeeping ";

                                                    $from = date('Y-m-d', strtotime($_GET['date_from']));
                                                    $to = date('Y-m-d', strtotime($_GET['date_to']));
                                                    $sql.= " WHERE DATE_FORMAT(recorded_time, '%Y-%m-%d') >= '$from' AND DATE_FORMAT(recorded_time, '%Y-%m-%d') <= '$to'";
                                            

                                            
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
                                        

                                        if($cnt % 2 != 0  && empty($remarks)) { ?>

                                        <tr style='background-color:#FAAC9B'> 
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
                                           
                                        </tr>
                                    <?php }
                                    }
                                }

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
        function others(id,date_rec) {
         
          window.open("report_other.php?id="+id+"&date="+date_rec, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=120,left=440,width=400,height=400");
        }
        function local(id,date_rec) {         
          window.open("report_local.php?id="+id+"&date="+date_rec, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=120,left=440,width=400,height=400");
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
        </script>
        <?php include('footer2.php')?>
