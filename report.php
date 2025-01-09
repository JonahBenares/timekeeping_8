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
                <div class="container">
                    <div class="row">
                        <div class="span12">                        
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
                                        <table cellpadding="0" cellspacing="0" border="0" class="display nowrap"
                                            width="100%" id="example">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Biometric #
                                                    </th>
                                                    <th>
                                                        Name
                                                    </th>
                                                    <th>
                                                        Date
                                                    </th>
                                                    <th>
                                                        Day
                                                    </th>
                                                    <th>
                                                        Check In
                                                    </th>
                                                    <th>
                                                        Break Out
                                                    </th>
                                                    <th>
                                                        Break In
                                                    </th>
                                                    <th>
                                                        Check Out
                                                    </th>
                                                    <th>
                                                        Remarks
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $sql = "SELECT * FROM tbl_dtr";
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
                                                    <td>
                                                        <?php echo $row['employee_biometricnumber']?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['employee_name']?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['dtr_date']?>
                                                    </td>
                                                    <td>
                                                       <?php echo $row['dtr_day']?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['dtr_checkin']?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['dtr_breakout']?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['dtr_breakin']?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['dtr_checkout']?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['dtr_remarks']?>
                                                    </td>
                                                </tr>
                                                <?php } }?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>
                                                        Biometric #
                                                    </th>
                                                    <th>
                                                        Name
                                                    </th>
                                                    <th>
                                                        Date
                                                    </th>
                                                    <th>
                                                        Day
                                                    </th>
                                                    <th>
                                                        Check In
                                                    </th>
                                                    <th>
                                                        Break Out
                                                    </th>
                                                    <th>
                                                        Break In
                                                    </th>
                                                    <th>
                                                        Check Out
                                                    </th>
                                                    <th>
                                                        Remarks
                                                    </th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <!--/.module-->
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
        <!--/.wrapper-->
        <?php include 'footer2.php';?>
