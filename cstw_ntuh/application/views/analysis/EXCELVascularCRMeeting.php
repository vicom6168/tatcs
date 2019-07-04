<?php
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2014 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    1.8.0, 2014-03-02
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Asia/Taipei');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

/** Include PHPExcel */
require_once './application/libraries/Classes/PHPExcel.php';

$outputDir='./download/';

// Create new PHPExcel object
//echo date('H:i:s') , " Create new PHPExcel object" , EOL;
$objPHPExcel = new PHPExcel();

// Set document properties
//echo date('H:i:s') , " Set document properties" , EOL;
$objPHPExcel->getProperties()->setCreator("Vic Wang")
                             ->setLastModifiedBy("Vic Wang")
                             ->setTitle("學會統計報表")
                             ->setSubject("學會統計報表")
                             ->setDescription("Test document for PHPExcel, generated using PHP classes.")
                             ->setKeywords("office PHPExcel php")
                             ->setCategory("Test result file");


// Add some data
//echo date('H:i:s') , " Add some data" , EOL;
$objPHPExcel->setActiveSheetIndex(0)
             ->setCellValue('A1', 'OP date')
            ->setCellValue('B1', 'Name')
            ->setCellValue('C1', 'Age')
            ->setCellValue('D1', 'Gender')
            ->setCellValue('E1', 'Diagnosis')
            ->setCellValue('F1', 'Treatement')
            ->setCellValue('G1', 'Operator'); 
            $i=1; 
            
          foreach($patientList->result() as $row){
              $i++;
              $age="";
           $age.=    $row->patientAge;
                                     if($row->patientAgeUnit=="1") {
                                                        $age.=  " 歲";
                                     }
                                                        elseif($row->patientAgeUnit=="2"){
                                                        $age.=   " 月";
                                      } else {
                                                        $age.=    " 天";
                                     } 
                $patientProcedure="";                   
                                        if($row->patientProcedure1!='')
                $patientProcedure.=$row->patientProcedure1."\n"; 
                if($row->patientProcedure2!='')
                $patientProcedure.= $row->patientProcedure2."\n"; 
                if($row->patientProcedure3!='')
                $patientProcedure.= $row->patientProcedure3."\n"; 
                if($row->patientProcedure4!='')
                $patientProcedure.= $row->patientProcedure4."\n"; 
                if($row->patientProcedure5!='')
                $patientProcedure.= $row->patientProcedure5."\n"; 
                if($row->patientProcedureOthers!='')
                $patientProcedure.= $row->patientProcedureOthers."\n"; 
                
                $patientSurgery="";
                 if($row->patientSurgeon!='')
                $patientSurgery.= $row->patientSurgeon."\n"; 
                 if($row->patientSurgeon2!='')
                $patientSurgery.= $row->patientSurgeon2."\n"; 
                 if($row->patientSurgeon3!='')
                $patientSurgery.= $row->patientSurgeon3."\n"; 
                 if($row->patientSurgeon4!='')
                $patientSurgery.= $row->patientSurgeon4."\n"; 
                 
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $row->patientOpDate)
            ->setCellValue('B'.$i, $row->patientName)
            ->setCellValue('C'.$i, $age)
            ->setCellValue('D'.$i, $row->patientGender)
            ->setCellValue('E'.$i, $row->patientDiagnosis)
            ->setCellValue('F'.$i, $patientProcedure)
            ->setCellValue('G'.$i, $patientSurgery);
         
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getAlignment()->setWrapText(true);
}
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('C1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('D1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('E1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('F1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('G1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('81DAF580');
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFill()->getStartColor()->setARGB('81DAF580');
$objPHPExcel->getActiveSheet()->getStyle('C1')->getFill()->getStartColor()->setARGB('81DAF580');
$objPHPExcel->getActiveSheet()->getStyle('D1')->getFill()->getStartColor()->setARGB('81DAF580');
$objPHPExcel->getActiveSheet()->getStyle('E1')->getFill()->getStartColor()->setARGB('81DAF580');
$objPHPExcel->getActiveSheet()->getStyle('F1')->getFill()->getStartColor()->setARGB('81DAF580');
$objPHPExcel->getActiveSheet()->getStyle('G1')->getFill()->getStartColor()->setARGB('81DAF580');


  
// Rename worksheet
//echo date('H:i:s') , " Rename worksheet" , EOL;
$objPHPExcel->getActiveSheet()->setTitle('Report');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Save Excel 2007 file
//echo date('H:i:s') , " Write to Excel2007 format" , EOL;
$callStartTime = microtime(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
//$callEndTime = microtime(true);
//$callTime = $callEndTime - $callStartTime;

// We'll be outputting an excel file
header('Content-type: application/vnd.ms-excel');
// It will be called file.xls
header('Content-Disposition: attachment; filename="Vascular.xlsx"');
// Write file to the browser
$objWriter->save('php://output');

//echo date('H:i:s') , " File written to " , str_replace('.php', '.xlsx', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
//echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
// Echo memory usage
//echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;


// Save Excel5 file
//echo date('H:i:s') , " Write to Excel5 format" , EOL;
$callStartTime = microtime(true);

//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
//$objWriter->save(str_replace('.php', '.xls', __FILE__));
$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;


//if (!copy('./application/views/analysis/EXCEL.xlsx', $outputDir.'EXCEL.xlsx')) {
 //   echo "failed to copy ...\n";
//}
//echo date('H:i:s') , " File written to " , str_replace('.php', '.xls', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
//echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
// Echo memory usage
//echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;


// Echo memory peak usage
//echo date('H:i:s') , " Peak memory usage: " , (memory_get_peak_usage(true) / 1024 / 1024) , " MB" , EOL;

// Echo done
//echo date('H:i:s') , " Done writing files" , EOL;
//echo 'Files have been created in ' , getcwd() , EOL;
