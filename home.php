<?php include("header.php");
$day_now = date('d'); 
//$day_now = 3; 
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
    return $fetch_remarks['remarks'];
}


if($day_now >= 6 && $day_now <=20) {

    $start_date = date("Y-m")."-06";
    $end_date =  date("Y-m")."-20";
} else if($day_now >=21 && $day_now <= 31) {

    $nextmonth = date('Y-m', strtotime("next month"));
    $start_date = date("Y-m")."-21";
    $end_date = $nextmonth."-05";
} else if($day_now >=1 && $day_now <= 5) {

    $lastmonth = date('Y-m', strtotime("last month"));
    $start_date = $lastmonth."-21";
    $end_date = date("Y-m")."-05";
} ?>
        <!-- /navbar -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="content">
                            <div class="btn-controls">
                                <div class="btn-box-row row-fluid">
                                    <a href="#" class="btn-box big span4"><i class=" icon-random"></i><b>65%</b>
                                        <p class="text-muted">
                                            Growth</p>
                                    </a><a href="#" class="btn-box big span4"><i class="icon-user"></i><b>15</b>
                                        <p class="text-muted">
                                            New Users</p>
                                    </a><a href="#" class="btn-box big span4"><i class="icon-money"></i><b>15,152</b>
                                        <p class="text-muted">
                                            Profit</p>
                                    </a>
                                </div>

                                  <div class="module">
                                <div class="module-head">
                                    <h3>
                                        Incomplete Logs for the cutoff period of <span style='color: red'><?php echo date("F j, Y", strtotime($start_date)) . " to " . date("F j, Y", strtotime($end_date)); ?></span></h3>
                                </div>
                                <div class="module-body table">
                                    <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped  display"
                                        width="100%">
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
                                          
                                              $sql = "SELECT DISTINCT personal_id, DATE_FORMAT(recorded_time, '%Y-%m-%d') as rec FROM timekeeping WHERE DATE_FORMAT(recorded_time, '%Y-%m-%d') >= '$start_date' AND DATE_FORMAT(recorded_time, '%Y-%m-%d') <= '$end_date'";
                                              //echo $sql;
                                            
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
                                        

                                        if($cnt % 2 != 0 && empty($remarks)) { ?>

                                        <tr> 
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

                                    ?>
                                    </tbody>
                                        <tfoot>
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
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                                <div class="btn-box-row row-fluid">
                                    <div class="span8">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <a href="#" class="btn-box small span4"><i class="icon-envelope"></i><b>Messages</b>
                                                </a><a href="#" class="btn-box small span4"><i class="icon-group"></i><b>Clients</b>
                                                </a><a href="#" class="btn-box small span4"><i class="icon-exchange"></i><b>Expenses</b>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <a href="#" class="btn-box small span4"><i class="icon-save"></i><b>Total Sales</b>
                                                </a><a href="#" class="btn-box small span4"><i class="icon-bullhorn"></i><b>Social Feed</b>
                                                </a><a href="#" class="btn-box small span4"><i class="icon-sort-down"></i><b>Bounce
                                                    Rate</b> </a>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="widget widget-usage unstyled span4">
                                        <li>
                                            <p>
                                                <strong>Windows 8</strong> <span class="pull-right small muted">78%</span>
                                            </p>
                                            <div class="progress tight">
                                                <div class="bar" style="width: 78%;">
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Mac</strong> <span class="pull-right small muted">56%</span>
                                            </p>
                                            <div class="progress tight">
                                                <div class="bar bar-success" style="width: 56%;">
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Linux</strong> <span class="pull-right small muted">44%</span>
                                            </p>
                                            <div class="progress tight">
                                                <div class="bar bar-warning" style="width: 44%;">
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>iPhone</strong> <span class="pull-right small muted">67%</span>
                                            </p>
                                            <div class="progress tight">
                                                <div class="bar bar-danger" style="width: 67%;">
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--/#btn-controls-->
                            <div class="module">
                                <div class="module-head">
                                    <h3>
                                        Profit Chart</h3>
                                </div>
                                <div class="module-body">
                                    <div class="chart inline-legend grid">
                                        <div id="placeholder2" class="graph" style="height: 500px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/.module-->
                            <div class="module hide">
                                <div class="module-head">
                                    <h3>
                                        Adjust Budget Range</h3>
                                </div>
                                <div class="module-body">
                                    <div class="form-inline clearfix">
                                        <a href="#" class="btn pull-right">Update</a>
                                        <label for="amount">
                                            Price range:</label>
                                        &nbsp;
                                        <input type="text" id="amount" class="input-" />
                                    </div>
                                    <hr />
                                    <div class="slider-range">
                                    </div>
                                </div>
                            </div>
                          




                            <!--/.module-->
                        </div>
                        <!--/.content-->
                    </div>
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>
        <!--/.wrapper-->
        <?php include('footer.php')?>
