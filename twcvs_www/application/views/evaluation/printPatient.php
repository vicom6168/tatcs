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

//define
$c=$myContent->row();
$Renalimpairment[0]='';
$Renalimpairment[1]='normal (CC &gt;85ml/min) ';
$Renalimpairment[2]='moderate (CC &gt;50 &amp; &lt;85)';
$Renalimpairment[3]='severe (CC &lt;50)';
$Renalimpairment[4]='dialysis (regardless of CC)';
$NYHA[0]='';
$NYHA[1]='I';
$NYHA[2]='II';
$NYHA[3]='III';
$NYHA[4]='IV';
$LV[0]='';
$LV[1]='good (LVEF &gt; 50%)';
$LV[2]='moderate (LVEF 31%-50%)';
$LV[3]='poor (LVEF 21%-30%) ';
$LV[4]='very poor (LVEF 20% or less)';
$Hypertension[0]='';
$Hypertension[1]='no';
$Hypertension[2]='moderate (PA systolic 31-55 mmHg) ';
$Hypertension[3]='severe (PA systolic &gt;55 mmHg) ';
$Urgency[0]='';
$Urgency[1]='elective';
$Urgency[2]='urgent';
$Urgency[3]='emergency';
$Urgency[4]='salvage';
$intervention[0]='';
$intervention[1]='isolated CABG';
$intervention[2]='single non CABG';
$intervention[3]='2 procedures';
$intervention[4]='3 procedures';

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('');
$pdf->SetTitle('台大醫院 心臟血管外科');
$pdf->SetSubject('Chart Number:'.$c->patientChartNumber);
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE. $c->patientChartNumber, 'Name:'.$c->patientName);

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

$html = '<h2>Patient Profiles</h2>';
$html .= 'Hospital: '.$c->patientHospital.'<br/>';
$html .= 'Patient ID: '.$c->patientSSN.'<br/>';
$html .= 'Chart number: '.$c->patientChartNumber.'<br/>';
$html .= 'Name: '.$c->patientName.'<br/>';
$html .= 'Birthday: '.$c->patientBirthday.'<br/>';
$html .= 'Age: '.$c->patientAge.'<br/>';
$html .= 'Gender: '.($c->patientGender=='M'?'Male':'Female').'<br/>';
$html .= 'OP date: '.$c->patientOpDate.'<br/>';
$html .= 'Other associated disease:<br/> '.nl2br($c->patientAssociatedDisease).'<br/>';
$html .= 'Euro Score II: '.$c->euroScoreII.'%<br/>';
$html .= 'Syntax Score: '.$c->patientSyntaxScore.'<br/>';
// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');



// reset pointer to the last page
$pdf->lastPage();

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table

// add a page
$pdf->AddPage();

// create some HTML content
$html = '<h2>Euro Score II</h2>';
$html .= '<h3>Patient Related Factors</h3>';
$html .= 'Renal impairment:  '.empty($c->pastHistoryRenalImpairment)?"":$Renalimpairment[$c->pastHistoryRenalImpairment].'<br/>';
$html .= 'Extracardiac arteriopathy:  '.$c->pastHistoryExtracardiacArteriopathy.'<br/>';
$html .= 'Poor mobility:  '.$c->pastHistoryExtracardiacArteriopathy.'<br/>';
$html .= 'Previous cardiac surgery:  '.$c->pastHistoryPreviousCardiacSurgery.'<br/>';
$html .= 'ExtracardiacChronic lung diseasearteriopathy:  '.$c->pastHistoryChronicLungDisease.'<br/>';
$html .= 'Active endocarditis :  '.$c->pastHistoryActiveEndocarditis.'<br/>';
$html .= 'Critical preoperative state :  '.$c->pastHistoryCriticalPreoperativeState.'<br/>';
$html .= 'Diabetes on insulin:  '.$c->pastHistoryDiabetesOnInsulin.'<br/>';

