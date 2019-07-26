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
            ->setCellValue('B1', ' Open')
            ->setCellValue('C1', 'VATS/Laparoscopy')
            ->setCellValue('D1', 'Hybrid VATS')
            ->setCellValue('E1', 'VATS(Single port)')
            ->setCellValue('F1', 'VATS(Multiple port)')
            ->setCellValue('G1', 'Robot Assisted')
             ->setCellValue('H1', 'Others')
            ->setCellValue('I1', 'Total');
          
$row = 1; 
 $i=0;
foreach($associateList->result() as $myrow) {
   
      $pieces = explode(",", $myrow->sumList);
            
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row + 1, $myrow->category); 
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row + 1, $pieces[0]); 
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row + 1, $pieces[1]); 
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row + 1, $pieces[2]); 
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row + 1, $pieces[4]); 
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row + 1, $pieces[5]); 
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row + 1, $pieces[3]); 
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row + 1, $pieces[6]); 
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $row + 1, $myrow->myTotal); 
        
 
    
    $row++; 
 }
     
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('81DAF580');
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFill()->getStartColor()->setARGB('81DAF580');


  
// Rename worksheet
//echo date('H:i:s') , " Rename worksheet" , EOL;
$objPHPExcel->getActiveSheet()->setTitle('2. Executive Summary');

for($i=0;$i<15;$i++){
    if($answer[$i]!=""){
foreach($answer[$i]->result() as $row){$ans[$i] = explode(",", $row->sumList);}
    }
}
$title[0]="Lung, malignant";
$title[1]="Lung, benign";
$title[2]="Mediastinum, malignant";
$title[3]="Mediastinum, benign";
$title[4]="Esophagus/Cardia/<br/>Hypopharyngeal, malignant";
$title[5]="Esophagus/Cardia, benign";
$title[6]="Trachea";
$title[7]="Pleura";
$title[8]="Diaphragm";
$title[9]="End stage lung disease";
$title[10]="Chest wall";
$title[11]="Miscellaneous";
$title[12]="Chemoport";
 $objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(2)
             ->setCellValue('A1', 'Item')
            ->setCellValue('B1', ' Operative Mortality')
            ->setCellValue('C1', 'Wound Infection')
            ->setCellValue('D1', 'Re-OP')
            ->setCellValue('E1', 'pneumonia')
            ->setCellValue('F1', 'prolong intubation')
            ->setCellValue('G1', 'hemothorax')
            ->setCellValue('H1', 'pneumothorax')
            ->setCellValue('I1', 'B-P fistula')
            ->setCellValue('J1', 'chylothorax')
            ->setCellValue('K1', 'Otanastomosis leakagehers')
            ->setCellValue('L1', 'ileus')
            ->setCellValue('M1', 'aspiration')
            ->setCellValue('N1', 'dysphagia')
            ->setCellValue('O1', 'Arrthymia')
            ->setCellValue('P1', 'Others');
          
$row = 1; 

  for($i=0;$i<sizeof($title);$i++){
   
            
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row + 1, $title[$i]); 
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row + 1, $ans[0][$i]); 
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row + 1, $ans[1][$i]); 
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row + 1, $ans[2][$i]); 
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row + 1, $ans[3][$i]); 
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row + 1, $ans[4][$i]); 
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row + 1, $ans[5][$i]); 
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row + 1, $ans[6][$i]); 
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $row + 1, $ans[7][$i]); 
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $row + 1, $ans[8][$i]); 
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $row + 1, $ans[9][$i]); 
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $row + 1, $ans[10][$i]); 
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12, $row + 1, $ans[11][$i]); 
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13, $row + 1, $ans[12][$i]); 
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(14, $row + 1, $ans[13][$i]); 
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(15, $row + 1, $ans[14][$i]); 
        
 
    
    $row++; 

 }
$objPHPExcel->getActiveSheet()->setTitle('3. Complications');
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
