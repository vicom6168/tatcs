<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ------------------------------------------------------------------------

/**
 * CSV Helpers
 * Inspiration from PHP Cookbook by David Sklar and Adam Trachtenberg
 * 
 * @author        Jérôme Jaglale
 * @link        http://maestric.com/en/doc/php/codeigniter_csv
 */

// ------------------------------------------------------------------------

/**
 * Array to CSV
 *
 * download == "" -> return CSV string
 * download == "toto.csv" -> download file toto.csv
 */
if ( ! function_exists('accessLog'))
{
    function accessLog($accesstype,$accesstable,$accesskey,$accessstr,$accessresult)
    {
        $CI = get_instance();

    // You may need to load the model if it hasn't been pre-loaded
    
        $CI->load->model('Access_Model');
      $CI->load->library('accesslogClass');
        
             
      $accesslogClass= new accesslogClass;  
      $accesslogClass->uid=$CI->session->userdata('userID');
      $accesslogClass->uname=$CI->session->userdata('userRealname');
      $accesslogClass->uempno=$CI->session->userdata('userName');
      $accesslogClass->accessip=$_SERVER['REMOTE_ADDR'];
      $accesslogClass->accesstime = date('Y-m-d H:i:s');
      
      $accesslogClass->accesstype=$accesstype;
      $accesslogClass->accesstable=$accesstable;
      $accesslogClass->accessstr=$accessstr;
      $accesslogClass->accesskey=$accesskey;
      $accesslogClass->accessresult=$accessresult;
      return $CI->Access_Model->save_access($accesslogClass);
        
    }
}
if ( ! function_exists('comparePatient'))
{
    function comparePatient($oldP,$newP)
    {
        $CI = get_instance();
$beforeModifyarray =  (array) $oldP;
$afterModifyarray =  (array) $newP;
$standardModifyarray=array(
"patientHospital"=>"Hospital",
"patientSSN"=>"Patient ID",
"patientChartNumber"=>"Chart number",
"patientName"=>"Name",
"patientBirthday"=>"Birthday",
"patientAge"=>"Age",
"patientAgeUnit"=>"Age Unit",
"patientGender"=>"Gender",
"patientSurgeon"=>"Surgeon 1",
"patientSurgeon2"=>"Surgeon 2",
"patientSurgeon3"=>"Surgeon 3",
"patientSurgeon4"=>"Surgeon 4",
"patientReoperation"=>"Re-operation",
"patientOpDate"=>"Operation date",
"patientDischargeDate"=>"Discharge date",
"patientCongenitalSurgery"=>"Congenital surgery (Any congenital cardiac diagnosis)",
"patientSyntaxScore"=>"SYNTAX Score",
"patientAssociatedDisease"=>"Other associated disease",
"patientBodyWeight"=>"Body Weight",
"patientSerumCreatinine"=>"Serum Creatinine",
"pastHistoryRenalImpairment"=>"Renal impairment",
"CcrberforOperation"=>"Ccr before operation",
"pastHistoryExtracardiacArteriopathy"=>"Extracardiac arteriopathy",
"pastHistoryPoorMobility"=>"Poor mobility",
"pastHistoryPreviousCardiacSurgery"=>"Previous cardiac surgery",
"pastHistoryChronicLungDisease"=>"Chronic lung disease",
"pastHistoryActiveEndocarditis"=>"Active endocarditis ",
"pastHistoryCriticalPreoperativeState"=>"Critical preoperative state ",
"pastHistoryDiabetesOnInsulin"=>"Diabetes on insulin",
"pastHistoryNYHA"=>"NYHA",
"pastHistoryCCSClass4Angina"=>"CCS class 4 angina",
"pastHistoryLVFunction"=>"LV function",
"pastHistoryRecentMI"=>"Recent MI",
"pastHistoryPulmonaryHypertension"=>"Pulmonary hypertension",
"pastHistoryUrgency"=>"Urgency",
"pastHistoryWeightOfTheIntervention"=>"Weight of the intervention ",
"pastHistorySurgeryThoracicAorta"=>"Surgery on thoracic aorta",
"euroScoreII"=>"EUROSCORE II",
"AdultDiagnosis1"=>"Adult Diagnosis 1",
"AdultDiagnosis2"=>"Adult Diagnosis 2",
"AdultDiagnosis3"=>"Adult Diagnosis 3",
"AdultDiagnosis4"=>"Adult Diagnosis 4",
"AdultDiagnosis5"=>"Adult Diagnosis 5",
"AdultDiagnosisOthers"=>"Adult Diagnosis Others",
"operationCABG"=>"CABG",
"operationLIMA"=>"LIMA",
"operationRIMA"=>"RIMA",
"operationRIMA_RadialA"=>"Radial artery",
"operationRIMA_GEA"=>"Gastroepiploic artery",
"operationVeinGraft"=>"Vein graft",
"operationCardiopulmonaryBypass"=>"Cardiopulmonary bypass",
"operationCardiacArrest"=>"Cardiac arrest",
"operationCABGMemo"=>"CABG 備註",
"operationAorticValve"=>"Aortic valve surgery",
"operationAVP"=>"Aortic valve plasty (AVP)",
"operationAorticValve_AVP"=>"Aortic Valve AVP Value",
"operationAorticValve_AVR"=>"Aortic valve replacement (AVR)",
"operationAVRSelect"=>"Aortic Valve AVR Value",
"operationAorticMemo"=>"Aortic valve surgery 備註",
"operationMitralValve"=>"Mitral valve surgery",
"Operation_MitralValve_MVP"=>"MVP",
"Operation_MitralValve_MVR"=>"MVR",
"operationMitralValveBentall"=>"Bentall’s Op",
"operationMVPRing"=>"Ring",
"operationMVPArtificialChord"=>"Artificial chordae",
"operationMVPAnnularPlication"=>";Annular plication",
"operationMVPLeafletResection"=>"Leaflet resection",
"operationMVPOthers"=>"Mitral valve surgery Others",
"operationMVR"=>"MVR",
"operationMVRMemo"=>"MVR 備註",
"operationTricuspidValve"=>"",
"Operation_TricuspidValve_TVP"=>"",
"Operation_TricuspidValve_TVR"=>"",
"operationTVPRing"=>"",
"operationTVPArtificialChord"=>"",
"operationTVPAnnularPlication"=>"",
"operationTVPLeafletResection"=>"",
"operationTVPOthers"=>"",
"operationTVR"=>"",
"operationTricuspidValveMemo"=>"",
"operationPulmonaryValve"=>"",
"Operation_PulmonaryValve_PVP"=>"",
"Operation_PulmonaryValve_PVR"=>"",
"operationPulmonaryValvePVP"=>"",
"operationPulmonaryValvePVR"=>"",
"operationPulmonaryValveMemo"=>"",
"operationArrythmiaSurgery"=>"Arrhythmia surgery:",
"operationMazebiatrialLesion"=>"Maze (biatrial lesion + PVI)",
"operationMazeLA"=>"LA Maze (no RA lesion)",
"operationMazePVIwithLAA"=>"PVI with LAA closure",
"operationMazePVIwithoutLAA"=>"PVI without LAA closure",
"operationMazeRA"=>"",
"operationMazeOthers"=>"Others",
"operationMazeEnergySource"=>"Energy source",
"operationMazeMemo"=>"Energy source 備註",
"operationAorticSurgery"=>"Aortic surgery",
"operationDissection"=>"Etiology:Dissection",
"operationAneurysm"=>"Etiology:Aneurysm",
"operationEtiologyOthers"=>"Etiology:Others",

"operationEtiologyCardiopulmonarBypass"=>"Cardiopulmonary bypass",
"operationAorticSurgeryCerebralProtection"=>"Cerebral protection",
"operationAorticSurgeryLocation"=>"Location",
"operationAorticSurgeryMethod"=>"Method",
"operationAorticSurgeryMemo"=>"Aortic surgery 備註",
"operationHeartTransplantation"=>"Heart transplant & Mechanical support",
"operationHeartTransplantationOP"=>"Operation_HeartTransplantation",
"operationHeartTransplantationLVAD"=>"Operation Hear:LVAD",
"operationHeartTransplantationRVAD"=>"Operation Hear:RVAD",
"operationHeartTransplantationMemo"=>"Heart transplant & Mechanical support 備註",
"operationOtherCardiacSurgery"=>"Other cardiac surgery",
"operationOtherCardiacSurgery1"=>"Repair of Post-MI free wall rupture",
"operationOtherCardiacSurgery2"=>"Repair of Post-MI ventricular septal defect (VSR)",
"operationOtherCardiacSurgery3"=>"Repair of traumatic cardiac rupture",
"operationOtherCardiacSurgery4"=>"Intracardiac tumor excision",
"operationOtherCardiacSurgery5"=>"Septal myectomy",
"operationOtherCardiacSurgery6"=>"Pericardiectomy",
"operationOtherCardiacSurgery7"=>"LV aneurysm surgery",
"operationOtherCardiacSurgery8"=>"Pulmonary embolectomy",
"operationOtherCardiacSurgery9"=>"Pulmonary endarterectomy",
"operationOtherCardiacSurgery10"=>"Cardiac Implantable Electronic Device lead insertion, replacement, or extraction",
"operationOtherCardiacSurgery11"=>"Others",
"operationOtherCardiacSurgeryMemo"=>"Other cardiac surgery 備註",
"CongenitalDiagnosis1"=>"Congenita lDiagnosis 1",
"CongenitalDiagnosis2"=>"Congenita lDiagnosis 2",
"CongenitalDiagnosis3"=>"Congenita lDiagnosis 3",
"CongenitalDiagnosis4"=>"Congenita lDiagnosis 4",
"CongenitalDiagnosis5"=>"Congenita lDiagnosis 5",
"CongenitalDiagnosisOthers"=>"Congenita lDiagnosis Others",
"CongenitalProcedure1"=>"Congenital Primary Procedure",
"CongenitalProcedure2"=>"Congenital Secondary Procedure 1",
"CongenitalProcedure3"=>"Congenital Secondary Procedure 2",
"CongenitalProcedure4"=>"Congenital Secondary Procedure 3",
"CongenitalProcedure5"=>"Congenital Secondary Procedure 4",
"CongenitalProcedureOthers"=>"Congenital Secondary Procedure Others",
"operationCongenitalBypass"=>"Bypass",
"operationCongenitalBypassCPBTime"=>"Total CPB time",
"operationCongenitalBypassAorticTime"=>"Aortic cross clump time",
"operationCongenitalBypassCirculatoryTime"=>"Circulatory arrest time",
"operationCongenitalBypassCardioplegia"=>"Cardioplegia",
"operationCongenitalBypassRACHS"=>"RACHS Class",
"operationCongenitalBypassSTS"=>"STS Mortality Category",
"operationCongenitalBypassMemo"=>"Bypass 備註",
"outcomeCheck1"=>"Operative Mortality",
"outcomeData1"=>"Operative Mortality Memo",
"outcomeCheck2"=>"Permanent Stroke",
"outcomeData2"=>"Permanent Stroke Memo",
"outcomeCheck3"=>"Renal Failure",
"outcomeData3"=>"Renal Failure Memo",
"outcomeCheck4"=>"Prolonged Ventilation > 24 hours",
"outcomeData4"=>"Prolonged Ventilation > 24 hours Memo",
"outcomeCheck5"=>"Deep Sternal Wound Infection",
"outcomeData5"=>"Deep Sternal Wound Infection Memo",
"outcomeCheck6"=>"Reoperation For any reason ",
"outcomeData6"=>"Reoperation For any reason  Memo",
"outcomeCheck7"=>"Major Morbidity or Operative Mortality",
"outcomeData7"=>"Major Morbidity or Operative Mortality Memo",
"outcomeCheck8"=>"LOS  from operation to hospital discharge",
"outcomeData8"=>"LOS  from operation to hospital discharge Memo",
"outcomeCheck9"=>"Short Stay: PLOS < 6 days",
"outcomeData9"=>"Short Stay: PLOS < 6 days Memo",
"outcomeCheck10"=>"Long Stay: PLOS >14 days",
"outcomeData10"=>"Long Stay: PLOS >14 days Memo",
"outcomeChildComplication1"=>"Arrhythmia requiring drug therapy",
"outcomeChildComplication2"=>"Arrhythmia requiring electrical cardioversion or defibrillation",
"outcomeChildComplication3"=>"Arrhythmia requiring Temporary pacemaker",
"outcomeChildComplication4"=>"Bleeding, requiring reoperation",
"outcomeChildComplication5"=>"Cardiac dysfunction resulting in low cardiac output",
"outcomeChildComplication6"=>"Cardiac failure (severe cardiac dysfunction)",
"outcomeChildComplication7"=>"Chylothorax",
"outcomeChildComplication8"=>"Endocarditis­postprocedural infective endocarditis",
"outcomeChildComplication9"=>"Intraventricular hemorrhage (IVH) > grade 2",
"outcomeChildComplication10"=>"Mechanical circulatory support (IABP, VAD, ECMO, or CPS)",
"outcomeChildComplication11"=>"Multi­System Organ Failure (MSOF) = Multi­Organ Dysfunction Syndrome (MODS",
"outcomeChildComplication12"=>"Neurological deficit diagnosed in the operating room, persisting at discharge or 91 days if patient is still in hospital.",
"outcomeChildComplication13"=>"Neurological deficit diagnosed in the operating room, not present at discharge",
"outcomeChildComplication14"=>"Neurological deficit that occurred after the operating room visit, persisting at discharge",
"outcomeChildComplication15"=>"Neurological deficit that occurred after the operating room visit, not present at discharge",
"outcomeChildComplication16"=>"Paralyzed diaphragm (possible phrenic nerve injury)",
"outcomeChildComplication17"=>"Pericardial Effusion, requiring drainage",
"outcomeChildComplication18"=>"Peripheral nerve injury persisting at discharge or 91 days if patient is still in hospital",
"outcomeChildComplication19"=>"Peripheral nerve injury not present at discharge or 91 days if patient is still in hospital",
"outcomeChildComplication20"=>"Postoperative/Postprocedural respiratory insufficiency requiring mechanical ventilatory support > 7 days",
"outcomeChildComplication21"=>"Postoperative/Postprocedural respiratory insufficiency requiring reintubation",
"outcomeChildComplication22"=>"Pulmonary vein obstruction",
"outcomeChildComplication23"=>"Renal failure ­ acute renal failure, Acute renal failure requiring dialysis at the time of hospital discharge or 91 days if patient is still in hospital",
"outcomeChildComplication24"=>"Renal failure ­ acute renal failure, Acute renal failure requiring temporary dialysis with the need for dialysis not present at hospital discharge or 91 days if patient is still in hospital",
"outcomeChildComplication25"=>"Renal failure ­ acute renal failure, Acute renal failure requiring temporary hemofiltration with the need for dialysis not present at hospital discharge or 91 days if patient is still in hospital",
"outcomeChildComplication26"=>"Respiratory failure, requiring tracheostomy",
"outcomeChildComplication27"=>"Seizure",
"outcomeChildComplication28"=>"Sepsis",
"outcomeChildComplication29"=>"Sternum left open, unplanned ",
"outcomeChildComplication30"=>"Stroke: Ischemic",
"outcomeChildComplication31"=>"Subdural Bleed",
"outcomeChildComplication32"=>"Systemic vein obstruction",
"outcomeChildComplication33"=>"Unplanned cardiac reoperation during the postoperative or postprocedural time period, exclusive of reoperation for bleeding",
"outcomeChildComplication34"=>"Vocal cord dysfunction (possible recurrent laryngeal nerve injury)",
"outcomeChildComplication35"=>"Wound infection­Mediastinitis",
"outcomeChildComplication36"=>"Wound infection­Superficial wound infection",
"outcomeChildCauseofDeath"=>"Primary Cause of Death",
"outcomeExtubationDate"=>"Extubation Date",
"outcomeStatus"=>" outcome Status(出院狀況)",
"LVADmachineLVAD"=>"Machine LVAD",
"LVADmachineRVAD"=>"Machine  RVAD",
"LVADIntermacsLevel"=>"NTERMACS level",
"LVADPeakVO2"=>"Peak VO2 ",
"LVADIVinotropicLarge14days"=>"IV inotropic medication ≥ 14 days",
"LVADIIABPSupportLarge7days"=>"IABP support ≥ 7 days",
"LVADPreOperativeVentlator"=>"Pre-operative ventilator support",
"LVADDialysis"=>"Dialysis ",
"LVADBUN"=>"BUN ",
"LVADAlbumin"=>"Albumin ",
"LVADINR"=>"INR ",
"LVADBilirubin"=>"Bilirubin ",
"LVADHeartRate"=>"Heart Rate",
"LVADCVPLevel"=>"CVP level ",
"LVADPulmonary"=>"Pulmonary capillary wedge pressure ",
"LVADLVEF"=>"LVEF ",
"LVADSevereRV"=>"Severe RV dysfunction",
"LVADSevereTR"=>"Severe TR"
);

$ret="N";
foreach($standardModifyarray  as $key => $value){
    if($beforeModifyarray[$key]!=$afterModifyarray[$key])
    $ret="Y";
}

        return $ret;
    }
}





/* End of file csv_helper.php */
/* Location: ./system/helpers/csv_helper.php */  