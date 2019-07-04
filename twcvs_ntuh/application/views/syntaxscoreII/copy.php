 <link rel="stylesheet" type="text/css"    href="<?php echo base_url(); ?>css/form-buttons.css" media="screen" />
 <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.mobile-1.4.5.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.7.1.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>js/notify.min.js"></script>
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


// ---------------------------------------------------------
$c=$myContent->row();
foreach($segment->result() as $row){
    if($c->SyntaxScoreDominance=="R")
   $Real_array[$row->syntaxScoreSegment]=$row->syntaxScoreFactorRight;
  else
   $Real_array[$row->syntaxScoreSegment]=$row->syntaxScoreFactorLeft;
}


// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// create some HTML content

$html='';
$html.='Patient Information &#13;&#10;';
                               

                       

$html.='Chart number:';
$html.=$c->patientChartNumber.'&#11;';
$html.='Name:';
$html.=$c->patientName.'&#11;';
$html.='Gender:';
$html.=$c->patientGender.'&#13;&#10;';

$html.='Operation Date:';
$html.=str_replace('0000-00-00', '', $c->patientOpDate).'&#11;';
$html.='Surgeon:';
$html.=$c->patientSurgeon.'&#11;&#13;&#10;&#13;&#10;';
// $html.='';
 //$html.='Segments &#11;';
 $html.='Lesion &#11;';
                                foreach($myScore->result() as $row){ 
 $html.='      &#11;'.$row->LesionsID.'';
                              } 

                            $i=0;
                            $j=0;
                            foreach($segment->result() as $row){
                                $j++;
                           
$html.='                                &#13;&#10; ';
                             

 // $html.= $row->syntaxScoreSegmentCategoryLabel;
 //  $html.=' &#11;';
  $html.=''.$row->syntaxScoreLabel.'     &#11;';
                            
  $html.=''.$row->syntaxScoreSegment.'     &#11;';
                               foreach($myScore->result() as $scorerow){ 

                                       
                                 if($scorerow->{'q'.$row->syntaxScoreSegment}=="1")    $html.= "&#11;&#11;     Y"; else    $html.= "&#11;"; 
                                  
 $html.='      &#11;';
                                       } 

                          } 
                               

