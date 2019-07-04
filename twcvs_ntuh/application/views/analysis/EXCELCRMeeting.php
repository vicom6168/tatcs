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
            ->setCellValue('E1', 'EuroScore II')
            ->setCellValue('F1', 'Diagnosis')
            ->setCellValue('G1', 'Treatement')
            ->setCellValue('H1', 'Operator'); 
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
                                     
                  $html='';
                                  if($row->operationCABG=='Y'){
                $html.="CABG(";
       if($row->operationLIMA!='' && $row->operationLIMA!='0' )
                $html.="LIMA:".$row->operationLIMA.",";       
       if($row->operationRIMA!='' && $row->operationRIMA!='0' )
                $html.="RIMA:".$row->operationRIMA.",";  
       if($row->operationRIMA_RadialA!='' && $row->operationRIMA_RadialA!='0' )
                $html.="Radial artery:".$row->operationRIMA_RadialA.",";  
       if($row->operationRIMA_GEA!='' && $row->operationRIMA_GEA!='0' )
                $html.="Gastroepiploic artery :".$row->operationRIMA_GEA.",";  
       if($row->operationVeinGraft!='' && $row->operationVeinGraft!='0' )
                $html.="Vein graft:".$row->operationVeinGraft.",";  
       $html.=")\n";
        }
        if($row->operationAorticValve=='Y'){
           //     $html.="Aortic valve surgery\n";
          if($row->operationAorticValve_AVP=='Y')
                $html.="AVP";
         if($row->operationAVP!='')
                $html.="(".$row->operationAVP.")"; 
         $html.="\n";
          if($row->operationAorticValve_AVR=='Y')
                $html.="AVR";
         if($row->operationAVRSelect!='')
                $html.="(".$row->operationAVRSelect.")"; 
         $html.="\n";
         if($row->operationMitralValveBentall=='Y')
                $html.="Bentall’s Op\n";
          }
        if($row->operationAorticSurgery=='Y'){
                $html.="Aortic surgery(";
        if($row->operationDissection=='Y')
                $html.="Dissection,";
        if($row->operationAneurysm=='Y')
                $html.="Aneurysm";
            $html.=")\n";
        }
        if($row->operationMitralValve=='Y'){
          //      $html.="Mitral valve surgery\n";
       if($row->Operation_MitralValve_MVP=='Y')
               $html.="MVP(";
        if($row->operationMVPRing=='Y')
                $html.="Ring,";
        if($row->operationMVPArtificialChord=='Y')
                $html.="Artificial chordae,";
        if($row->operationMVPAnnularPlication=='Y')
                $html.="Annular plication";
        if($row->operationMVPLeafletResection=='Y')
                $html.="Leaflet resection";
        if($row->Operation_MitralValve_MVP=='Y')
        $html.=")\n";
       
       // if($row->operationMVPOthers=='Y')
          //      $html.="Mitral valve surgery Ohers\n";
        if($row->Operation_MitralValve_MVR=='Y')
                $html.="MVR";
         if($row->operationMVR!='')
                $html.="(".$row->operationMVR.")";
         if($row->Operation_MitralValve_MVR=='Y')
         $html.="\n";
        }
      if($row->operationArrythmiaSurgery=='Y'){
            //    $html.="Arrhythmia surgery\n";
         if($row->operationMazebiatrialLesion=='Y')
                $html.="Maze (";
          if($row->operationMazeLA=='Y')
                $html.="LA Maze (no RA lesion) ,";
           if($row->operationMazePVIwithLAA=='Y')
                $html.="PVI with LAA closure,";
            if($row->operationMazePVIwithoutLAA=='Y')
                $html.="PVI without LAA closure ,";
             if($row->operationMazeOthers=='Y')
                $html.="Maze Others,";
            //  if($row->operationMazeEnergySource!='')
              //$html.="Energy source";
                //$html.="Energy source:".$row->operationMazeEnergySource."";
               if($row->operationMazebiatrialLesion=='Y')
              $html.=")\n";
         }
        if($row->operationTricuspidValve=='Y'){
           //     $html.="Tricuspid valve surgery\n";
      if($row->Operation_TricuspidValve_TVP=='Y')
              $html.="TVP(";
        if($row->operationTVPRing=='Y')
                $html.="Ring,";
        if($row->operationTVPArtificialChord=='Y')
                $html.="Artificial chordae,";
        if($row->operationTVPAnnularPlication=='Y')
                $html.="Annular plication,";
        if($row->operationTVPLeafletResection=='Y')
                $html.="Leaflet resection";
        if($row->Operation_TricuspidValve_TVP=='Y')
        $html.=")\n";
      
       // if($row->operationTVPOthers=='Y')
          //      $html.="Tricuspid valve surgery Ohers\n";
        if($row->Operation_TricuspidValve_TVR=='Y')
                $html.="TVR";
         if($row->operationTVR!='')
                $html.="(".$row->operationTVR.")";
          if($row->Operation_TricuspidValve_TVR=='Y')
         $html.="\n";
        }
                
        if($row->operationPulmonaryValve=='Y'){
         //       $html.="Pulmonary valve surgery\n";
        if($row->Operation_PulmonaryValve_PVP=='Y')
                $html.="PVP";
         if($row->operationPulmonaryValvePVP!='')
                $html.="(".$row->operationPulmonaryValvePVP.")";
           if($row->Operation_PulmonaryValve_PVP=='Y')
         $html.="\n";
        
       if($row->Operation_PulmonaryValve_PVR=='Y')
                $html.="PVR";
         if($row->operationPulmonaryValvePVR!='')
                $html.="(".$row->operationPulmonaryValvePVR.")";
          if($row->Operation_PulmonaryValve_PVR=='Y')
                $html.="\n";
       }
         
      //  if($row->operationHeartTransplantation=='Y')
          //      $html.="Heart transplant , Mechanical support:\n";
         if($row->operationHeartTransplantationOP=='Y')
                $html.="Heart transplant \n";
          if($row->operationHeartTransplantationLVAD=='Y')
                $html.="LVAD\n";
           if($row->operationHeartTransplantationRVAD=='Y')
                $html.="RVAD\n";
                   
        if($row->operationOtherCardiacSurgery1=='Y')
                $html.="Repair of Post-MI free wall rupture\n";
        if($row->operationOtherCardiacSurgery2=='Y')
                $html.="Repair of Post-MI ventricular septal defect (VSR)\n";
           if($row->operationOtherCardiacSurgery3=='Y')
                $html.=" Repair of traumatic cardiac rupture\n";
       if($row->operationOtherCardiacSurgery4=='Y')
                $html.=" Intracardiac tumor excision\n";
      if($row->operationOtherCardiacSurgery5=='Y')
                $html.="Septal myectomy\n";
      if($row->operationOtherCardiacSurgery6=='Y')
                $html.="Pericardiectomy\n";
      if($row->operationOtherCardiacSurgery7=='Y')
                $html.="LV aneurysm surgery\n";
      if($row->operationOtherCardiacSurgery8=='Y')
                $html.="Pulmonary embolectomy\n";
      if($row->operationOtherCardiacSurgery9=='Y')
                $html.="Pulmonary endarterectomy\n";
      if($row->operationOtherCardiacSurgery11=='Y')
                $html.="Cardiac Implantable Electronic Device lead insertion, replacement, or extraction\n";
      if($row->operationOtherCardiacSurgery10=='Y')
                $html.="Others\n";
     if($row->CongenitalProcedure1!='')
                $html.=$row->CongenitalProcedure1."\n"; 
     if($row->CongenitalProcedure2!='')
                $html.=$row->CongenitalProcedure2."\n"; 
     if($row->CongenitalProcedure3!='')
                $html.=$row->CongenitalProcedure3."\n"; 
     if($row->CongenitalProcedure4!='')
                $html.=$row->CongenitalProcedure4."\n"; 
     if($row->CongenitalProcedure5!='')
                $html.=$row->CongenitalProcedure5."\n"; 
      
          if($row->operationCABGMemo!='')
       $html.="".$row->operationCABGMemo."\n"; 
         if($row->operationAorticMemo!='')
       $html.="".$row->operationAorticMemo."\n"; 
           if($row->operationAorticSurgeryMemo!='')
       $html.="".$row->operationAorticSurgeryMemo."\n"; 
         if($row->operationMVRMemo!='')
       $html.="".$row->operationMVRMemo."\n"; 
         if($row->operationMazeMemo!='')
       $html.="".$row->operationMazeMemo."\n"; 
           if($row->operationTricuspidValveMemo!='')
       $html.="".$row->operationTricuspidValveMemo."\n"; 
             if($row->operationPulmonaryValveMemo!='')
       $html.="".$row->operationPulmonaryValveMemo."\n"; 
               if($row->operationHeartTransplantationMemo!='')
       $html.="".$row->operationHeartTransplantationMemo."\n"; 
                 if($row->operationOtherCardiacSurgeryMemo!='')
       $html.="".$row->operationOtherCardiacSurgeryMemo."\n"; 
                 
      
                           $patientProcedure= $html;      
              $patientDiagnosis="";  
                  if($row->AdultDiagnosis1!='')
                $patientDiagnosis.= $row->AdultDiagnosis1."\n"; 
          if($row->AdultDiagnosis2!='')
                $patientDiagnosis.= $row->AdultDiagnosis2."\n";
          if($row->AdultDiagnosis3!='')
                $patientDiagnosis.=  $row->AdultDiagnosis3."\n";
          if($row->AdultDiagnosis4!='')
               $patientDiagnosis.=  $row->AdultDiagnosis4."\n";
          if($row->AdultDiagnosis5!='')
                $patientDiagnosis.=  $row->AdultDiagnosis5."\n";
          if($row->AdultDiagnosisOthers!='')
               $patientDiagnosis.=  $row->AdultDiagnosisOthers."\n";
          
            if($row->CongenitalDiagnosis1!='')
                $patientDiagnosis.=  $row->CongenitalDiagnosis1."\n"; 
                if($row->CongenitalDiagnosis2!='')
                $patientDiagnosis.=  $row->CongenitalDiagnosis2."\n"; 
                if($row->CongenitalDiagnosis3!='')
                $patientDiagnosis.=  $row->CongenitalDiagnosis3."\n"; 
                if($row->CongenitalDiagnosis4!='')
                $patientDiagnosis.=  $row->CongenitalDiagnosis4."\n"; 
                if($row->CongenitalDiagnosis5!='')
                $patientDiagnosis.=  $row->CongenitalDiagnosis5."\n"; 
                if($row->CongenitalProcedureOthers!='')
                $patientDiagnosis.=  $row->CongenitalProcedureOthers."\n"; 
                
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
            ->setCellValue('E'.$i, $row->euroScoreII)
            ->setCellValue('F'.$i, $patientDiagnosis)
            ->setCellValue('G'.$i, $patientProcedure)
            ->setCellValue('H'.$i, $patientSurgery);
         
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getAlignment()->setWrapText(true);
}
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('C1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('D1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('E1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('F1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('G1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('H1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('81DAF580');
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFill()->getStartColor()->setARGB('81DAF580');
$objPHPExcel->getActiveSheet()->getStyle('C1')->getFill()->getStartColor()->setARGB('81DAF580');
$objPHPExcel->getActiveSheet()->getStyle('D1')->getFill()->getStartColor()->setARGB('81DAF580');
$objPHPExcel->getActiveSheet()->getStyle('E1')->getFill()->getStartColor()->setARGB('81DAF580');
$objPHPExcel->getActiveSheet()->getStyle('F1')->getFill()->getStartColor()->setARGB('81DAF580');
$objPHPExcel->getActiveSheet()->getStyle('G1')->getFill()->getStartColor()->setARGB('81DAF580');
$objPHPExcel->getActiveSheet()->getStyle('H1')->getFill()->getStartColor()->setARGB('81DAF580');


  
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
