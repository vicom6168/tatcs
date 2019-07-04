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
$pdf = new TCPDF("L", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('');
$pdf->SetTitle($this->config->item('hospitalTitle'));
$pdf->SetSubject('Date From:  '.$qYear. "/".$qMonth."   To  ".$qYearEnd. "/".$qMonthEnd);
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $this->session->userdata('hospital').'學會報表','列印時間:  '. date('Y-m-d H:i:s'));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP-10, PDF_MARGIN_RIGHT);
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
$html='';
$html.='<center><font  face="標楷體" size="16">心臟血管外科年度手術人數申報表(2006年模式) --心外資料庫 (TWCVS)登錄系統</font></center><br/>';
$html.='<font  face="標楷體" size="16">醫院名稱： '.$this->session->userdata('hospital').'</font><br/>';
$html.='<font  face="標楷體" size="16">查詢日期:  '.$qYear. "/".$qMonth."   ~  ".$qYearEnd. "/".$qMonthEnd.'</font><br/><br/>';

$html.=' <table cellspacing="0" cellpadding="0" border="1"  width="100%"> ';

$html.='<tr>';
$html.='<td rowspan="3">Year/<br/>Disease</td>';
$html.='<td colspan="4">冠狀動脈繞道手術<br/>CABG</td>';

$html.='<td colspan="2">瓣膜置換術<br/>';
$html.='Valvular Replacement<br/>';
$html.='</td>';
$html.='<td rowspan="3">';
$html.='瓣膜修補術<br/>';
$html.='Valvular Repair';
$html.='</td>';
$html.='<td colspan="3">先天性心臟病<br/>';
$html.='CHD';
$html.='</td>';
$html.='<td rowspan="3">夾層瘤<br/>';
$html.='Aortic <br/>Dissection';
$html.='</td>';
$html.='<td rowspan="3">心臟<br/>';
$html.='移植<br/>';

$html.='HTX';
$html.='</td>';
$html.='<td rowspan="3">Mechanical<br/> Support<br/>';

$html.='ECMO, LVAD';
$html.='</td>';
$html.='<td colspan="2">大動脈瘤</td>';
$html.='<td rowspan="3">PAOD</td>';
$html.='<td rowspan="3">其他<br/>';
$html.='Others';
$html.='</td>';
$html.='</tr>';


$html.='<tr>';
$html.='<td colspan="2">On Pump</td>';

$html.='<td colspan="2">Off Pump</td>';
$html.='<td rowspan="2">金屬<br/>';
$html.='Metallic';
$html.='</td>';
$html.='<td rowspan="2">組織<br/>';
$html.='Tissue';
$html.='</td>';
$html.='<td rowspan="2">No CPB</td>';
$html.='<td colspan="2">On CPB</td>';

$html.='<td rowspan="2">Thoracic</td>';
$html.='<td rowspan="2">Abdominal</td>';


$html.='</tr>';

$html.='<tr>';
$html.='<td>=1</td>';
$html.='<td>>=2</td>';
$html.='<td>=1</td>';
$html.='<td>>=2</td>';
$html.='<td>Cyanotic</td>';
$html.='<td>Non-cyanotic</td>';

$html.='</tr>';

$html.='<tr>';
$html.='<td></td>';
$html.='<td  align="center"><br/><font size="12"><br/>'.$answer[8].'<br/><br/></font></td>';
$html.='<td  align="center"><br/><font size="12"><br/>'.$answer[9].'<br/><br/></font></td>';
$html.='<td  align="center"><br/><font size="12"><br/>'.$answer[10].'<br/><br/></font></td>';
$html.='<td  align="center"><br/><font size="12"><br/>'.$answer[11].'<br/><br/></font></td>';
$html.='<td  align="center"><br/><font size="12"><br/>'.$answer[12].'<br/><br/></font></td>';
$html.='<td  align="center"><br/><font size="12"><br/>'.$answer[13].'<br/><br/></font></td>';
$html.='<td  align="center"><br/><font size="12"><br/>'.$answer[14].'<br/><br/></font></td>';
$html.='<td  align="center"><br/><font size="12"><br/>'.$answer[1].'<br/><br/></font></td>';
$html.='<td  align="center"><br/><font size="12"><br/>'.$answer[2].'<br/><br/></font></td>';
$html.='<td  align="center"><br/><font size="12"><br/>'.$answer[3].'<br/><br/></font></td>';
$html.='<td  align="center"><br/><font size="12"><br/>'.$answer[6].'<br/><br/></font></td>';
$html.='<td  align="center"><br/><font size="12"><br/>'.$answer[4].'<br/><br/></font></td>';
$html.='<td  align="center"><br/><font size="12"><br/>'.$answer[5].'<br/><br/></font></td>';
$html.='<td  align="center"><br/><font size="12"><br/>'.$answer[7].'<br/><br/></font></td>';
$html.='<td  align="center"><br/><font size="12"><br/>'.$answer[16].'<br/><br/></font></td>';
$html.='<td  align="center"><br/><font size="12"><br/>'.$answer[17].'<br/><br/></font></td>';
$html.='<td  align="center"><br/><font size="12"><br/>'.$answer[15].'<br/><br/></font></td>';
$html.='</tr>';
$html.='</table>';
        