$html.='&#13;&#10;';
                     
                            $i=0;
                            $j=0;
                            $subscore=0;
                            foreach($myScore->result() as $row){
                                $j++;
                                $subscore+= floatval($row->step1_Score)+floatval($row->step2_Score);
                         
$html.='&#13;&#10;';
$html.='Lesion  ';
$html.=$row->LesionsID;
$html.='&#11;';
$html.='&#13;&#10;';
 $html.='segment number(s)&#11;';
 $html.='Score&#11;';
 $html.='&#13;&#10;';
                            foreach ($Real_array as $key => $value) {
                          if($row->{'q'.$key}=='1'){ 
  $html.='&#13;&#10;';
  $html.='(segment  ';
$html.= $key;
$html.='):';
$html.=  $value;
$html.= 'X';
$html.=  ($row->u4i==$key?'5':'2');
$html.=' =      &#11;';
$html.=($row->u4i==$key? (floatval($value)*5): (floatval($value)*2));
$html.='&#11;';
                             }
                           } 
                             if($row->u4ii=='2' || $row->u4ii=='3'){ 
$html.='&#13;&#10; ';
$html.='is Age of T.O. > 3 months is  ';
$html.= ($row->u4ii=="1"?'No':($row->u4ii=="2"?'Yes':'Unknown'));
$html.='     &#11;';
$html.='1&#11;';
                             } 
if($row->u4iii=='Y'){ 
$html.='&#13;&#10; ';
$html.='+ Blunt stump  ';
$html.= ($row->u4iii=="Y"?'Yes':'No');
$html.='     &#11;';
$html.='1&#11;';
} 
if($row->u4iv=='Y'){ 
$html.='&#13;&#10; ';
$html.='+ Bridging  ';
$html.= ($row->u4iv=="Y"?'Yes':'No');
$html.='     &#11;';
$html.='1&#11;';
}    
if($row->u4v!=''){ 
$html.='&#13;&#10; ';
 $html.='the first segment beyond the T.O. visualized by contrast:  ';
$html.= $row->u4v;
$html.='     &#11;';
$html.=$row->Q4Score;
$html.='&#11;';
                            }   
if($row->u4vi=='2' || $row->u4vi=='3' || $row->u4vi=='4'){ 
$html.='&#13;&#10;';
$html.='is Age of T.O. > 3 months is  ';
$html.= ($row->u4vi=="1"?'No':($row->u4vi=="2"?'Yes, all sidebranches <1.5mm':($row->u4vi=="3"?'Yes, all sidebranches >=1.5mm':'Yes, both sidebranches <1.5mm and >=1.5mm are involved')));
$html.='      &#11;';
$html.='1&#11;';
} 
if($row->u5=='Y'){ 
 $html.='&#13;&#10;';
 $html.='Trifurcation  ';
$html.=  ($row->u5i=="1"?'1 diseased segment involved':($row->u5i=="2"?'2 diseased segments involved':($row->u5i=="3"?'3 diseased segments involved':'4 diseased segments involved')));
$html.='     &#11;';
$html.='1&#11;';
} 
if($row->u5i=='1' || $row->u5i=='2' || $row->u5i=='3' || $row->u5i=='4'){
$html.='&#13;&#10;';
$html.='';
$html.= ($row->u5i=="1"?'1 diseased segment involved':($row->u5i=="2"?'2 diseased segments involved':($row->u5i=="3"?'3 diseased segments involved':'4 diseased segments involved')));
$html.= '     &#11;';
$html.='1&#11;';
                             } 
                            
if($row->u6=='Y'){
 $html.='&#13;&#10;';
$html.='Bifurcation  ';
$html.=  ($row->u6=="Y"?'Yes':'No');
$html.='&#11;';
$html.='1&#11;';
 if($row->u6i=='1' || $row->u6i=='2' || $row->u6i=='3' || $row->u6i=='4'  || $row->u6i=='5'  || $row->u6i=='6'  || $row->u6i=='7'){ 
$html.='&#13;&#10;';
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
                               
$html.='     &#11;';
    if($row->u6i=='1' || $row->u6i=='2' || $row->u6i=='3')    $html.=  "1"; else    $html.= "2";
$html.='&#11;';
                     } 
                         } 
                       if($row->u6ii=='Y'){ 
 $html.='&#13;&#10;';
$html.='Bifurcation angulation (between distal main vessel and side branch) < 70º  ';
    $html.=   ($row->u6ii=="Y"?'Yes':'No');
$html.='     &#11;';
$html.='1&#11;';
                             } 
                               if($row->u7=='Y'){ 
 $html.='&#13;&#10;';
$html.='Aorto Ostial lesion';
   $html.=       ($row->u7=="Y"?'Yes':'No');
$html.='     &#11;';
 $html.='1&#11;';
 } 
                            if($row->u8=='Y'){ 
 $html.='&#13;&#10;';
  $html.='Severe Tortuosity  ';
     $html.=    ($row->u8=="Y"?'Yes':'No');
  $html.='     &#11;';
  $html.='2&#11;';
           } 
                             if($row->u10=='Y'){
  $html.='&#13;&#10;';
  $html.='Heavy calcification  ';
       $html.=   ($row->u10=="Y"?'Yes':'No');
  $html.='     &#11;';
  $html.='2&#11;';
                              } 
                               if($row->u11=='Y'){ 
    $html.='&#13;&#10;';
   $html.='Thrombus  ';
       $html.=   ($row->u11=="Y"?'Yes':'No');
$html.='     &#11;';
  $html.='1&#11;';
                               } 
   $html.='&#13;&#10;';
   $html.='Sub total lesion  ';
       $html.=     $row->LesionsID;
   $html.='     &#11;';
    $html.= floatval($row->step1_Score)+floatval($row->step2_Score);
    $html.='&#11;';
                           if($j==$myScore->num_rows() && $row->u12=="Y") { 
    $html.='&#13;&#10;';
    $html.='&#11;';
 $html.='&#11;';
  $html.='&#11;';
  $html.='&#13;&#10;';
 $html.='Diffuse disease/Small vessels';
  $html.='&#11;&#11;';
                           
                           foreach ($Real_array as $key => $value) {
                           if($row->{'s'.$key}=='1'){ 
 $html.='&#13;&#10;';
 $html.='segment : '.$key.'&#11;';
$html.='      1&#11;';
                            
                            }
                           }
$html.='&#13;&#10;';
$html.='total diffuse disease/small vessels';
$html.='      &#11;'.floatval($row->step3_Score).'      &#11;';

                             } 
                            }
                           
  $html.='&#13;&#10;';
  $html.='&#11;';
  $html.='&#11;';
  $html.='&#11;';
 $html.='&#13;&#10;';
 $html.='TOTAL:';
 $html.='&#11;';
 $html.=floatval($row->step3_Score)+floatval($subscore);

?>
  <button type="button" id="EuroCopyButton" class="blue medium" onclick="javascript:copyToClipboard();"><span>Copy to Clipboard</span></button><br/><br/>
 <textarea id="EuroScoreCopyArea" class="textarea" cols="85" rows="30"><?php echo $html;?></textarea>
  
    
<script>
    function copyToClipboard() {
  var copyTextarea = document.querySelector('#EuroScoreCopyArea');
  copyTextarea.select();

  try {
    var successful = document.execCommand('copy');
    var msg = successful ? 'Successful' : 'Unsuccessful';
    console.log('Copying text command was ' + msg);
        $("#EuroCopyButton").notify("Copy to Clipboard "+msg, "info");
  } catch (err) {
    console.log('Oops, unable to copy');
  }
}
</script>