$html .= '<h3>Cardiac Related Factors</h3>';
$html .= 'NYHA:  '.empty($c->pastHistoryNYHA)?"":$NYHA[$c->pastHistoryNYHA].'<br/>';
$html .= 'CCS class 4 angina:  '.$c->pastHistoryCCSClass4Angina.'<br/>';
$html .= 'LV function:  '.empty($c->pastHistoryLVFunction)?"":$LV[$c->pastHistoryLVFunction].'<br/>';
$html .= 'Recent MI:  '.$c->pastHistoryRecentMI.'<br/>';
$html .= 'Pulmonary hypertension:  '.empty($c->pastHistoryPulmonaryHypertension)?"":$Hypertension[$c->pastHistoryPulmonaryHypertension].'<br/>';

$html .= '<h3>Operation Related Factors </h3>';
$html .= 'Urgency:  '.empty($c->pastHistoryUrgency)?"":$Urgency[$c->pastHistoryUrgency].'<br/>';
$html .= 'Weight of the intervention:  '.empty($c->pastHistoryWeightOfTheIntervention)?"":$intervention[$c->pastHistoryWeightOfTheIntervention].'<br/>';
$html .= 'Surgery on thoracic aorta:  '.$c->pastHistorySurgeryThoracicAorta.'<br/>';

$html .= '<h3>Euro Score II : '.$c->euroScoreII.'%</h3>';
// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


// reset pointer to the last page
$pdf->lastPage();
// add a page
$pdf->AddPage();

// create some HTML content
// create some HTML content
$html = '<h2>SYNTAX Score</h2>';
if(intval($c->patientSyntaxScore)>=0 && intval($c->patientSyntaxScore)<=22){
    $html .= '<img src="'.base_url().'images/KM1.png"  width="380" height="200" border="0" />';
    $html .= "<b><I>MACCE by SYNTAX Score 0-22</I></b><br/>";
    
}
elseif (intval($c->patientSyntaxScore)>=23 && intval($c->patientSyntaxScore)<=32){
     $html .= '<img src="'.base_url().'images/KM2.png"  width="380" height="200" border="0" />';
    $html .= "<b><I>MACCE by SYNTAX Score 23-32</I></b><br/>";
}

