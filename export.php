<?php
    ini_set('memory_limit','2000M');
    include 'includes/connection.php';
    $sqli = "SELECT * FROM tbl_dtr";
    $url="";
    if(!empty($_GET)){
        $sqli .= " WHERE"; 
        if(!empty($_GET['date_from'])){
            if(!empty($_GET['date_to'])){
                $sqli .= " dtr_date BETWEEN '$_GET[date_from]' AND '$_GET[date_to]' AND";
                $url.="datefrom=".$_GET['date_from']."&dateto=".$_GET['date_to'];
            }else{
                $sqli .= " dtr_date BETWEEN '$_GET[date_from]' AND '$_GET[date_from]' AND";
                $url.="datefrom=".$_GET['date_from']."&dateto=".$_GET['date_from'];
            }
        }
    }
    $q = substr($sqli,-3);
    if($q == 'AND'){
        $sqli = substr($sqli,0,-3);
    }
    require_once('includes/phpexcel/Classes/PHPExcel/IOFactory.php');
        $objPHPExcel = new PHPExcel();
        $exportfilename="Time Records.xlsx";
        echo $exportfilename;
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "Biometric #");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', "Name");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', "Date");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', "Day");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', "Check In");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', "Break Out");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', "Break In");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1', "Check Out");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1', "Remarks");
        $num=2;
        $query = mysqli_query($con,$sqli);
        /*$sqli = mysqli_query($con,"SELECT * FROM tbl_dtr");*/
        while($row = mysqli_fetch_array($query)){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$num, $row['employee_biometricnumber']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$num, $row['employee_name']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$num, $row['dtr_date']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$num, $row['dtr_day']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$num, $row['dtr_checkin']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$num, $row['dtr_breakout']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$num, $row['dtr_breakin']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$num, $row['dtr_checkout']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$num, $row['dtr_remarks']);
            $num++;
        }
        $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);
      /*  $objPHPExcel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);*/
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        if (file_exists($exportfilename))
        unlink($exportfilename);
        $objWriter->save($exportfilename);
        unset($objPHPExcel);
        unset($objWriter);   
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Time Records.xlsx"');
        readfile($exportfilename);
        echo "<script>window.location = 'report.php';</script>";
?>