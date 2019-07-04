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
"patientSurgeon"=>"主治醫師 1",
"patientSurgeon2"=>"主治醫師 2",
"patientSurgeon3"=>"住院醫師 1",
"patientSurgeon4"=>"住院醫師 2",
"ReOperation"=>"Re-operation",
"patientOpDate"=>"Operation date",
"AdmissionDate"=>"Admission date",
"DischargeDate"=>"Discharge date",
"LOS"=>"Length Of Stay",
"ICUAdmissionDate"=>"ICU Admission Date",
"ICUDischargeDate"=>"ICU Discharge Date",
"ICU_LOS"=>"ICU Length Of Stay",
"ExtubationDate"=>"Extubation Date",
"patientAssociatedDisease"=>"Associated Disease",
"diseaseType"=>"Disease Type",
"Procedure1"=>"Primary Procedure",
"Procedure2"=>"Secondary Procedure 1",
"Procedure3"=>"Secondary Procedure 2 ",
"Procedure4"=>"Secondary Procedure 3",
"Procedure5"=>"Secondary Procedure 4",
"Procedure_Others"=>"Procedure  Others",
"Diagnosis1"=>"Diagnosis 1",
"Diagnosis2"=>"Diagnosis 2",
"Diagnosis3"=>"Diagnosis 3",
"Diagnosis4"=>"Diagnosis 4",
"Diagnosis5"=>"Diagnosis 5",
"DiagnosisOthers"=>"Diagnosis Others",
"ProcedureTypeName1"=>"Primary Procedure TypeName",
"ProcedureTypeName2"=>"Secondary Procedure TypeName 1",
"ProcedureTypeName3"=>"Secondary Procedure TypeName 2",
"ProcedureTypeName4"=>"Secondary Procedure TypeName 3",
"ProcedureTypeName5"=>"Secondary Procedure TypeName 4",
"CancerLSHeight"=>"病史資料, 生活型態,Height (cm)",
"CancerLSWeight"=>"病史資料, 生活型態,Weight (kgw)",
"CancerLSSmokingAmount"=>"病史資料, 生活型態, 吸煙量",
"CancerLSSmokingYear"=>"病史資料, 生活型態, 吸煙年",
"CancerLSSmokingQuitYear"=>"病史資料, 生活型態, 戒煙年",
"CancerLSBetelNutsAmount"=>"病史資料, 生活型態, 檳榔量",
"CancerLSBetelNutsYear"=>"病史資料, 生活型態, 檳榔年",
"CancerLSBetelNutsQuitYear"=>"病史資料, 生活型態, 戒檳榔年",
"CancerLSDrinking"=>"病史資料, 生活型態, 飲酒狀況",
"Cancer_KPS"=>"病史資料, 生活型態, KPS",
"Cancer_ECOG"=>"病史資料, 生活型態, ECOG",
"CancerClinical_T"=>"病史資料,癌症分期, Clinical-T",
"CancerClinical_N"=>"病史資料,癌症分期, Clinical-N",
"CancerClinical_M"=>"病史資料,癌症分期, Clinical-M",
"CancerClinical_StageGroup"=>"病史資料,癌症分期, Clinical-Stage Group",
"CancerPathological_T"=>"病史資料,癌症分期, Pathological-T",
"CancerPathological_N"=>"病史資料,癌症分期, Pathological-N",
"CancerPathological_M"=>"病史資料,癌症分期, Pathological-M",
"CancerPathological_Stage"=>"病史資料,癌症分期, Pathological-Stage Group",
"CancerStage_memo"=>"病史資料,癌症分期, Note",
"CharlsonScore_MI"=>"病史資料, Charlson Score, Myocardial infarction",
"CharlsonScore_CHF"=>"病史資料, Charlson Score, CHF",
"CharlsonScore_PVD"=>"病史資料, Charlson Score,Peripheral vascular disease",
"CharlsonScore_CVA"=>"病史資料, Charlson Score,CVA",
"CharlsonScore_Dementia"=>"病史資料, Charlson Score,Dementia",
"CharlsonScore_COPD"=>"病史資料, Charlson Score,COPD",
"CharlsonScore_ConnectiveTissueDisease"=>"病史資料, Charlson Score,Connective tissue disease",
"CharlsonScore_PepticUlcerDisease"=>"病史資料, Charlson Score,Peptic ulcer disease",
"CharlsonScore_LiverDisease"=>"病史資料, Charlson Score,Liver disease",
"CharlsonScore_DiabetesMellitus"=>"病史資料, Charlson Score,Hormone Diabetes Mellitus",
"CharlsonScore_Hemiplegia"=>"病史資料, Charlson Score,Hemiplegia",
"CharlsonScore_CKD"=>"病史資料, Charlson Score,CKD",
"CharlsonScore_SolidTumor"=>"病史資料, Charlson Score,Solid Tumor",
"CharlsonScore_Leukemia"=>"病史資料, Charlson Score,Leukemia",
"CharlsonScore_Lymphoma"=>"病史資料, Charlson Score,Lymphoma",
"CharlsonScore_AIDS"=>"病史資料, Charlson Score,AIDS",
"CharlsonScore_Score"=>"病史資料, Charlson Score,CharlsonScore",
"outcomeDeath"=>"併發症及結果-是否死亡",
"outcomeDeathDate"=>"併發症及結果-死亡日期",
"outcomeDeathMemo"=>"併發症及結果-死亡說明",
"outcomeMortalityCheck"=>"併發症及結果-Operative Mortality",
"outcomeMortalityNote"=>"併發症及結果-Operative Mortality Note",
"outcomeInfectionCheck"=>"併發症及結果-Wound Infection",
"outcomeInfectionNote"=>"併發症及結果-Wound Infection Note",
"outcomeReoperationCheck"=>"併發症及結果-Reoperation For any reason",
"outcomeReoperationNote"=>"併發症及結果-Reoperation For any reason Note",
"outcomePneumoniaCheck"=>"併發症及結果-pneumonia",
"outcomePneumoniaNote"=>"併發症及結果-pneumonia Note",
"outcomeIntubationCheck"=>"併發症及結果-prolong intubation",
"outcomeIntubationNote"=>"併發症及結果-prolong intubation Note",
"outcomeHemothoraxCheck"=>"併發症及結果-hemothorax",
"outcomeHemothoraxNote"=>"併發症及結果-hemothorax Note",
"outcomePneumothoraxCheck"=>"併發症及結果-pneumothorax",
"outcomePneumothoraxNote"=>"併發症及結果-pneumothorax Note",
"outcomeBPFistulaCheck"=>"併發症及結果-B-P fistula",
"outcomeBPFistulaNote"=>"併發症及結果-B-P fistula Note",
"outcomeChylothoraxCheck"=>"併發症及結果-chylothorax",
"outcomeChylothoraxNote"=>"併發症及結果-chylothorax Note",
"outcomeAnastomosisCheck"=>"併發症及結果-anastomosis leakage",
"outcomeAnastomosisNote"=>"併發症及結果-anastomosis leakage Note",
"outcomeIleusCheck"=>"併發症及結果-ileus",
"outcomeIleusNote"=>"併發症及結果-ileus Note",
"outcomeAspirationCheck"=>"併發症及結果-aspiration",
"outcomeAspirationNote"=>"併發症及結果-aspiration Note",
"outcomeDysphagiaCheck"=>"併發症及結果-dysphagia",
"outcomeDysphagiaNote"=>"併發症及結果-dysphagia Note",
"outcomeArrthymiaCheck"=>"併發症及結果-Arrthymia",
"outcomeArrthymiaNote"=>"併發症及結果-Arrthymia Note",
"outcomeOthersCheck"=>"併發症及結果-Others",
"outcomeOthersNote"=>"併發症及結果-Others Note",
"outcomeStatus"=>"併發症及結果 出院結果"
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