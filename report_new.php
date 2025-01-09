<?php include("header.php");
ini_set('max_execution_time', 0);
ini_set('memory_limit', '2048M');
?>
<link href="css/buttons.dataTables.min.css" rel="stylesheet">
<script src="scripts/jquery.min.js"></script>
        <!-- /navbar -->
        <div class="wrapper">
            <div id="loader">
                <figure class="one">Please Wait</figure>
                <figure class="two">loading</figure>
            </div>
            <div id="contents" style="display: none">
                <div class="container-fluid">                       
                    <div class="content">                          
                        <div class="module">
                            <div class="module-head">
                                <h2>
                                    REPORT                                        
                                </h2>                                
                            </div>
                            <div class="module-body"> 
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
                        <!--/.module-->
                        <div class="module">  
                            <!-- <div class="content">
                                <div class="module-head">
                                    <a href="export.php" class="btn btn-info">Export To Excel</a>
                                </div>
                            </div>  -->                                                               
                            <div class="module-body table">                                    
                                <table  cellpadding="0" cellspacing="0" border="0" class="display nowrap"
                                            width="100%" id="example">
                                    <tr>
                                        <th width="1%">#</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th> Day</th>
                                        <th>Check In</th>
                                        <th>AM Break Out</th>
                                        <th>AM Break In</th>
                                        <th>NN Break Out</th>
                                        <th>NN Break In</th>
                                        <th>PM Break Out</th>
                                        <th>PM Break In</th>
                                        <th>Check Out</th>
                                    </tr>
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
                                        </tr>
                                        <?php } }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--/.module-->
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
        <!--/.wrapper-->
        <?php include 'footer2.php';?>
