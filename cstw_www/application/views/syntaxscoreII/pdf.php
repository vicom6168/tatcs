<?php
//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('./application/libraries/TCPDF/examples/tcpdf_include.php');


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('');
$pdf->SetTitle($this->config->item('hospitalTitle'));
$pdf->SetSubject('Syntax Score  ');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Patient Profile','Syntax Score ');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
$c=$myContent->row();
foreach($segment->result() as $row){
    if($c->SyntaxScoreDominance=="R")
   $Real_array[$row->syntaxScoreSegment]=$row->syntaxScoreFactorRight;
  else
   $Real_array[$row->syntaxScoreSegment]=$row->syntaxScoreFactorLeft;
}
// set font
//$pdf->addTTFfont('fonts/DroidSansFallback.ttf');
 $fontname = TCPDF_FONTS::addTTFfont('./application/libraries/TCPDF/fonts/DroidSansFallback.ttf', 'TrueTypeUnicode', '', 32);
$pdf->SetFont('DroidSansFallback', '', 10);

// add a page
$pdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// create some HTML content

$html='    <table cellspacing="0" cellpadding="0" border="1" class="" width="100%"> ';
$html.='                       <thead> ';
 $html.='                            <tr> ';
 $html.='                                <th height="30" nowrap bgcolor="#CEECF5">Patient Information</th>';
                               
                                
$html.='                           </tr> ';
$html.='                       </thead> ';
$html.='                       </table> ';
                       

$html.='    <table cellspacing="0" cellpadding="0" border="1" class="" width="100%"> ';
$html.='                                    <tr>';
$html.='                                       <td>Chart number</td>';
$html.='                                       <td>'.$c->patientChartNumber.'</td>';
$html.='                                       <td>Name</td>';
$html.='                                      <td>'.$c->patientName.'</td>';
$html.='                                       <td>Gender</td>';
$html.='                                      <td>'.$c->patientGender.'</td>';

$html.='                                   </tr>';
 $html.='    <tr>';

$html.='                                        <td>Operation Date:</td>';
$html.='    <td>'.str_replace('0000-00-00', '', $c->patientOpDate).'</td>';
$html.='                                        <td>Surgeon</td>';
$html.='                                      <td>'.$c->patientSurgeon.'</td>';
$html.='   <td></td>';
$html.='                                      <td></td>';
$html.='                                   </tr>';

  $html.='                   </table><br/><br/>';
   $html.='  ';                   

 $html.=' <table cellspacing="0" cellpadding="0" border="1" class=""  width="100%"> ';
$html.=' <thead> ';
 $html.='                           <tr> ';
 $html.='                               <th width="10%" nowrap></th>';
 $html.='                               <th width="35%"  nowrap>Segments</th>';
 $html.='                              <th width="10%"  nowrap>Lesion</th>';
                                foreach($myScore->result() as $row){ 
 $html.='                               <th nowrap bgcolor="#CEECF5">'.$row->LesionsID.'</th>';
                              } 
 $html.='                           </tr> ';
$html.='                        </thead> ';
$html.='                    <tbody> ';
                 
                            $i=0;
                            $j=0;
                            foreach($segment->result() as $row){
                                $j++;
                           
$html.='                                <tr> ';
                             
 $html.='                                   <td width="10%"  ><font color="#C50000"><b>';
  $html.= $row->syntaxScoreSegmentCategoryLabel;
   $html.='   </b></font></td>';
  $html.='                                  <td width="35%">'.$row->syntaxScoreLabel.'</td>';
                            
  $html.='                                 <td width="10%">'.$row->syntaxScoreSegment.'</td>';
                               foreach($myScore->result() as $scorerow){ 
  $html.='                                  <td   bgcolor="#CEECF5">';
                                       
                                 if($scorerow->{'q'.$row->syntaxScoreSegment}=="1")    $html.= "Y"; else    $html.= ""; 
                                  
 $html.='                                       </td>';
                                       } 
 $html.='                               </tr>';
                          } 
                               
$html.='                            </tbody> ';
$html.='                        </table><br/><br/>   ';    

 $html.=' <table cellspacing="0" cellpadding="0" border="1"  class=""   width="100%"> ';

