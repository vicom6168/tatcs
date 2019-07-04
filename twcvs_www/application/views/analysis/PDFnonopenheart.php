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
$pdf->SetTitle('台大醫院 心臟血管外科');
$pdf->SetSubject('Date From:  '.$qYear. "/".$qMonth."   To  ".$qYearEnd. "/".$qMonthEnd);
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData('', PDF_HEADER_LOGO_WIDTH, '學會報表','Date From:  '.$qYear. "/".$qMonth."   To  ".$qYearEnd. "/".$qMonthEnd);

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
$html=' Executive summary of Non Open Heart<br/>';
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
$html.='                                <td width="10%">1</td>';
$html.='                                <td width="70%">Endovascular approach great vessel surgery</td>';
$html.='                               <td width="20%">'.$a1.'</td>';
$html.='                           </tr> ';
$html.='                            <tr> ';
$html.='                                <td width="10%">2</td>';
$html.='                                <td width="70%">Central venous surgery</td>';
$html.='                               <td width="20%">'.$a2.'</td>';
$html.='                           </tr> ';
$html.='                            <tr> ';
$html.='                                <td width="10%">3</td>';
$html.='                                <td width="70%">Supra-aortic artery surgery</td>';
$html.='                               <td width="20%">'.$a3.'</td>';
$html.='                           </tr> ';
$html.='                            <tr> ';
$html.='                                <td width="10%">4</td>';
$html.='                                <td width="70%">Surgery for visceral vessel disease</td>';
$html.='                               <td width="20%">'.$a4.'</td>';
$html.='                           </tr> ';
$html.='                            <tr> ';
$html.='                                <td width="10%">5</td>';
$html.='                                <td width="70%">Surgery for peripheral artery disease</td>';
$html.='                               <td width="20%">'.$a5.'</td>';
$html.='                           </tr> ';
$html.='                            <tr> ';
$html.='                                <td width="10%">6</td>';
$html.='                                <td width="70%">Surgery for peripheral venous disease</td>';
$html.='                               <td width="20%">'.$a6.'</td>';
$html.='                           </tr> ';
$html.='                            <tr> ';
$html.='                                <td width="10%">7</td>';
$html.='                                <td width="70%">Surgery for vascular access</td>';
$html.='                               <td width="20%">'.$a7.'</td>';
$html.='                           </tr> ';
$html.='                            <tr> ';
$html.='                                <td width="10%">8</td>';
$html.='                                <td width="70%">ECMO implantation</td>';
$html.='                               <td width="20%">'.$a8.'</td>';
$html.='                           </tr> ';
$html.='                            <tr> ';
$html.='                                <td width="10%">9</td>';
$html.='                                <td width="70%">Other intrathoracic surgery</td>';
$html.='                               <td width="20%">'.$a9.'</td>';
$html.='                           </tr> ';
$html.='                       </tbody>';
$html.='                   </table>';
$html.='                   <br/>    <br/>';

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