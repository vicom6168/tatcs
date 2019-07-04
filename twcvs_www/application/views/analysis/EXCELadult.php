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
$objPHPExcel->setActiveSheetIndex(0)
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
