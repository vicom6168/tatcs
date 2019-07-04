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
$row = 1; 
foreach($patientList->result() as $myrow) {
    $col = 0; 
    foreach($myrow as $key=>$value) { 
        // TODO: Do Something With the Column Name like set the row header. Note this crude code sets it every time. You really just want to do it the first time only.
            if($row == 1)
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $key);
            
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row + 1, $value); 
        $col++; 
        
    } 
    
    $row++; 
 }
  
 
// Rename worksheet
//echo date('H:i:s') , " Rename worksheet" , EOL;
$objPHPExcel->getActiveSheet()->setTitle('1. Patient List');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


//Second Sheet
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(1)
             ->setCellValue('A1', 'Item')
            ->setCellValue('A2', ' Overall Cardiac Surgery')
            ->setCellValue('A3', 'Adult cardiac surgery')
            ->setCellValue('A4', 'Congenital cardiac surgery')
            ->setCellValue('A5', 'Non-cardiac surgery');
          
$objPHPExcel->setActiveSheetIndex(1)
            ->setCellValue('B1', 'number')
            ->setCellValue('B2', $total)
            ->setCellValue('B3', $adult)
            ->setCellValue('B4', $child)
            ->setCellValue('B5', $Noncardiac);
     
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('81DAF580');
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFill()->getStartColor()->setARGB('81DAF580');


  
// Rename worksheet
//echo date('H:i:s') , " Rename worksheet" , EOL;
$objPHPExcel->getActiveSheet()->setTitle('2. Executive Summary');


$objPHPExcel->createSheet();
 $objPHPExcel->setActiveSheetIndex(2)
   ->setCellValue('A1', 'Executive summary of adult cardiac surgery')
            ->setCellValue('A2', 'Item ')
            ->setCellValue('A3', 'Adult cardiac surgery count ')
            ->setCellValue('A4', '')
            ->setCellValue('A5', 'Major Procedures1-2')
            ->setCellValue('A6', 'Item ')
            ->setCellValue('A7', ' Isolated CAB')
            ->setCellValue('A8', 'Isolated Aortic Valve Replacement ')
            ->setCellValue('A9', 'Isolated Mitral Valve Replacement')
            ->setCellValue('A10', 'Aortic Valve Replacement + CAB')
            ->setCellValue('A11', 'Mitral Valve Replacement + CAB ')
            ->setCellValue('A12', 'Aortic + Mitral Valve Replacements ')
            ->setCellValue('A13', 'Mitral Valve Repair')
            ->setCellValue('A14', 'Mitral Valve Repair + CAB ')
            ->setCellValue('A15', 'Not Classified Above')
            ->setCellValue('A16', '')
            ->setCellValue('A17', 'Incidence of Other Procedures')
            ->setCellValue('A18', 'Item ')
            ->setCellValue('A19', 'CABG ')
            ->setCellValue('A20', 'Aortic Valve ')
            ->setCellValue('A21', 'Mitral Valve ')
            ->setCellValue('A22', 'Pulmonic Valve ')
            ->setCellValue('A23', 'Tricuspid Valve')
            ->setCellValue('A24', 'Ventricular Assist Device')
            ->setCellValue('A25', 'LV aneurysm surgery ')
            ->setCellValue('A26', 'Cardiac Trauma ')
            ->setCellValue('A27', 'Cardiac Transplant')
            ->setCellValue('A28', 'Atrial Fibrillation Correction Surgery ')
            ->setCellValue('A29', 'Aortic Aneurysm ')
            ->setCellValue('A30', 'Ascending Aorta')
            ->setCellValue('A31', 'Aortic Arch')
            ->setCellValue('A32', 'Descending Aorta ')
            ->setCellValue('A33', 'Thoracoabdominal Aorta')
            ->setCellValue('A34', 'Intracardiac Tumor')
            ->setCellValue('A35', 'Pulmonary Thromboembolectomy ')
            ->setCellValue('A36', 'Other cardiac ');
