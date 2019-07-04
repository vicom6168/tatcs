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
"AdmissionDate"=>"Discharge date",
"DischargeDate"=>"Congenital surgery (Any congenital cardiac diagnosis)",
"LOS"=>"SYNTAX Score",
"ICUAdmissionDate"=>"Other associated disease",
"ICUDischargeDate"=>"Body Weight",
"ICU_LOS"=>"Serum Creatinine",
"ExtubationDate"=>"Renal impairment",
"patientDiagnosis"=>"Ccr before operation",
"patientAssociatedDisease"=>"Extracardiac arteriopathy",
"diseaseType"=>"Poor mobility",
"Procedure1"=>"Previous cardiac surgery",
"Procedure2"=>"Chronic lung disease",
"Procedure3"=>"Active endocarditis ",
"Procedure4"=>"Critical preoperative state ",
"Procedure5"=>"Diabetes on insulin",
"ProcedureOthers"=>"NYHA",
"Diagnosis1"=>"CCS class 4 angina",
"Diagnosis2"=>"LV function",
"Diagnosis3"=>"Recent MI",
"Diagnosis4"=>"Pulmonary hypertension",
"Diagnosis5"=>"Urgency",
"DiagnosisOthers"=>"Weight of the intervention ",
"ProcedureTypeName1"=>"Surgery on thoracic aorta",
"ProcedureTypeName2"=>"EUROSCORE II",
"ProcedureTypeName3"=>"Adult Diagnosis 1",
"ProcedureTypeName4"=>"Adult Diagnosis 2",
"ProcedureTypeName5"=>"Adult Diagnosis 3",
"CancerLSHeight"=>"Adult Diagnosis 4",
"CancerLSWeight"=>"Adult Diagnosis 5",
"CancerLSSmokingAmount"=>"Adult Diagnosis Others",
"CancerLSSmokingYear"=>"CABG",
"CancerLSSmokingQuitYear"=>"LIMA",
"CancerLSBetelNutsAmount"=>"RIMA",
"CancerLSBetelNutsYear"=>"Radial artery",
"CancerLSBetelNutsQuitYear"=>"Gastroepiploic artery",
"CancerLSDrinking"=>"Vein graft",
"CancerLSKPS_ECOG"=>"Cardiopulmonary bypass",
"CancerClinical_T"=>"Cardiac arrest",
"CancerClinical_N"=>"CABG 備註",
"CancerClinical_M"=>"Aortic valve surgery",
"CancerClinical_StageGroup"=>"Aortic valve plasty (AVP)",
"CancerPathological_T"=>"Aortic Valve AVP Value",
"CancerPathological_N"=>"Aortic valve replacement (AVR)",
"CancerPathological_M"=>"Aortic Valve AVR Value",
"CancerPathological_Stage"=>"Aortic valve surgery 備註",
"CancerStage_memo"=>"CancerStage_memo",
"CancerSysDxDate"=>"CancerSysDxDate",
"CancerRadiotherapy_initialDate"=>"CancerRadiotherapy_initialDate",
"CancerRadiotherapy_endDate"=>"CancerRadiotherapy_endDate",
"CancerChemotherapy_PreCT"=>"CancerChemotherapy_PreCT",
"CancerChemotherapy_CT"=>"CancerChemotherapy_CT",
"CancerChemotherapy_initialDate"=>"CancerChemotherapy_initialDate",
"CancerTargetTherapy_PreTx"=>"CancerTargetTherapy_PreTx",
"CancerTargetTherapy_Tx"=>"CancerTargetTherapy_Tx",
"CancerTargetTherapy_initialDate"=>"CancerTargetTherapy_initialDate",
"CancerHormoneTherapy_PreTx"=>"MVP",
"CancerHormoneTherapy_Tx"=>"MVP",
"CancerHormoneTherapy_initialDate"=>"MVP",
"CancerImmunotherapy_PreImm"=>"MVP",
"CancerImmunotherapy_Imm"=>"MVP",
"CancerImmunotherapy_initialDate"=>"MVP",
"outcomeDeath"=>"Mitral valve surgery",
"outcomeDeathDate"=>"MVP",
"outcomeDeathMemo"=>"MVR",
"outcomeMortalityCheck"=>"Bentall’s Op",
"outcomeMortalityNote"=>"Ring",
"outcomeInfectionCheck"=>"Artificial chordae",
"outcomeInfectionNote"=>";Annular plication",
"outcomeReoperationCheck"=>"Leaflet resection",
"outcomeReoperationNote"=>"Mitral valve surgery Others",
"outcomePneumoniaCheck"=>"MVR",
"outcomePneumoniaNote"=>"MVR 備註",
"outcomeIntubationCheck"=>"",
"outcomeIntubationNote"=>"",
"outcomeHemothoraxCheck"=>"",
"outcomeHemothoraxNote"=>"",
"outcomePneumothoraxCheck"=>"",
"outcomePneumothoraxNote"=>"",
"outcomeBPFistulaCheck"=>"",
"outcomeBPFistulaNote"=>"",
"outcomeChylothoraxCheck"=>"",
"outcomeChylothoraxNote"=>"",
"outcomeAnastomosisCheck"=>"",
"outcomeAnastomosisNote"=>"",
"outcomeIleusCheck"=>"",
"outcomeIleusNote"=>"",
"outcomeAspirationCheck"=>"",
"outcomeAspirationNote"=>"",
"outcomeDysphagiaCheck"=>"Arrhythmia surgery:",
"outcomeDysphagiaNote"=>"Maze (biatrial lesion + PVI)",
"outcomeArrthymiaCheck"=>"LA Maze (no RA lesion)",
"outcomeArrthymiaNote"=>"PVI with LAA closure",
"outcomeOthersNote"=>"PVI without LAA closure",
"outcomeStatus"=>""
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