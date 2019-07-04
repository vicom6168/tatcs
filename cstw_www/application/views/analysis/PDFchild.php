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
$html=' Executive summary of Congenital surgery<br/>';
$html.=' <table cellspacing="0" cellpadding="0" border="1"  width="90%"> ';
$html.='                         <thead> ';
$html.='                             <tr> ';
$html.='                                <th nowrap width="10%">No.</th>';
$html.='                                <th nowrap width="70%">Item</th>';
$html.='                              <th nowrap width="20%">Total</th>';
                            
$html.='                           </tr> ';
$html.='                      </thead> ';
$html.='                        <tbody> ';
$html.='                            <tr> ';
$html.='                                <td width="10%">0</td>';
$html.='                                <td width="70%">Congenital cardiac surgery count</td>';
$html.='                               <td width="20%">'.$adult.'</td>';
$html.='                           </tr> ';
$html.='                       </tbody>';
$html.='                   </table>';
$html.='                   <br/>    <br/>';

$html.='Major Procedures1-2<br/>';

$html.='                 <table cellspacing="0" cellpadding="0" border="1"  width=90%> ';
$html.='                       <thead> ';
$html.='                           <tr> ';
$html.='                              <th nowrap width="10%">No.</th>';
$html.='                             <th nowrap width="70%">Item</th>';
$html.='                            <th nowrap width="20%">Total</th>';
                            
$html.='                        </tr> ';
$html.='                     </thead> ';
$html.='                    <tbody> ';
                             
$html.='                      <tr> ';
$html.='                             <td width="10%">1</td>';
$html.='                            <td width="70%"> Adult Congenital Cardiac Procedure</td>';
$html.='                          <td width="20%">'.$a1.'</td>';
$html.='                       </tr> ';
$html.='                   <tr> ';
$html.='                          <td>2</td>';
$html.='                           <td>Procedure with CPB</td>';
$html.='                         <td>'.$a2.'</td>';
$html.='                     </tr> ';
$html.='                   <tr> ';
$html.='                          <td>3</td>';
$html.='                         <td>Procedure without CPB</td>';
$html.='                         <td>'.$a3.'</td>';
$html.='                      </tr>      ';
$html.='                      </tbody> ';
$html.='                  </table>';
                    
$html.='                   <br/>    <br/>';

$html.='Index procedure<br/> ';

$html.='                   <table cellspacing="0" cellpadding="0" border="1" width=90%> ';
$html.='                      <thead> ';
$html.='                          <tr> ';
$html.='                            <th nowrap width="10%">No.</th>';
$html.='                            <th nowrap  width="60%">Item</th>';
$html.='                            <th nowrap width="15%">Total</th>';
$html.='                            <th nowrap width="15%">Sole</th>';                            
$html.='                         </tr> ';
$html.='                     </thead> ';
$html.='                     <tbody> ';
$html.='                     <tr> ';
$html.='                             <td  width="10%">1</td>';
$html.='                              <td  width="60%">Ventricular Septal Defect</td>';
$html.='                             <td  width="15%">'.$a4.'</td>';
$html.='                             <td  width="15%">'.$b4.'</td>';
$html.='                          </tr> ';
$html.='                        <tr> ';
$html.='                               <td>2</td>';
$html.='                               <td>Tetralogy of Fallot</td>';
$html.='                             <td>'.$a5.'</td>';
$html.='                             <td>'.$b5.'</td>';
$html.='                          </tr> ';
$html.='                     <tr> ';
$html.='                             <td>3</td>';
$html.='                           <td>Transposition of the Great Arteries with intact Ventricular Septum</td>';
$html.='                           <td>'.$a6.'</td>';
$html.='                           <td>'.$b6.'</td>';
$html.='                         </tr>      ';
$html.='                            <tr> ';
$html.='                             <td>4</td>';
$html.='                             <td>Transposition of the Great Arteries with Ventricular Septum Defect</td>';
$html.='                             <td>'.$a7.'</td>';
$html.='                           <td>'.$b7.'</td>';
$html.='                          </tr> ';
$html.='                             <tr> ';
$html.='                            <td>5</td>';
$html.='                            <td>Coarctation of the Aorta</td>';
$html.='                            <td>'.$a8.'</td>';
$html.='                           <td>'.$b8.'</td>';
$html.='                         </tr> ';
$html.='                           <tr> ';
$html.='                              <td>6</td>';
$html.='                             <td>Superior Caval to Pulmonary Artery Anastomosis</td>';
$html.='                             <td>'.$a9.'</td>';
$html.='                           <td>'.$b9.'</td>';
$html.='                           </tr> ';
$html.='                             <tr> ';
$html.='                               <td>7</td>';
$html.='                              <td>Compete Caval to Pulmonary Artery Anastomosis </td>';
$html.='                               <td>'.$a10.'</td>';
$html.='                           <td>'.$b10.'</td>';
$html.='                            </tr> ';
$html.='                               <tr> ';
$html.='                                <td>8</td>';
$html.='                               <td>Truncus Arteriosus</td>';
$html.='                               <td>'.$a11.'</td>';
$html.='                           <td>'.$b11.'</td>';
$html.='                           </tr> ';
$html.='                              <tr> ';
$html.='                               <td>9</td>';
$html.='                                <td>Hypoplastic Left Heart Syndrome</td>';
$html.='                               <td>'.$a12.'</td>';
$html.='                               <td>'.$b12.'</td>';
$html.='                                 </tr> ';
$html.='                            <tr> ';
$html.='                               <td>10</td>';
$html.='                               <td>Total Anomalous Pulmonary Venous Connection</td>';
$html.='                             <td>'.$a13.'</td>';
$html.='                               <td>'.$b13.'</td>';
$html.='                           </tr> ';
$html.='                         <tr> ';
$html.='                               <td>11</td>';
$html.='                              <td>Partial Anomalous Pulmonary Venous Connection</td>';
$html.='                             <td>'.$a14.'</td>';
$html.='                               <td>'.$b14.'</td>';
$html.='                          </tr> ';
$html.='                       <tr> ';
$html.='                                 <td>12</td>';
$html.='                                 <td>Atrioventricular Septal Defect</td>';
$html.='                               <td>'.$a15.'</td>';
$html.='                               <td>'.$b15.'</td>';
$html.='                          </tr> ';
$html.='                     <tr> ';
$html.='                              <td>13</td>';
$html.='                              <td>Interrupted Aortic Arch</td>';
$html.='                             <td>'.$a16.'</td>';
$html.='                               <td>'.$b16.'</td>';
$html.='                           </tr>    ';  
$html.='                              <tr> ';
$html.='                               <td>14</td>';
$html.='                               <td>Ebstein Malformation</td>';
$html.='                              <td>'.$a17.'</td>';
$html.='                              <td>'.$b17.'</td>';
$html.='                            </tr> ';

$html.='                        </tbody> ';
$html.='                     </table>';
                    
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