$html.=' <br/>';
$html.=' 請心外主任確認是否以上表資料送交本會甄審委員會審核：<b>*上表資料是取自　貴單位上傳的資料，僅包含已出院資料，未包含尚在住院資料</b>';
$html.=' <br/>';
//$html.=' （&nbsp; &nbsp; &nbsp; &nbsp;）同意（本會將以此資料送交本會甄審委員會審核），';
//$html.=' <br/>';
//$html.=' （&nbsp; &nbsp; &nbsp; &nbsp;）不同意，送交本會甄審委員會審核的資料修正如下表：（請　貴單位儘快完成資料庫資料登錄並上傳以符合下表資料）';
$html.=' <br/><br/>';
$html.=' <br/>';
$html.= '<font size="14">心外主任簽名： _______________________________';    
$html.= '，日期： _______________________________</font>';    
$html.=' <br/><br/>';
/*
$html.=' <table cellspacing="0" cellpadding="0" border="1"  width="100%"> ';

$html.='<tr>';
$html.='<td rowspan="3">Year/<br/>Disease</td>';
$html.='<td colspan="4">冠狀動脈繞道手術<br/>CABG</td>';

$html.='<td colspan="2">瓣膜置換術<br/>';
$html.='Valvular Replacement<br/>';
$html.='</td>';
$html.='<td rowspan="3">';
$html.='瓣膜修補術<br/>';
$html.='Valvular Repair';
$html.='</td>';
$html.='<td colspan="3">先天性心臟病<br/>';
$html.='CHD';
$html.='</td>';
$html.='<td rowspan="3">夾層瘤<br/>';
$html.='Aortic <br/>Dissection';
$html.='</td>';
$html.='<td rowspan="3">心臟<br/>';
$html.='移植<br/>';

$html.='HTX';
$html.='</td>';
$html.='<td rowspan="3">Mechanical<br/> Support<br/>';

$html.='ECMO, LVAD';
$html.='</td>';
$html.='<td colspan="2">大動脈瘤</td>';
$html.='<td rowspan="3">PAOD</td>';
$html.='<td rowspan="3">其他<br/>';
$html.='Others';
$html.='</td>';
$html.='</tr>';


$html.='<tr>';
$html.='<td colspan="2">On Pump</td>';

$html.='<td colspan="2">Off Pump</td>';
$html.='<td rowspan="2">金屬<br/>';
$html.='Metallic';
$html.='</td>';
$html.='<td rowspan="2">組織<br/>';
$html.='Tissue';
$html.='</td>';
$html.='<td rowspan="2">No CPB</td>';
$html.='<td colspan="2">On CPB</td>';

$html.='<td rowspan="2">Thoracic</td>';
$html.='<td rowspan="2">Abdominal</td>';


$html.='</tr>';

$html.='<tr>';
$html.='<td>=1</td>';
$html.='<td>>=2</td>';
$html.='<td>=1</td>';
$html.='<td>>=2</td>';
$html.='<td>Cyanotic</td>';
$html.='<td>Non-cyanotic</td>';

$html.='</tr>';

$html.='<tr>';
$html.='<td>&nbsp;<br/></td>';
$html.='<td>&nbsp;<br/></td>';
$html.='<td>&nbsp;<br/></td>';
$html.='<td>&nbsp;<br/></td>';
$html.='<td>&nbsp;<br/></td>';
$html.='<td>&nbsp;<br/></td>';
$html.='<td>&nbsp;<br/></td>';
$html.='<td>&nbsp;<br/></td>';
$html.='<td>&nbsp;<br/></td>';
$html.='<td>&nbsp;<br/></td>';
$html.='<td>&nbsp;<br/></td>';
$html.='<td>&nbsp;<br/></td>';
$html.='<td>&nbsp;<br/></td>';
$html.='<td>&nbsp;<br/></td>';
$html.='<td>&nbsp;<br/></td>';
$html.='<td>&nbsp;<br/></td>';
$html.='<td>&nbsp;<br/></td>';
$html.='<td>&nbsp;<br/></td>';
$html.='</tr>';
$html.='</table>';   

 */    
$html.=' <br/><br/>';

$html.='<center>';
$html.=' <table cellspacing="0" cellpadding="0" border="0"  width="100%" > ';
$html.='<tr>';
$html.='<td style="width:15%;">&nbsp;</td>';
$html.='<td style="width:70%;border:0.5;height:60px;vertical-align:middle;valign: middle;"><br/><font size="12">&nbsp;是否同意將報表內容開放給本會會員查詢，下列請擇一勾選：未勾選者，將視為同意開放（經本會第十屆第三次理監事會議決議，自95年起會員將可向學會申請詳細之各醫院報表內容，唯不願對外開放之醫療院所不在此限，但報表內容僅限學術研究使用，不得移做其他用途）</font><br/><br/>';
$html.='<font size="15">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$html.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$html.='口&nbsp; 同意開放   &nbsp;&nbsp;&nbsp;&nbsp;     口&nbsp; 不同意開放</font><br/>';
$html.='</td>';
$html.='<td style="width:15%;">&nbsp;</td>';
$html.='</tr>';


$html.='</table>';       
$html.='</center>'; 
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