$html.='                        <tbody> ';
                     
                            $i=0;
                            $j=0;
                            $subscore=0;
                            foreach($myScore->result() as $row){
                                $j++;
                                $subscore+= floatval($row->step1_Score)+floatval($row->step2_Score);
                         
$html.='                         <tr> ';
$html.='                            <td width="90%" bgcolor="#A9E2F3"><b>Lesion  ';
$html.=$row->LesionsID;
$html.='</b></td>';
$html.='                            <td  width="10%"  bgcolor="#A9E2F3"></td>';
$html.='                          </tr>';
 $html.='                            <tr> ';
 $html.='                              <td  bgcolor="#CEECF5">segment number(s)</td>';
 $html.='                              <td  bgcolor="#CEECF5">Score</td>';
 $html.='                            </tr>';
                            foreach ($Real_array as $key => $value) {
                          if($row->{'q'.$key}=='1'){ 
  $html.='                            <tr> ';
  $html.='                             <td>(segment  ';
$html.= $key;
$html.='):';
$html.=  $value;
$html.= 'X';
$html.=  ($row->u4i==$key?'5':'2');
$html.=' = </td>';
$html.='                              <td > ';
$html.=($row->u4i==$key? (floatval($value)*5): (floatval($value)*2));
$html.='</td>';
$html.='                            </tr>';
                             }
                           } 
                             if($row->u4ii=='2' || $row->u4ii=='3'){ 
$html.='                          <tr> ';
$html.='                           <td>is Age of T.O. > 3 months is  ';
$html.= ($row->u4ii=="1"?'No':($row->u4ii=="2"?'Yes':'Unknown'));
$html.=' </td>';
$html.='                           <td> 1</td>';
$html.='                          </tr>';
                             } 
if($row->u4iii=='Y'){ 
$html.='                         <tr> ';
$html.='                            <td>+ Blunt stump  ';
$html.= ($row->u4iii=="Y"?'Yes':'No');
$html.='</td>';
$html.='                            <td> 1</td>';
$html.='                         </tr>';
} 
if($row->u4iv=='Y'){ 
$html.='                           <tr> ';
$html.='                            <td>+ Bridging  ';
$html.= ($row->u4iv=="Y"?'Yes':'No');
$html.='</td>';
$html.='                           <td> 1</td>';
$html.='                          </tr>';
}    
if($row->u4v!=''){ 
 $html.='                            <tr> ';
 $html.='                             <td>the first segment beyond the T.O. visualized by contrast:  ';
$html.= $row->u4v;
$html.='</td>';
$html.='                            <td> ';
$html.=$row->Q4Score;
$html.='</td>';
$html.='                           </tr>';
                            }   
if($row->u4vi=='2' || $row->u4vi=='3' || $row->u4vi=='4'){ 
$html.='                             <tr> ';
$html.='                            <td>is Age of T.O. > 3 months is  ';
$html.= ($row->u4vi=="1"?'No':($row->u4vi=="2"?'Yes, all sidebranches <1.5mm':($row->u4vi=="3"?'Yes, all sidebranches >=1.5mm':'Yes, both sidebranches <1.5mm and >=1.5mm are involved')));
$html.='</td>';
$html.='                             <td> 1</td>';
$html.='                           </tr>';
} 
if($row->u5=='Y'){ 
 $html.='                            <tr> ';
 $html.='                             <td>Trifurcation  ';
$html.=  ($row->u5i=="1"?'1 diseased segment involved':($row->u5i=="2"?'2 diseased segments involved':($row->u5i=="3"?'3 diseased segments involved':'4 diseased segments involved')));
$html.='</td>';
$html.='                              <td> 1</td>';
$html.='                           </tr>';
} 
if($row->u5i=='1' || $row->u5i=='2' || $row->u5i=='3' || $row->u5i=='4'){
$html.='                             <tr> ';
$html.='                              <td>';
$html.= ($row->u5i=="1"?'1 diseased segment involved':($row->u5i=="2"?'2 diseased segments involved':($row->u5i=="3"?'3 diseased segments involved':'4 diseased segments involved')));
$html.= '</td>';
$html.='                               <td> 1</td>';
$html.='                             </tr>';
                             } 
                            
if($row->u6=='Y'){
 $html.='                            <tr> ';
$html.='                               <td>Bifurcation  ';
$html.=  ($row->u6=="Y"?'Yes':'No');
$html.='</td>';
$html.='                               <td> 1</td>';
 $html.='                                </tr>';
 if($row->u6i=='1' || $row->u6i=='2' || $row->u6i=='3' || $row->u6i=='4'  || $row->u6i=='5'  || $row->u6i=='6'  || $row->u6i=='7'){ 
$html.='                              <tr> ';
$html.='                               <td>';
                               if($row->u6i=='1')
                                  $html.= "Medina 1,0,0";
                              else if ($row->u6i=='2')
                                 $html.= "Medina 0,1,0";
                               else if ($row->u6i=='3')
                                 $html.= "Medina 1,1,0";
                                else if ($row->u6i=='4')
                                 $html.= "Medina 1,1,1";
                                 else if ($row->u6i=='5')
                                 $html.= "Medina 0,0,1";
                                  else if ($row->u6i=='6')
                                 $html.= "Medina 1,0,1";
                               else if ($row->u6i=='7')
                                 $html.= "Medina 0,1,1";
                               else 
                                 $html.= "";
                               
$html.='                                </td>';
$html.='                               <td>';
    if($row->u6i=='1' || $row->u6i=='2' || $row->u6i=='3')    $html.=  "1"; else    $html.= "2";
$html.='     </td>';
$html.='                             </tr>';
                     } 
                         } 
                       if($row->u6ii=='Y'){ 
 $html.='                             <tr> ';
$html.='                               <td>Bifurcation angulation (between distal main vessel and side branch) < 70º  ';
    $html.=   ($row->u6ii=="Y"?'Yes':'No');
$html.='          </td>';
$html.='                               <td> 1</td>';
$html.='                             </tr>';
                             } 
                               if($row->u7=='Y'){ 
 $html.='                             <tr> ';
$html.='                               <td>Aorto Ostial lesion';
   $html.=       ($row->u7=="Y"?'Yes':'No');
$html.='      </td>';
 $html.='                              <td> 1</td>';
   $html.='                          </tr>';
 } 
                            if($row->u8=='Y'){ 
   $html.='                           <tr> ';
  $html.='                             <td>Severe Tortuosity  ';
     $html.=    ($row->u8=="Y"?'Yes':'No');
  $html.='      </td>';
  $html.='                             <td> 2</td>';
  $html.='                           </tr>';
           } 
                             if($row->u10=='Y'){
  $html.='                            <tr> ';
  $html.='                             <td>Heavy calcification  ';
       $html.=   ($row->u10=="Y"?'Yes':'No');
  $html.='      </td>';
  $html.='                             <td> 2</td>';
 $html.='                            </tr>';
                              } 
                               if($row->u11=='Y'){ 
    $html.='                          <tr> ';
   $html.='                            <td>Thrombus  ';
       $html.=   ($row->u11=="Y"?'Yes':'No');
$html.='      </td>';
  $html.='                             <td> 1</td>';
    $html.='                         </tr>';
                               } 
   $html.='                                <tr> ';
   $html.='                            <td><i><b>Sub total lesion  ';
       $html.=     $row->LesionsID;
   $html.='      </b></i></td>';
   $html.='                            <td><i><b>';
    $html.= floatval($row->step1_Score)+floatval($row->step2_Score);
    $html.='   </b></i></td>';
   $html.='                          </tr>';
                           if($j==$myScore->num_rows() && $row->u12=="Y") { 
    $html.='                             <tr> ';
    $html.='                           <td>&nbsp;</td>';
   $html.='                            <td>&nbsp; </td>';
  $html.='                           </tr>';
  $html.='                                 <tr> ';
 $html.='                              <td   bgcolor="#A9E2F3"><b>Diffuse disease/Small vessels</b></td>';
  $html.='                             <td  bgcolor="#A9E2F3"></td>';
  $html.='                           </tr>';
                           
                           foreach ($Real_array as $key => $value) {
                           if($row->{'s'.$key}=='1'){ 
 $html.='                             <tr> ';
 $html.='                              <td>segment  '.$key.'</td>';
$html.='                               <td> 1</td>';
 $html.='                            </tr>';
                            
                            }
                           }
$html.='                              <tr> ';
$html.='                               <td><i><b>Sub total diffuse disease/small vessels</b></i></td>';
$html.='                               <td><i><b>'.floatval($row->step3_Score).'</b></i></td>';
 $html.='                            </tr>';
                             } 
                            }
                           
  $html.='                                   <tr> ';
  $html.='                             <td>&nbsp;</td>';
  $html.='                             <td>&nbsp; </td>';
 $html.='                            </tr>';
 $html.='                                  <tr> ';
 $html.='                              <td   bgcolor="#A9E2F3"><i><b>TOTAL:</b></i></td>';
 $html.='                              <td  bgcolor="#A9E2F3"><i><b>';
 $html.=floatval($row->step3_Score)+floatval($subscore);
 $html.='</b></i></td>';
$html.='                             </tr>';
$html.='                         </tbody> ';
$html.=' </table>';
 
                    
// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');



// reset pointer to the last page
$pdf->lastPage();

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table


// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('sytaxScore.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+