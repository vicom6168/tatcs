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
          
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B1', '')
            ->setCellValue('B2', "Total")
            ->setCellValue('B3', $adult)
            ->setCellValue('B4', "")
            ->setCellValue('B5', "")
            ->setCellValue('B6', "Total")
            ->setCellValue('B7', $a1)
            ->setCellValue('B8', $a2)
            ->setCellValue('B9', $a3)
            ->setCellValue('B10', "")
            ->setCellValue('B11', "")
            ->setCellValue('B12', "Total")
            ->setCellValue('B13', $a4)
            ->setCellValue('B14', $a5)
            ->setCellValue('B15',$a6)
            ->setCellValue('B16', $a7)
            ->setCellValue('B17', $a8)
            ->setCellValue('B18', $a9)
            ->setCellValue('B19', $a10)
            ->setCellValue('B20', $a11)
            ->setCellValue('B21', $a12)
            ->setCellValue('B22', $a13)
            ->setCellValue('B23', $a14)
            ->setCellValue('B24', $a15)
            ->setCellValue('B25', $a16)
            ->setCellValue('B26', $a17);
            
 $objPHPExcel->setActiveSheetIndex(0)
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
            ->setCellValue('C13', $b4)
            ->setCellValue('C14', $b5)
            ->setCellValue('C15',$b6)
            ->setCellValue('C16', $b7)
            ->setCellValue('C17', $b8)
            ->setCellValue('C18', $b9)
            ->setCellValue('C19', $b10)
            ->setCellValue('C20', $b11)
            ->setCellValue('C21', $b12)
            ->setCellValue('C22', $b13)
            ->setCellValue('C23', $b14)
            ->setCellValue('C24', $b15)
            ->setCellValue('C25', $b16)
            ->setCellValue('C26', $b17);

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
