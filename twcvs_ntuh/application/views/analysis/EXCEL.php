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
             ->setCellValue('A1', 'Item')
            ->setCellValue('A2', 'CABG =1')
            ->setCellValue('A3', 'CABG ≥2')
            ->setCellValue('A4', 'OPCAB =1')
            ->setCellValue('A5', 'OPCAB ≥2')
            ->setCellValue('A6', 'Valvular Replacement 金屬')
            ->setCellValue('A7', 'Valvular Replacement 組織')
            ->setCellValue('A8', 'Valvular Repair')
            ->setCellValue('A9', 'CHD-No CPB')
            ->setCellValue('A10', 'CHD-Cyanotic')
            ->setCellValue('A11', 'CHD-Non cyanotic')
            ->setCellValue('A12', 'DAA')
            ->setCellValue('A13', 'HTX')
            ->setCellValue('A14', 'ECMO/VAD')
            ->setCellValue('A15', 'TAA')
            ->setCellValue('A16', 'AAA')
            ->setCellValue('A17', 'Others')
            ->setCellValue('A18', 'Total');
            if($this->session->userdata('SP1')=="1"){
                $B14_str="vascular special sheet 1-02 Thoracic endovascular aortic aneurysm repair (TEVAR) 的數字";
                $B15_str="vascular special sheet 1-01 Endovascular aortic aneurysm repair (EVAR) 的數字";
            } else {
                $B14_str="分類8.Aortic Aneurysm thoracic aorta:true";
                $B15_str="分類8.Aortic Aneurysm abdominal aorta :true";
            }
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B1', 'Description')
            ->setCellValue('B2', "分類1.CABG:true\n LIMA+RIMA+GEA+Radial A.+Vein graft<=1 \n Cardiopulmonary bypass : null")
            ->setCellValue('B3', "分類1.CABG:true \n LIMA+RIMA+GEA+Radial A.+Vein graft>1 \n Cardiopulmonary bypass : null")
            ->setCellValue('B4', "分類1.CABG:true \n LIMA+RIMA+GEA+Radial A.+Vein graft<=1 \n Cardiopulmonary bypass : true")
            ->setCellValue('B5', "分類1.CABG:true \n  LIMA+RIMA+GEA+Radial A.+Vein graft>1 \n Cardiopulmonary bypass : true")
            ->setCellValue('B6', "分類2.Valvular Replacement \n (AVR,MVR,TVR,PVR選1.Mechanical)")
            ->setCellValue('B7', "分類2.Valvular Replacement \n(AVR,MVR,TVR,PVR選2.Bioprosthesis)")
            ->setCellValue('B8', "分類3.Vavlvular Repair")
            ->setCellValue('B9', "分類4.CHD \n Cardiopulmonary bypass:null")
            ->setCellValue('B10', "分類4.CHD  \n Cardiopulmonary bypass:true  \n  CHD(open heart surgery): 1.cyanotic")
            ->setCellValue('B11', "分類4.CHD  \n Cardiopulmonary bypass:true   \n CHD(open heart surgery): 2.non-cyanotic")
            ->setCellValue('B12', "分類5.Aortic Dissection")
            ->setCellValue('B13', "分類6.HTX")
            ->setCellValue('B14', "分類7.Mechanical Support")
            ->setCellValue('B15', $B14_str)
            ->setCellValue('B16', $B15_str)
            ->setCellValue('B17', "分類9.PAOD+分類10. Others")
            ->setCellValue('B18', '');

$objPHPExcel->getActiveSheet()->getStyle('B2')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('B3')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('B4')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('B5')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('B6')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('B7')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('B8')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('B9')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('B10')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('B11')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('B12')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('B13')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('B14')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('B15')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('B16')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('B17')->getAlignment()->setWrapText(true);

$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(60);
$objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(60);
$objPHPExcel->getActiveSheet()->getRowDimension('4')->setRowHeight(60);
$objPHPExcel->getActiveSheet()->getRowDimension('5')->setRowHeight(60);
$objPHPExcel->getActiveSheet()->getRowDimension('6')->setRowHeight(60);
$objPHPExcel->getActiveSheet()->getRowDimension('7')->setRowHeight(60);
$objPHPExcel->getActiveSheet()->getRowDimension('8')->setRowHeight(30);
$objPHPExcel->getActiveSheet()->getRowDimension('9')->setRowHeight(30);
$objPHPExcel->getActiveSheet()->getRowDimension('10')->setRowHeight(30);
$objPHPExcel->getActiveSheet()->getRowDimension('11')->setRowHeight(30);
$objPHPExcel->getActiveSheet()->getRowDimension('12')->setRowHeight(30);
$objPHPExcel->getActiveSheet()->getRowDimension('13')->setRowHeight(30);
$objPHPExcel->getActiveSheet()->getRowDimension('14')->setRowHeight(30);
$objPHPExcel->getActiveSheet()->getRowDimension('15')->setRowHeight(30);
$objPHPExcel->getActiveSheet()->getRowDimension('16')->setRowHeight(30);
$objPHPExcel->getActiveSheet()->getRowDimension('17')->setRowHeight(30);
$objPHPExcel->getActiveSheet()->getRowDimension('18')->setRowHeight(30);
// Miscellaneous glyphs, UTF-8
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C1', 'No.')
            ->setCellValue('C2',$answer[8] )
            ->setCellValue('C3', $answer[9])
            ->setCellValue('C4', $answer[10])
            ->setCellValue('C5', $answer[11])
            ->setCellValue('C6', $answer[12])
            ->setCellValue('C7', $answer[13])
            ->setCellValue('C8', $answer[14])
            ->setCellValue('C9', $answer[1])
            ->setCellValue('C10',$answer[2] )
            ->setCellValue('C11', $answer[3])
            ->setCellValue('C12',$answer[6] )
            ->setCellValue('C13',$answer[4] )
            ->setCellValue('C14', $answer[5])
            ->setCellValue('C15', $answer[7])
            ->setCellValue('C16', $answer[16])
            ->setCellValue('C17',$answer[17] )
            ->setCellValue('C18', $answer[15]);

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