else{
    $html .= '<img src="'.base_url().'images/KM3.png"  width="380" height="200" border="0" />';
    $html .= '<b><I>MACCE by SYNTAX Score 33+</I></b><br/>';

}
//  $html .=intval($c->patientSyntaxScore);
$html .= str_replace('^','&nbsp;&nbsp;&nbsp;&nbsp;    ',$c->patientSyntaxScoreContent).'<br/>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table
if($c->patientOpenHeartSurgery=="Y"){
$pdf->AddPage();
$html = '<h2>Operation Procedures</h2>';
$html .= '<h3>Open heart Surgery</h3>';
$html .= 'CABG:  '.$c->operationCABG.'<br/>';
$html .= 'LIMA:  '.$c->operationLIMA.'<br/>';
$html .= 'RIMA:  '.$c->operationRIMA.'<br/>';
$html .= 'Vein graft:  '.$c->operationVeinGraft.'<br/>';
$html .= '&nbsp;&nbsp;&nbsp;Cardiopulmonary bypass:  '.$c->operationCardiopulmonaryBypass.'<br/>';
$html .= '&nbsp;&nbsp;&nbsp;Cardiac arrest:  '.$c->operationCardiacArrest.'<br/>';
$html .= '備註:  '.$c->operationCABGMemo.'<br/><br/>';

$html .= 'Aortic valve:  '.$c->operationAorticValve.'<br/>';
$html .= 'AVP:  '.$c->operationAVP.'<br/>';
$html .= 'AVR Select:  '.$c->operationAVRSelect.'<br/>';
$html .= '備註:  '.$c->operationAorticMemo.'<br/><br/>';

$html .= 'Mitral valve:  '.$c->operationMitralValve.'<br/>';
$html .= 'MVP,ring:  '.$c->operationMVPRing.'<br/>';
$html .= 'MVP,artificial chord:  '.$c->operationMVPArtificialChord.'<br/>';
$html .= 'MVP,annular plication:  '.$c->operationMVPAnnularPlication.'<br/>';
$html .= 'MVP,leaflet resection:  '.$c->operationMVPLeafletResection.'<br/>';
$html .= 'MVR:  '.$c->operationMVR.'<br/>';
$html .= '備註:  '.$c->operationMVRMemo.'<br/><br/>';

$html .= 'Tricuspid valve:  '.$c->operationTricuspidValve.'<br/>';
$html .= 'TVP,ring:  '.$c->operationTVPRing.'<br/>';
$html .= 'TVP,artificial chord:  '.$c->operationTVPArtificialChord.'<br/>';
$html .= 'TVP,annular plication:  '.$c->operationTVPAnnularPlication.'<br/>';
$html .= 'TVP,leaflet resection:  '.$c->operationTVPLeafletResection.'<br/>';
$html .= 'TVR:  '.$c->operationTVR.'<br/>';
$html .= '備註:  '.$c->operationTricuspidValveMemo.'<br/><br/>';

$html .= 'Pulmonary valve:  '.$c->operationPulmonaryValve.'<br/>';
$html .= 'PVP:  '.$c->operationPulmonaryValvePVP.'<br/>';
$html .= 'PVR:  '.$c->operationPulmonaryValvePVR.'<br/>';
$html .= '備註:  '.$c->operationPulmonaryValveMemo.'<br/><br/>';

$html .= 'Arrythmia surgery:  '.$c->operationArrythmiaSurgery.'<br/>';
$html .= 'Maze,LA:  '.$c->operationMazeLA.'<br/>';
$html .= 'Maze,RA:  '.$c->operationMazeRA.'<br/>';
$html .= 'Maze,Others:  '.$c->operationMazeOthers.'<br/>';
$html .= 'Energy source:  '.$c->operationMazeEnergySource.'<br/>';
$html .= '備註:  '.$c->operationMazeMemo.'<br/><br/>';

$html .= 'Aortic surgery:  '.$c->operationAorticSurgery.'<br/>';
$html .= 'dissection:  '.$c->operationDissection.'<br/>';
$html .= 'aneurysm:  '.$c->operationAneurysm.'<br/>';
$html .= 'Location,※ascending:  '.$c->operationAneurysmAscending.'<br/>';
$html .= 'Location.※arch:  '.$c->operationAneurysmArch.'<br/>';
$html .= 'Location,※thoracic:  '.$c->operationAneurysmThoracicAorta.'<br/>';
$html .= 'Location,※abdominal:  '.$c->operationAneurysmAbdominalAorta.'<br/>';
$html .= 'Method:  '.$c->operationAorticSurgeryMethod.'<br/>';
$html .= '備註:  '.$c->operationAorticSurgeryMemo.'<br/><br/>';

$html .= 'Heart Transplantation:  '.$c->operationHeartTransplantation.'<br/>';
$html .= '備註:  '.$c->operationHeartTransplantationMemo.'<br/><br/>';


$pdf->writeHTML($html, true, false, true, false, '');
$pdf->lastPage();
}
// Print a table
if($c->patientCongenitalSurgery=="Y"){
$pdf->AddPage();
$html = '<h2>Operation Procedures</h2>';
$html .= '<h3>Congenital Surgery</h3>';
$html .= 'open heart-pediatric:  '.$c->CongenitalOpenHeartPediatric.'<br/>';
$html .= 'CHD(open heart surgery:  '.$c->CongenitalCHD.'<br/>';
$html .= 'Cardiopulmonary bypass:  '.$c->CongenitalCardiopulmonaryBypass.'<br/>';
$html .= '備註:  '.$c->CongenitalOpenHeartPediatricMemo.'<br/><br/>';

$html .= 'closed heart:  '.$c->CongenitalClosedHeart.'<br/>';
$html .= 'PDA:  '.$c->CongenitalClosedHeartPDA.'<br/>';
$html .= 'CoA:  '.$c->CongenitalClosedHeartCoA.'<br/>';
$html .= 'Systemic to pulmonary Shunt:  '.$c->CongenitalClosedHeartPulmonaryShunt.'<br/>';
$html .= 'PA banding:  '.$c->CongenitalClosedHeartPABanding.'<br/>';
$html .= '備註:  '.$c->CongenitalClosedHeartMemo.'<br/><br/>';

$html .= 'open heart-Adult CHD :  '.$c->CongenitalOpenHeartAdultCHD.'<br/>';
$html .= '備註:  '.$c->CongenitalOpenHeartAdultCHDMemo.'<br/><br/>';

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->lastPage();
}
// Print a table
if($c->patientNonOpenHeart=="Y"){
$pdf->AddPage();
$html = '<h2>Operation Procedures</h2>';
$html .= '<h3>Non-open heart</h3>';
$html .= 'Peripheral artery:  '.$c->NonOpenHeartPeripheralArtery.'<br/>';
$html .= 'PAOD:  '.$c->NonOpenHeartPeripheralArteryPAOD.'<br/>';
$html .= 'AV access:  '.$c->NonOpenHeartPeripheralArteryAVAccess.'<br/>';
$html .= '備註:  '.$c->NonOpenHeartPeripheralArteryMemo.'<br/><br/>';

$html .= 'varicose vein surgery:  '.$c->NonOpenHeartVaricoseVeinSurgery.'<br/>';
$html .= '備註:  '.$c->NonOpenHeartVaricoseVeinSurgeryMemo.'<br/><br/>';

$html .= 'Central Vein access:  '.$c->NonOpenHeartCentralVeinAccess.'<br/>';
$html .= 'access type:  '.$c->NonOpenHeartCentralVeinAccessType.'<br/>';
$html .= '備註:  '.$c->NonOpenHeartCentralVeinAccessMemo.'<br/><br/>';

$html .= 'Mechanical Supportt:  '.$c->NonOpenHeartMechanicalSupport.'<br/>';
$html .= 'ECMO:  '.$c->NonOpenHeartMechanicalSupportECMO.'<br/>';
$html .= '備註:  '.$c->NonOpenHeartMechanicalSupportMemo.'<br/><br/>';


$pdf->writeHTML($html, true, false, true, false, '');
$pdf->lastPage();
}


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print all HTML colors

