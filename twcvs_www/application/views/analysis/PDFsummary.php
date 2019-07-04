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
$html=' Executive summary<br/>';
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
$html.='                                <td width="70%"> Overall Cardiac Surgery</td>';
$html.='                               <td width="20%">'.$total.'</td>';
$html.='                           </tr> ';
$html.='                            <tr> ';
$html.='                                <td width="10%">2</td>';
$html.='                                <td width="70%">Adult cardiac surgery</td>';
$html.='                               <td width="20%">'.$adult.'</td>';
$html.='                           </tr> ';
$html.='                            <tr> ';
$html.='                                <td width="10%">3</td>';
$html.='                                <td width="70%">Congenital cardiac surgery</td>';
$html.='                               <td width="20%">'.$child.'</td>';
$html.='                           </tr> ';
$html.='                            <tr> ';
$html.='                                <td width="10%">4</td>';
$html.='                                <td width="70%">Non-cardiac surgery</td>';
$html.='                               <td width="20%">'.$Noncardiac.'</td>';
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