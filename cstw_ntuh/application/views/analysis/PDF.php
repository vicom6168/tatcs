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
$pdf->SetSubject('Date From:  '.$qYear. "/".$qMonth."   To  ".$qYearEnd. "/".$qMonthEnd);
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '學會報表','Date From:  '.$qYear. "/".$qMonth."   To  ".$qYearEnd. "/".$qMonthEnd);

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

// set font
//$pdf->addTTFfont('fonts/DroidSansFallback.ttf');
 $fontname = TCPDF_FONTS::addTTFfont('./application/libraries/TCPDF/fonts/DroidSansFallback.ttf', 'TrueTypeUnicode', '', 32);
$pdf->SetFont('DroidSansFallback', '', 10);

// add a page
$pdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// create some HTML content

$html=' <table cellspacing="0" cellpadding="0" border="1"  width="90%"> ';

$html.=' <tr> ';
$html.=' <td  width="10%">No.</td>';
$html.=' <td  width="25%">Item</td>';
$html.=' <td  width="45%">Description</td>';
$html.=' <td  width="20%">Total</td>';                  
$html.=' </tr> ';

$html.=' <tr> ';
$html.=' <td  width="10%">1</td>';
$html.=' <td  width="25%">CABG =1</td>';
$html.=' <td  width="45%">分類1.CABG:true<br/>LIMA+RIMA+GEA+Radial A.+Vein graft =1<br/>Cardiopulmonary bypass : null</td>';
$html.=' <td  width="20%">'.$answer[1].'</td>';
$html.=' </tr> ';

$html.='  <tr> ';
$html.=' <td>2</td>';
$html.=' <td>CBAG &gt;=2</td>';
$html.=' <td>分類1.CABG:true<br/>LIMA+RIMA+GEA+Radial A.+Vein graft>1<br/>Cardiopulmonary bypass : null</td>';
$html.=' <td>'.$answer[2].'</td>';
$html.=' </tr> ';

$html.=' <tr> ';
$html.=' <td>3</td>';
$html.=' <td>OPCAB =1</td>';
$html.=' <td>分類1.CABG:true<br/>LIMA+RIMA+GEA+Radial A.+Vein graft=1<br/>Cardiopulmonary bypass : true</td>';
$html.=' <td>'.$answer[3].'</td>';
$html.=' </tr>';

$html.=' <tr> ';
$html.=' <td>4</td>';
$html.=' <td>OPCAB &gt;=2</td>';
$html.=' <td>分類1.CABG:true<br/>LIMA+RIMA+GEA+Radial A.+Vein graft>1<br/>Cardiopulmonary bypass : true</td>';
$html.=' <td>'.$answer[4].'</td>';
$html.=' </tr>   ';
$html.=' <tr> ';
$html.=' <td>5</td>';
$html.=' <td>Valvular Replacement <br/>金屬</td>';
$html.='  <td>分類2.Valvular Replacement<br/>(AVR,MVR,TVR,PVR選1.Mechanical)</td>';
$html.=' <td>'.$answer[5].'</td>';
$html.=' </tr>     ';
 $html.=' <tr> ';
$html.=' <td>6</td>';
$html.=' <td>Valvular Replacement <br/>組織</td>';
$html.=' <td>分類2.Valvular Replacement<br/>(AVR,MVR,TVR,PVR選2.Bioprosthesis)</td>';
$html.=' <td>'.$answer[6].'</td>';
$html.=' </tr>   ';
$html.=' <tr> ';
$html.=' <td>7</td>';
$html.=' <td>Valvular Repair</td>';
$html.=' <td>分類3.Vavlvular Repair</td>';
$html.=' <td>'.$answer[7].'</td>';
$html.=' </tr>   ';    
 $html.=' <tr> ';
$html.=' <td>8</td>';
$html.=' <td>CHD-No CPB</td>';
$html.=' <td>分類4.CHD<br/>Cardiopulmonary bypass:null</td>';
$html.=' <td>'.$answer[8].'</td>';
$html.='  </tr>    ';
$html.=' <tr> ';
$html.=' <td>9</td>';
$html.=' <td>CHD-Cyanotic</td>';
$html.=' <td>分類4.CHD<br/>Cardiopulmonary bypass:true<br/>CHD(open heart surgery): <br/>1.cyanotic</td>';
$html.=' <td>'.$answer[9].'</td>';
$html.=' </tr>    ';
$html.=' <tr> ';
$html.=' <td>10</td>';
$html.=' <td>CHD-Non cyanotic</td>';
$html.=' <td>分類4.CHD<br/>Cardiopulmonary bypass:true<br/>CHD(open heart surgery): <br/>2.non-cyanotic</td>';
$html.=' <td>'.$answer[10].'</td>';
$html.=' </tr>  ';
$html.=' <tr> ';
$html.=' <td>11</td>';
$html.=' <td>DAA</td>';
$html.=' <td>分類5.Aortic Dissection</td>';
$html.=' <td>'.$answer[11].'</td>';
$html.=' </tr>   ';     
$html.=' <tr> ';
$html.=' <td>12</td>';
$html.=' <td>HTX </td>';
$html.=' <td>分類6.HTX</td>';
$html.=' <td>'.$answer[12].'</td>';
$html.=' </tr>   ';
$html.=' <tr> ';
$html.=' <td>13</td>';
$html.='  <td>ECMO/VAD </td>';
$html.=' <td>分類7.Mechanical Support</td>';
$html.=' <td>'.$answer[13].'</td>';
$html.=' </tr>     ';
$html.=' <tr> ';
 if($this->session->userdata('SP1')=="1"){
$html.=' <td>14</td>';
$html.=' <td>TAA </td>';
$html.=' <td>vascular special sheet 1-02 <br/>Thoracic endovascular aortic aneurysm <br/>repair (TEVAR) 的數字</td>';
$html.=' <td>'.$answer[14].'</td>';
$html.=' </tr>     ';
$html.='  <tr> ';
$html.=' <td>15</td>';
$html.=' <td>AAA </td>';
$html.='  <td>vascular special sheet 1-01 <br/>Endovascular aortic aneurysm <br/>repair (EVAR) 的數字</td>';
$html.=' <td>'.$answer[15].'</td>';
$html.='  </tr>       ';
 } else {
   $html.=' <td>14</td>';
$html.=' <td>TAA </td>';
$html.=' <td>分類8.Aortic Aneurysm<br/>thoracic aorta:true</td>';
$html.=' <td>'.$answer[14].'</td>';
$html.=' </tr>     ';
$html.='  <tr> ';
$html.=' <td>15</td>';
$html.=' <td>AAA </td>';
$html.='  <td>分類8.Aortic Aneurysm<br/>abdominal aorta :true</td>';
$html.=' <td>'.$answer[15].'</td>';
$html.='  </tr>       ';  
 }
$html.=' <tr> ';
$html.=' <td>16</td>';
$html.=' <td>Others </td>';
$html.=' <td>分類9.PAOD<br/>+分類10. Others</td>';
$html.=' <td>'.$answer[16].'</td>';
$html.=' </tr>    ';     
$html.=' <tr> ';
$html.=' <td>17</td>';
$html.=' <td>Total </td>';
$html.=' <td></td>';
$html.=' <td>'.$answer[17].'</td>';
$html.=' </tr>    ';
$html.=' </table>';
                    
// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');



// reset pointer to the last page
$pdf->lastPage();

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table


// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('associateReport.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+