// add a page
$pdf->AddPage();

$html = '<h2>Outcome Results </h2>';
$html .= 'Death:  '.$c->outcomeDeath.'<br/>';
$html .= 'Death Date:  '.$c->outcomeDeathDate.'<br/>';
$html .= '備註:  '.$c->outcomeDeathMemo.'<br/><br/>';
$html .= 'Wound infection:  '.$c->outcomeWoundInfection.'<br/>';
$html .= 'infection:  '.$c->outcomeWoundInfectionData.'<br/>';
$html .= '備註:  '.$c->outcomeWoundInfectionMemo.'<br/><br/>';
$html .= 'Bacteremia/Sepsis:  '.$c->outcomeBacteremia.'<br/>';
$html .= 'Bacteremia :  '.$c->outcomeBacteremiaData.'<br/>';
$html .= '備註:  '.$c->outcomeBacteremiaMemo.'<br/><br/>';
$html .= 'Re-entry :  '.$c->outcomeReentry.'<br/>';
$html .= '備註:  '.$c->outcomeReentryMemo.'<br/><br/>';
$html .= 'Renal failure needing dialysis :  '.$c->outcomeDialysis.'<br/>';
$html .= 'H/D Date:  '.$c->outcomeDialysisDate.'<br/>';
$html .= '備註:  '.$c->outcomeDialysisMemo.'<br/><br/>';
$html .= 'ECMO:  '.$c->outcomeECMO.'<br/>';
$html .= 'ECMO Type :  '.$c->outcomeECMOData.'<br/>';
$html .= '備註:  '.$c->outcomeECMOMemo.'<br/><br/>';
$html .= 'IABP:  '.$c->outcomeIABP.'<br/>';
$html .= '備註:  '.$c->outcomeIABPMemo.'<br/><br/>';
$html .= 'Stroke:  '.$c->outcomeStroke.'<br/>';
$html .= '備註:  '.$c->outcomeStrokeMemo.'<br/><br/>';
$html .= 'Arrthymia:  '.$c->outcomeArrthymia.'<br/>';
$html .= 'Arrthymia Type:  '.$c->outcomeArrthymiaData.'<br/>';
$html .= '備註:  '.$c->outcomeArrthymiaMemo.'<br/><br/>';
// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');



// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// test pre tag

// add a page

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_006.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+