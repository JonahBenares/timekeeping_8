<?php include("header.php");
ini_set('max_execution_time', 0);
ini_set('memory_limit', '2048M');
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
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <table width="100%" class="table-bordered table">
                            <tr>
                                <td>check In</td>
                                <td>check out</td>
                            </tr>
                            <tr>
                                <td>10:10</td>
                                <td>10:29</td>
                            </tr>
                        </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="resolve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <textarea class="form-control" rows="5" placeholder="Remarks"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                                <table  class="table table-bordered" width="100%" id="example">
                                    <thead>
                                        <tr>
                                            <th style="font-size: 11px" width="1%">#</th>
                                            <th style="font-size: 11px">Name</th>
                                            <th style="font-size: 11px">Date</th>
                                            <th style="font-size: 11px"> Day</th>
                                            <th style="font-size: 11px">Check In</th>
                                            <th style="font-size: 11px">AM Break Out</th>
                                            <th style="font-size: 11px">AM Break In</th>
                                            <th style="font-size: 11px">NN Break Out</th>
                                            <th style="font-size: 11px">NN Break In</th>
                                            <th style="font-size: 11px">PM Break Out</th>
                                            <th style="font-size: 11px">PM Break In</th>
                                            <th style="font-size: 11px">Check Out</th>
                                            <th style="font-size: 11px" width="1%">Others</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $sql = "SELECT * FROM tbl_dtr_2020";
                                            $url="";
                                            if(!empty($_GET)){
                                                $sql .= " WHERE"; 
                                                if(!empty($_GET['date_from'])){
                                                    if(!empty($_GET['date_to'])){
                                                        $sql .= " dtr_date BETWEEN '$_GET[date_from]' AND '$_GET[date_to]' AND";
                                                        $url.="datefrom=".$_GET['date_from']."&dateto=".$_GET['date_to'];
                                                    }else{
                                                        $sql .= " dtr_date BETWEEN '$_GET[date_from]' AND '$_GET[date_from]' AND";
                                                        $url.="datefrom=".$_GET['date_from']."&dateto=".$_GET['date_from'];
                                                    }
                                                }
                                            $q = substr($sql,-3);
                                            if($q == 'AND'){
                                                $sql = substr($sql,0,-3);
                                            }

                                            //echo $sql;
                                            $query = mysqli_query($con,$sql);
                                            while($row = mysqli_fetch_array($query)){
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $row['employee_biometricnumber']?></td>
                                            <td><?php echo $row['employee_name']?></td>
                                            <td><?php echo $row['dtr_date']?></td>
                                            <td><?php echo $row['dtr_day']?></td>
                                            <td><?php echo $row['dtr_checkin']?></td>
                                            <td><?php echo $row['dtr_breakout_am']?></td>
                                            <td><?php echo $row['dtr_breakin_am']?></td>
                                            <td><?php echo $row['dtr_breakout_nn']?></td>
                                            <td><?php echo $row['dtr_breakin_nn']?></td>
                                            <td><?php echo $row['dtr_breakout_pm']?></td>
                                            <td><?php echo $row['dtr_breakin_pm']?></td>
                                            <td><?php echo $row['dtr_checkout']?></td>
                                            <td align="center">
                                                <center>
                                                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                        <span style="color:#fff!important" class="fa fa-eye"></span>
                                                    </a>
                                                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#resolve">
                                                        Resolve
                                                    </a>
                                                </center>
                                            </td>
                                        </tr>
                                        <?php } }?>
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
        <?php include('footer2.php')?>