$objPHPExcel->setActiveSheetIndex(2)
            ->setCellValue('B1', '')
            ->setCellValue('B2', "Total")
            ->setCellValue('B3', $adult)
            ->setCellValue('B4', "")
            ->setCellValue('B5', "")
            ->setCellValue('B6', "Total")
            ->setCellValue('B7', $ans1)
            ->setCellValue('B8', $ans2)
            ->setCellValue('B9', $ans3)
            ->setCellValue('B10', $ans4)
            ->setCellValue('B11', $ans5)
            ->setCellValue('B12', $ans6)
            ->setCellValue('B13', $ans7)
            ->setCellValue('B14', $ans8)
            ->setCellValue('B15',$ans9)
            ->setCellValue('B16', "")
            ->setCellValue('B17', "")
            ->setCellValue('B18', "Total")
            ->setCellValue('B19', $a1)
            ->setCellValue('B20', $a2)
            ->setCellValue('B21', $a3)
            ->setCellValue('B22', $a4)
            ->setCellValue('B23', $a5)
            ->setCellValue('B24', $a6)
            ->setCellValue('B25', $a7)
            ->setCellValue('B26', $a8)
            ->setCellValue('B27', $a9)
             ->setCellValue('B28', $a10)
             ->setCellValue('B29', $a11)
             ->setCellValue('B30', $a12)
             ->setCellValue('B31', $a13)
             ->setCellValue('B32', $a14)
             ->setCellValue('B33', $a15)
            ->setCellValue('B34', $a16)
            ->setCellValue('B35', $a17)
            ->setCellValue('B36', $a18);

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('AC58FA80');
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFill()->getStartColor()->setARGB('AC58FA80');

