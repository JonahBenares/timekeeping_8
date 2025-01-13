<?php 
    /*error_reporting(0);*/
    ini_set('upload_max_filesize', '5000M');
    ini_set('post_max_size', '5000M');
    ini_set('max_input_time', 5000);
    ini_set('max_execution_time', 5000);
    ini_set('memory_limit','2000M');
    include 'includes/connection.php';
    // require_once('includes/phpexcel/Classes/PHPExcel/IOFactory.php');
    require_once('vendor\autoload.php');
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx as writerxlsx;
    use PhpOffice\PhpSpreadsheet\Reader\Csv;
    use PhpOffice\PhpSpreadsheet\Reader\Xlsx as readerxlsx;
    use PhpOffice\PhpSpreadsheet\Worksheet\Drawing as drawing; // Instead PHPExcel_Worksheet_Drawing
    use PhpOffice\PhpSpreadsheet\Style\Alignment as alignment; // Instead alignment
    use PhpOffice\PhpSpreadsheet\Style\Border as border;
    use PhpOffice\PhpSpreadsheet\Style\NumberFormat as number_format;
    use PhpOffice\PhpSpreadsheet\Style\Fill as fill; // Instead fill
    use PhpOffice\PhpSpreadsheet\Style\Color as color; //Instead PHPExcel_Style_Color
    use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup as pagesetup; // Instead PHPExcel_Worksheet_PageSetup
    use PhpOffice\PhpSpreadsheet\IOFactory as io_factory; // Instead PHPExcel_IOFactory


    $dest= realpath('uploads/excel/');
    $error_ext=0;
    if(!empty($_FILES['csv']['name'])){
        $exc= basename($_FILES['csv']['name']);
        $exc=explode('.',$exc);
        $ext1=$exc[1];
        if($ext1=='php' || $ext1!='xlsx'){
            $error_ext++;
        } 
        else {
            $filename1='Time Record Administrator.'.$ext1;
            if(move_uploaded_file($_FILES["csv"]['tmp_name'], $dest.'/'.$filename1)){
                // $objPHPExcel = new PHPExcel();
                $objPHPExcel = new Spreadsheet();
                $inputFileName =realpath('uploads/excel/Time Record Administrator.xlsx');
                try {
                    $inputFileType = io_factory::identify($inputFileName);
                    $objReader = io_factory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);
                } 
                catch(Exception $e) {
                    die('Error loading file"'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
                }
                $highestRow = $objPHPExcel->getActiveSheet()->getHighestRow();
                for($x=0;$x<=$highestRow;$x++){
                    $bio_id = $objPHPExcel->getActiveSheet()->getCell('A'.$x)->getValue();
                    $name = trim($objPHPExcel->getActiveSheet()->getCell('B'.$x)->getValue());
                    $date = trim($objPHPExcel->getActiveSheet()->getCell('C'.$x)->getFormattedValue());
                    $day = trim($objPHPExcel->getActiveSheet()->getCell('D'.$x)->getFormattedValue());
                    $check_in = trim($objPHPExcel->getActiveSheet()->getCell('E'.$x)->getValue());
                    $break_out_am = trim($objPHPExcel->getActiveSheet()->getCell('F'.$x)->getValue());
                    $break_in_am = trim($objPHPExcel->getActiveSheet()->getCell('G'.$x)->getValue());
                    $break_out_nn = trim($objPHPExcel->getActiveSheet()->getCell('H'.$x)->getValue());
                    $break_in_nn = trim($objPHPExcel->getActiveSheet()->getCell('I'.$x)->getValue());
                    $break_out_pm = trim($objPHPExcel->getActiveSheet()->getCell('J'.$x)->getValue());
                    $break_in_pm = trim($objPHPExcel->getActiveSheet()->getCell('K'.$x)->getValue());
                    $check_out = trim($objPHPExcel->getActiveSheet()->getCell('L'.$x)->getValue());
                    $remarks = trim($objPHPExcel->getActiveSheet()->getCell('I'.$x)->getValue());
                    $duperaw = mysqli_query($con,"SELECT dtr_Id FROM tbl_dtr_2020 WHERE (employee_biometricnumber = '$bio_id' AND dtr_date = '$date' AND dtr_checkin = '$check_in')");
                    $count = mysqli_num_rows($duperaw);
                    $row = mysqli_fetch_array($duperaw);
                    if($count>0) {
                        $query= mysqli_query($con,"UPDATE tbl_dtr_2020 SET employee_biometricnumber='".$bio_id."',employee_name='".$name."',dtr_date='".$date."',dtr_day='".$day."',dtr_checkin='".$check_in."',dtr_breakout_am='".$break_out_am."',dtr_breakin_am='".$break_in_am."',dtr_breakout_nn='".$break_out_nn."',dtr_breakin_nn='".$break_in_nn."',dtr_breakout_pm='".$break_out_pm."',dtr_breakin_pm='".$break_in_pm."',dtr_checkout='".$check_out."',dtr_remarks='".$remarks."' WHERE dtr_Id = '$row[dtr_Id]'");
                        echo "<script>alert('Successfully Updated!'); window.location = 'report.php';</script>";
                    }
                    else{
                        $sql = mysqli_query($con,"INSERT INTO tbl_dtr_2020 (employee_biometricnumber,employee_name,dtr_date,dtr_day,dtr_checkin,dtr_breakout_am,dtr_breakin_am,dtr_breakout_nn,dtr_breakin_nn,dtr_breakout_pm,dtr_breakin_pm,dtr_checkout,dtr_remarks) VALUES ('".$bio_id."','".$name."','".$date."','".$day."','".$check_in."','".$break_out_am."','".$break_in_am."','".$break_out_nn."','".$break_in_nn."','".$break_out_pm."','".$break_in_pm."','".$check_out."','".$remarks."')");
                        echo "<script>alert('Successfully Uploaded!'); window.location = 'report.php';</script>";
                    }
                }
            }        
        }
    }
?>