$objPHPExcel->getActiveSheet()->getStyle('A2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('B2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('A2')->getFill()->getStartColor()->setARGB('81DAF580');
$objPHPExcel->getActiveSheet()->getStyle('B2')->getFill()->getStartColor()->setARGB('81DAF580');

$objPHPExcel->getActiveSheet()->getStyle('A5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('B5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('A5')->getFill()->getStartColor()->setARGB('AC58FA80');
$objPHPExcel->getActiveSheet()->getStyle('B5')->getFill()->getStartColor()->setARGB('AC58FA80');

$objPHPExcel->getActiveSheet()->getStyle('A6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('A6')->getFill()->getStartColor()->setARGB('81DAF580');
$objPHPExcel->getActiveSheet()->getStyle('B6')->getFill()->getStartColor()->setARGB('81DAF580');

$objPHPExcel->getActiveSheet()->getStyle('A17')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('B17')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('A17')->getFill()->getStartColor()->setARGB('AC58FA80');
$objPHPExcel->getActiveSheet()->getStyle('B17')->getFill()->getStartColor()->setARGB('AC58FA80');

$objPHPExcel->getActiveSheet()->getStyle('A18')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('B18')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('A18')->getFill()->getStartColor()->setARGB('81DAF580');
$objPHPExcel->getActiveSheet()->getStyle('B18')->getFill()->getStartColor()->setARGB('81DAF580');

 $objPHPExcel->getActiveSheet()->setTitle('3. Summary of Adult');
 
 $objPHPExcel->createSheet();
 $objPHPExcel->setActiveSheetIndex(3)
             ->setCellValue('A1', 'Executive summary of Congenital surgery')
            ->setCellValue('A2', 'Item ')
            ->setCellValue('A3', 'Congenital cardiac surgery count')
            ->setCellValue('A4', '')
            ->setCellValue('A5', 'Major Procedures1-2')
            ->setCellValue('A6', 'Item ')
            ->setCellValue('A7', 'Adult Congenital Cardiac Procedure')
            ->setCellValue('A8', 'Procedure with CPB')
            ->setCellValue('A9', 'Procedure without CPB ')
            ->setCellValue('A10', '')
            ->setCellValue('A11', 'Index procedure')
            ->setCellValue('A12', 'Item')
            ->setCellValue('A13', 'Ventricular Septal Defect')
            ->setCellValue('A14', 'Tetralogy of Fallot ')
            ->setCellValue('A15', 'Transposition of the Great Arteries with intact Ventricular Septum')
            ->setCellValue('A16', 'Transposition of the Great Arteries with Ventricular Septum Defect')
            ->setCellValue('A17', 'Coarctation of the Aorta ')
            ->setCellValue('A18', 'Superior Caval to Pulmonary Artery Anastomosis  ')
            ->setCellValue('A19', 'Compete Caval to Pulmonary Artery Anastomosis ')
            ->setCellValue('A20', 'Truncus Arteriosus ')
            ->setCellValue('A21', 'Hypoplastic Left Heart Syndrome')
            ->setCellValue('A22', 'Total Anomalous Pulmonary Venous Connection')
            ->setCellValue('A23', 'Partial Anomalous Pulmonary Venous Connection ')
            ->setCellValue('A24', 'Atrioventricular Septal Defect')
            ->setCellValue('A25', 'Interrupted Aortic Arch')
            ->setCellValue('A26', 'Ebstein Malformation  ');
          
$objPHPExcel->setActiveSheetIndex(3)
            ->setCellValue('B1', '')
            ->setCellValue('B2', "Total")
            ->setCellValue('B3', $a_adult)
            ->setCellValue('B4', "")
            ->setCellValue('B5', "")
            ->setCellValue('B6', "Total")
            ->setCellValue('B7', $a_a1)
            ->setCellValue('B8', $a_a2)
            ->setCellValue('B9', $a_a3)
            ->setCellValue('B10', "")
            ->setCellValue('B11', "")
            ->setCellValue('B12', "Total")
            ->setCellValue('B13', $a_a4)
            ->setCellValue('B14', $a_a5)
            ->setCellValue('B15',$a_a6)
            ->setCellValue('B16', $a_a7)
            ->setCellValue('B17', $a_a8)
            ->setCellValue('B18', $a_a9)
            ->setCellValue('B19', $a_a10)
            ->setCellValue('B20', $a_a11)
            ->setCellValue('B21', $a_a12)
            ->setCellValue('B22', $a_a13)
            ->setCellValue('B23', $a_a14)
            ->setCellValue('B24', $a_a15)
            ->setCellValue('B25', $a_a16)
            ->setCellValue('B26', $a_a17);
            
 $objPHPExcel->setActiveSheetIndex(3)
            ->setCellValue('C1', '')
            ->setCellValue('C2', "")
            ->setCellValue('C3', "")
            ->setCellValue('C4', "")
            ->setCellValue('C5', "")
            ->setCellValue('C6', "")
            ->setCellValue('C7',  "")
            ->setCellValue('C8',  "")
            ->setCellValue('C9',  "")
            ->setCellValue('C10', "")
            ->setCellValue('C11', "")
            ->setCellValue('C12', "Sole")
            ->setCellValue('C13', $a_b4)
            ->setCellValue('C14', $a_b5)
            ->setCellValue('C15',$a_b6)
            ->setCellValue('C16', $a_b7)
            ->setCellValue('C17', $a_b8)
            ->setCellValue('C18', $a_b9)
            ->setCellValue('C19', $a_b10)
            ->setCellValue('C20', $a_b11)
            ->setCellValue('C21', $a_b12)
            ->setCellValue('C22', $a_b13)
            ->setCellValue('C23', $a_b14)
            ->setCellValue('C24', $a_b15)
            ->setCellValue('C25', $a_b16)
            ->setCellValue('C26', $a_b17);
// Save Excel 2007 file
//echo date('H:i:s') , " Write to Excel2007 format" , EOL;
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('AC58FA80');
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFill()->getStartColor()->setARGB('AC58FA80');

$objPHPExcel->getActiveSheet()->getStyle('A2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('B2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('A2')->getFill()->getStartColor()->setARGB('81DAF580');
$objPHPExcel->getActiveSheet()->getStyle('B2')->getFill()->getStartColor()->setARGB('81DAF580');

$objPHPExcel->getActiveSheet()->getStyle('A5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('B5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('A5')->getFill()->getStartColor()->setARGB('AC58FA80');
$objPHPExcel->getActiveSheet()->getStyle('B5')->getFill()->getStartColor()->setARGB('AC58FA80');

$objPHPExcel->getActiveSheet()->getStyle('A6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('A6')->getFill()->getStartColor()->setARGB('81DAF580');
$objPHPExcel->getActiveSheet()->getStyle('B6')->getFill()->getStartColor()->setARGB('81DAF580');

$objPHPExcel->getActiveSheet()->getStyle('A11')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('B11')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('C11')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('A11')->getFill()->getStartColor()->setARGB('AC58FA80');
$objPHPExcel->getActiveSheet()->getStyle('B11')->getFill()->getStartColor()->setARGB('AC58FA80');
$objPHPExcel->getActiveSheet()->getStyle('C11')->getFill()->getStartColor()->setARGB('AC58FA80');

$objPHPExcel->getActiveSheet()->getStyle('A12')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('B12')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('C12')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('A12')->getFill()->getStartColor()->setARGB('81DAF580');
$objPHPExcel->getActiveSheet()->getStyle('B12')->getFill()->getStartColor()->setARGB('81DAF580');
$objPHPExcel->getActiveSheet()->getStyle('C12')->getFill()->getStartColor()->setARGB('81DAF580');
 $objPHPExcel->getActiveSheet()->setTitle('4. Summary of Congenital');
 
 $objPHPExcel->setActiveSheetIndex(0);
$callStartTime = microtime(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
//$callEndTime = microtime(true);
//$callTime = $callEndTime - $callStartTime;

// We'll be outputting an excel file
header('Content-type: application/vnd.ms-excel');
// It will be called file.xls
header('Content-Disposition: attachment; filename="file.xlsx"');
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
//    echo "failed to copy ...\n";
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
