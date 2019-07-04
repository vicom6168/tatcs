<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -  
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     * 
     */
    
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
      
        $this->load->helper('form');
    }
    
    public function wrieDominance()
    {
            $this->load->model('Api_Model');
     
        $patientID=$this->input->post('patientID');
        $Dominance=$this->input->post('Dominance');
         $this->Api_Model->wrieDominance($patientID,$Dominance);
        $arr=array('status'=>'success','result'=>'');
     }
       
       public function receive(){
           $this->load->model('PatientInformation_Model');
        
     $this->load->library('patientinformationClass');
         $query = $this->PatientInformation_Model->viewRecordByChart($this->input->post('patientChartNumber'),$this->input->post('patientOpDate')); 
                 if ($query->num_rows() >=1)
                    {
                        //變更
                     // $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                      $patientinformationClass= new patientinformationClass;
               $patientinformationClass=$query->row();
             
               $pid=$patientinformationClass->patientID;
                 if($this->input->post('isDeleted')=="Y"){
                   //刪除
                       $this->PatientInformation_Model->deleteRecord($pid);
                           echo "刪除病人資料:".$this->input->post('patientName')."";
               } else {
                $patientinformationClass->patientHospital=$this->input->post('patientHospital');
                $patientinformationClass->patientSSN=$this->input->post('patientSSN');
                $patientinformationClass->patientChartNumber=$this->input->post('patientChartNumber');
                $patientinformationClass->patientName=$this->input->post('patientName');
                $patientinformationClass->patientBirthday=$this->input->post('patientBirthday');
                $patientinformationClass->patientAge=$this->input->post('patientAge');
                $patientinformationClass->patientAgeUnit=$this->input->post('patientAgeUnit');
                $patientinformationClass->patientGender=$this->input->post('patientGender');
                 $patientinformationClass->patientSurgeon=$this->input->post('patientSurgeon');
                $patientinformationClass->patientSurgeon2=$this->input->post('patientSurgeon2');
                $patientinformationClass->patientSurgeon3=$this->input->post('patientSurgeon3');
                $patientinformationClass->patientSurgeon4=$this->input->post('patientSurgeon4');
                $patientinformationClass->patientSurgeon5=$this->input->post('patientSurgeon5');
                $patientinformationClass->patientSurgeon_id=$this->input->post('patientSurgeon_id');
                $patientinformationClass->patientSurgeon_id2=$this->input->post('patientSurgeon_id2');
                $patientinformationClass->patientSurgeon_id3=$this->input->post('patientSurgeon_id3');
                $patientinformationClass->patientSurgeon_id4=$this->input->post('patientSurgeon_id4');
                $patientinformationClass->patientSurgeon_id5=$this->input->post('patientSurgeon_id5');
                $patientinformationClass->patientSurgeon_associalid=$this->input->post('patientSurgeon_associalid');
                $patientinformationClass->patientSurgeon_associalid2=$this->input->post('patientSurgeon_associalid2');
                $patientinformationClass->patientSurgeon_associalid3=$this->input->post('patientSurgeon_associalid3');
                $patientinformationClass->patientSurgeon_associalid4=$this->input->post('patientSurgeon_associalid4');
                $patientinformationClass->patientSurgeon_associalid5=$this->input->post('patientSurgeon_associalid5');
                $patientinformationClass->ReOperation=$this->input->post('ReOperation');
                $patientinformationClass->patientOpDate=$this->input->post('patientOpDate');
                $patientinformationClass->AdmissionDate=$this->input->post('AdmissionDate');
                $patientinformationClass->DischargeDate=$this->input->post('DischargeDate');
                $patientinformationClass->patientIsICUAdmission=$this->input->post('patientIsICUAdmission');
                $patientinformationClass->LOS=$this->input->post('LOS');
                $patientinformationClass->ICUAdmissionDate=$this->input->post('ICUAdmissionDate');
                $patientinformationClass->ICUDischargeDate=$this->input->post('ICUDischargeDate');
               $patientinformationClass->ICU_LOS=$this->input->post('ICU_LOS');
                $patientinformationClass->ExtubationDate=$this->input->post('ExtubationDate');
                $patientinformationClass->patientAssociatedDisease=$this->input->post('patientAssociatedDisease');
                $patientinformationClass->diseaseType=$this->input->post('diseaseType');
                $patientinformationClass->Procedure1=$this->input->post('Procedure1');
                $patientinformationClass->Procedure2=$this->input->post('Procedure2');
                $patientinformationClass->Procedure3=$this->input->post('Procedure3');
                $patientinformationClass->Procedure4=$this->input->post('Procedure4');
                $patientinformationClass->Procedure5=$this->input->post('Procedure5');
                $patientinformationClass->Procedure_id1=$this->input->post('Procedure_id1');
                $patientinformationClass->Procedure_id2=$this->input->post('Procedure_id2');
                $patientinformationClass->Procedure_id3=$this->input->post('Procedure_id3');
                $patientinformationClass->Procedure_id4=$this->input->post('Procedure_id4');
                $patientinformationClass->Procedure_id5=$this->input->post('Procedure_id5');
                $patientinformationClass->Procedure_Others=$this->input->post('Procedure_Others');
                $patientinformationClass->Diagnosis1=$this->input->post('Diagnosis1');
                $patientinformationClass->Diagnosis2=$this->input->post('Diagnosis2');
                $patientinformationClass->Diagnosis3=$this->input->post('Diagnosis3');
                $patientinformationClass->Diagnosis4=$this->input->post('Diagnosis4');
                $patientinformationClass->Diagnosis5=$this->input->post('Diagnosis5');
                $patientinformationClass->Diagnosis_id1=$this->input->post('Diagnosis_id1');
                $patientinformationClass->Diagnosis_id2=$this->input->post('Diagnosis_id2');
                $patientinformationClass->Diagnosis_id3=$this->input->post('Diagnosis_id3');
                $patientinformationClass->Diagnosis_id4=$this->input->post('Diagnosis_id4');
                $patientinformationClass->Diagnosis_id5=$this->input->post('Diagnosis_id5');
                $patientinformationClass->DiagnosisOthers=$this->input->post('DiagnosisOthers');
                $patientinformationClass->operationOthersOperation=$this->input->post('operationOthersOperation');
                $patientinformationClass->ProcedureType1=$this->input->post('ProcedureType1');
                $patientinformationClass->ProcedureType2=$this->input->post('ProcedureType2');
                $patientinformationClass->ProcedureType3=$this->input->post('ProcedureType3');
                $patientinformationClass->ProcedureType4=$this->input->post('ProcedureType4');
                $patientinformationClass->ProcedureType5=$this->input->post('ProcedureType5');
                $patientinformationClass->ProcedureTypeName1=$this->input->post('ProcedureTypeName1');
                $patientinformationClass->ProcedureTypeName2=$this->input->post('ProcedureTypeName2');
                $patientinformationClass->ProcedureTypeName3=$this->input->post('ProcedureTypeName3');
                $patientinformationClass->ProcedureTypeName4=$this->input->post('ProcedureTypeName4');
                $patientinformationClass->ProcedureTypeName5=$this->input->post('ProcedureTypeName5');
                $patientinformationClass->CancerLSHeight=$this->input->post('CancerLSHeight');
                $patientinformationClass->CancerLSWeight=$this->input->post('CancerLSWeight');
                $patientinformationClass->CancerLSSmokingAmount=$this->input->post('CancerLSSmokingAmount');
                $patientinformationClass->CancerLSSmokingYear=$this->input->post('CancerLSSmokingYear');
                
                 $patientinformationClass->CancerLSSmokingQuitYear=$this->input->post('CancerLSSmokingQuitYear');
                $patientinformationClass->CancerLSBetelNutsAmount=$this->input->post('CancerLSBetelNutsAmount');
                $patientinformationClass->CancerLSBetelNutsYear=$this->input->post('CancerLSBetelNutsYear');
                $patientinformationClass->CancerLSBetelNutsQuitYear=$this->input->post('CancerLSBetelNutsQuitYear');
                $patientinformationClass->CancerLSDrinking=$this->input->post('CancerLSDrinking');
                $patientinformationClass->Cancer_KPS=$this->input->post('Cancer_KPS');
                $patientinformationClass->Cancer_ECOG=$this->input->post('Cancer_ECOG');
                $patientinformationClass->CancerClinical_T=$this->input->post('CancerClinical_T');
                $patientinformationClass->CancerClinical_N=$this->input->post('CancerClinical_N');
                $patientinformationClass->CancerClinical_M=$this->input->post('CancerClinical_M');
                $patientinformationClass->CancerPathological_T=$this->input->post('CancerPathological_T');
                $patientinformationClass->CancerPathological_N=$this->input->post('CancerPathological_N');
                $patientinformationClass->CancerPathological_M=$this->input->post('CancerPathological_M');
                $patientinformationClass->CancerPathological_Stage=$this->input->post('CancerPathological_Stage');
                $patientinformationClass->CancerStage_memo=$this->input->post('CancerStage_memo');
                $patientinformationClass->CharlsonScore_MI=$this->input->post('CharlsonScore_MI');
                $patientinformationClass->CharlsonScore_CHF=$this->input->post('CharlsonScore_CHF');
                $patientinformationClass->CharlsonScore_PVD=$this->input->post('CharlsonScore_PVD');
                $patientinformationClass->CharlsonScore_CVA=$this->input->post('CharlsonScore_CVA');
                $patientinformationClass->CharlsonScore_Dementia=$this->input->post('CharlsonScore_Dementia');
                $patientinformationClass->CharlsonScore_COPD=$this->input->post('CharlsonScore_COPD');
                $patientinformationClass->CharlsonScore_ConnectiveTissueDisease=$this->input->post('CharlsonScore_ConnectiveTissueDisease');
                $patientinformationClass->CharlsonScore_PepticUlcerDisease=$this->input->post('CharlsonScore_PepticUlcerDisease');
                $patientinformationClass->CharlsonScore_LiverDisease=$this->input->post('CharlsonScore_LiverDisease');
                $patientinformationClass->CharlsonScore_DiabetesMellitus=$this->input->post('CharlsonScore_DiabetesMellitus');
                $patientinformationClass->CharlsonScore_Hemiplegia=$this->input->post('CharlsonScore_Hemiplegia');
                $patientinformationClass->CharlsonScore_CKD=$this->input->post('CharlsonScore_CKD');
                $patientinformationClass->CharlsonScore_SolidTumor=$this->input->post('CharlsonScore_SolidTumor');
                $patientinformationClass->CharlsonScore_Leukemia=$this->input->post('CharlsonScore_Leukemia');
                $patientinformationClass->CharlsonScore_Lymphoma=$this->input->post('CharlsonScore_Lymphoma');
                $patientinformationClass->CharlsonScore_AIDS=$this->input->post('CharlsonScore_AIDS');
                $patientinformationClass->CharlsonScore_Score=$this->input->post('CharlsonScore_Score');
                $patientinformationClass->outcomeDeath=$this->input->post('outcomeDeath');
                $patientinformationClass->outcomeDeathDate=$this->input->post('outcomeDeathDate');
                $patientinformationClass->outcomeDeathMemo=$this->input->post('outcomeDeathMemo');
                $patientinformationClass->outcomeMortalityCheck=$this->input->post('outcomeMortalityCheck');
                $patientinformationClass->outcomeMortalityNote=$this->input->post('outcomeMortalityNote');
                $patientinformationClass->outcomeInfectionCheck=$this->input->post('outcomeInfectionCheck');
                $patientinformationClass->outcomeInfectionNote=$this->input->post('outcomeInfectionNote');
                $patientinformationClass->outcomeReoperationCheck=$this->input->post('outcomeReoperationCheck');
                $patientinformationClass->outcomeReoperationNote=$this->input->post('outcomeReoperationNote');
                 $patientinformationClass->outcomePneumoniaCheck=$this->input->post('outcomePneumoniaCheck');
                 $patientinformationClass->outcomePneumoniaNote=$this->input->post('outcomePneumoniaNote');
                 $patientinformationClass->outcomeIntubationCheck=$this->input->post('outcomeIntubationCheck');
                 $patientinformationClass->outcomeIntubationNote=$this->input->post('outcomeIntubationNote');
                 $patientinformationClass->outcomeHemothoraxCheck=$this->input->post('outcomeHemothoraxCheck');
                 $patientinformationClass->outcomeHemothoraxNote=$this->input->post('outcomeHemothoraxNote');
                 $patientinformationClass->outcomePneumothoraxCheck=$this->input->post('outcomePneumothoraxCheck');
                 $patientinformationClass->outcomePneumothoraxNote=$this->input->post('outcomePneumothoraxNote');
                 $patientinformationClass->outcomeBPFistulaCheck=$this->input->post('outcomeBPFistulaCheck');
                 $patientinformationClass->outcomeBPFistulaNote=$this->input->post('outcomeBPFistulaNote');
                 $patientinformationClass->outcomeChylothoraxCheck=$this->input->post('outcomeChylothoraxCheck');
                 
                $patientinformationClass->outcomeChylothoraxNote=$this->input->post('outcomeChylothoraxNote');
                $patientinformationClass->outcomeAnastomosisCheck=$this->input->post('outcomeAnastomosisCheck');
                $patientinformationClass->outcomeAnastomosisNote=$this->input->post('outcomeAnastomosisNote');
                $patientinformationClass->outcomeIleusCheck=$this->input->post('outcomeIleusCheck');
                $patientinformationClass->outcomeIleusNote=$this->input->post('outcomeIleusNote');
                $patientinformationClass->outcomeAspirationCheck=$this->input->post('outcomeAspirationCheck');
                $patientinformationClass->outcomeAspirationNote=$this->input->post('outcomeAspirationNote');
                $patientinformationClass->outcomeDysphagiaCheck=$this->input->post('outcomeDysphagiaCheck');
                $patientinformationClass->outcomeDysphagiaNote=$this->input->post('outcomeDysphagiaNote');
                $patientinformationClass->outcomeArrthymiaCheck=$this->input->post('outcomeArrthymiaCheck');
                $patientinformationClass->outcomeArrthymiaNote=$this->input->post('outcomeArrthymiaNote');
                $patientinformationClass->outcomeOthersCheck=$this->input->post('outcomeOthersCheck');
                $patientinformationClass->outcomeOthersNote=$this->input->post('outcomeOthersNote');
                $patientinformationClass->isDeleted=$this->input->post('isDeleted');
                $patientinformationClass->outcomeStatus=$this->input->post('outcomeStatus');
                $patientinformationClass->createPerson=$this->input->post('createPerson');
                $patientinformationClass->createTime=$this->input->post('createTime');
                $patientinformationClass->modifyPerson=$this->input->post('modifyPerson');
                $patientinformationClass->modifyTime=$this->input->post('modifyTime');
                $patientinformationClass->patientHospitalUUID=$this->input->post('patientHospitalUUID');
                $patientinformationClass->agreement=$this->input->post('agreement');
                $patientinformationClass->hospitalagreement=$this->input->post('hospitalagreement');
                $patientinformationClass->isSaved=$this->input->post('isSaved');
                $patientinformationClass->modifiedFlag=$this->input->post('modifiedFlag');
                
                $this->PatientInformation_Model->Update_patient($pid, $patientinformationClass);
                   echo "修改病人資料:".$this->input->post('patientName')."<br/>";
                       
                }
                } else {
                    //新增
                      if($this->input->post('isDeleted')=="N"){
                       $patientinformationClass= new patientinformationClass;
               
                $patientinformationClass->patientHospital=$this->input->post('patientHospital');
                $patientinformationClass->patientSSN=$this->input->post('patientSSN');
                $patientinformationClass->patientChartNumber=$this->input->post('patientChartNumber');
                $patientinformationClass->patientName=$this->input->post('patientName');
                $patientinformationClass->patientBirthday=$this->input->post('patientBirthday');
                $patientinformationClass->patientAge=$this->input->post('patientAge');
                $patientinformationClass->patientAgeUnit=$this->input->post('patientAgeUnit');
                $patientinformationClass->patientGender=$this->input->post('patientGender');
                $patientinformationClass->patientSurgeon=$this->input->post('patientSurgeon');
                $patientinformationClass->patientSurgeon2=$this->input->post('patientSurgeon2');
                $patientinformationClass->patientSurgeon3=$this->input->post('patientSurgeon3');
                $patientinformationClass->patientSurgeon4=$this->input->post('patientSurgeon4');
                $patientinformationClass->patientSurgeon5=$this->input->post('patientSurgeon5');
                $patientinformationClass->patientSurgeon_id=$this->input->post('patientSurgeon_id');
                $patientinformationClass->patientSurgeon_id2=$this->input->post('patientSurgeon_id2');
                $patientinformationClass->patientSurgeon_id3=$this->input->post('patientSurgeon_id3');
                $patientinformationClass->patientSurgeon_id4=$this->input->post('patientSurgeon_id4');
                $patientinformationClass->patientSurgeon_id5=$this->input->post('patientSurgeon_id5');
                $patientinformationClass->patientSurgeon_associalid=$this->input->post('patientSurgeon_associalid');
                $patientinformationClass->patientSurgeon_associalid2=$this->input->post('patientSurgeon_associalid2');
                $patientinformationClass->patientSurgeon_associalid3=$this->input->post('patientSurgeon_associalid3');
                $patientinformationClass->patientSurgeon_associalid4=$this->input->post('patientSurgeon_associalid4');
                $patientinformationClass->patientSurgeon_associalid5=$this->input->post('patientSurgeon_associalid5');
                $patientinformationClass->ReOperation=$this->input->post('ReOperation');
                $patientinformationClass->patientOpDate=$this->input->post('patientOpDate');
                $patientinformationClass->AdmissionDate=$this->input->post('AdmissionDate');
                $patientinformationClass->DischargeDate=$this->input->post('DischargeDate');
                $patientinformationClass->patientIsICUAdmission=$this->input->post('patientIsICUAdmission');
                $patientinformationClass->LOS=$this->input->post('LOS');
                $patientinformationClass->ICUAdmissionDate=$this->input->post('ICUAdmissionDate');
                $patientinformationClass->ICUDischargeDate=$this->input->post('ICUDischargeDate');
               $patientinformationClass->ICU_LOS=$this->input->post('ICU_LOS');
                $patientinformationClass->ExtubationDate=$this->input->post('ExtubationDate');
                $patientinformationClass->patientAssociatedDisease=$this->input->post('patientAssociatedDisease');
                $patientinformationClass->diseaseType=$this->input->post('diseaseType');
                $patientinformationClass->Procedure1=$this->input->post('Procedure1');
                $patientinformationClass->Procedure2=$this->input->post('Procedure2');
                $patientinformationClass->Procedure3=$this->input->post('Procedure3');
                $patientinformationClass->Procedure4=$this->input->post('Procedure4');
                $patientinformationClass->Procedure5=$this->input->post('Procedure5');
                $patientinformationClass->Procedure_id1=$this->input->post('Procedure_id1');
                $patientinformationClass->Procedure_id2=$this->input->post('Procedure_id2');
                $patientinformationClass->Procedure_id3=$this->input->post('Procedure_id3');
                $patientinformationClass->Procedure_id4=$this->input->post('Procedure_id4');
                $patientinformationClass->Procedure_id5=$this->input->post('Procedure_id5');
                $patientinformationClass->Procedure_Others=$this->input->post('Procedure_Others');
                $patientinformationClass->Diagnosis1=$this->input->post('Diagnosis1');
                $patientinformationClass->Diagnosis2=$this->input->post('Diagnosis2');
                $patientinformationClass->Diagnosis3=$this->input->post('Diagnosis3');
                $patientinformationClass->Diagnosis4=$this->input->post('Diagnosis4');
                $patientinformationClass->Diagnosis5=$this->input->post('Diagnosis5');
                $patientinformationClass->Diagnosis_id1=$this->input->post('Diagnosis_id1');
                $patientinformationClass->Diagnosis_id2=$this->input->post('Diagnosis_id2');
                $patientinformationClass->Diagnosis_id3=$this->input->post('Diagnosis_id3');
                $patientinformationClass->Diagnosis_id4=$this->input->post('Diagnosis_id4');
                $patientinformationClass->Diagnosis_id5=$this->input->post('Diagnosis_id5');
                $patientinformationClass->DiagnosisOthers=$this->input->post('DiagnosisOthers');
                $patientinformationClass->operationOthersOperation=$this->input->post('operationOthersOperation');
                $patientinformationClass->ProcedureType1=$this->input->post('ProcedureType1');
                $patientinformationClass->ProcedureType2=$this->input->post('ProcedureType2');
                $patientinformationClass->ProcedureType3=$this->input->post('ProcedureType3');
                $patientinformationClass->ProcedureType4=$this->input->post('ProcedureType4');
                $patientinformationClass->ProcedureType5=$this->input->post('ProcedureType5');
                $patientinformationClass->ProcedureTypeName1=$this->input->post('ProcedureTypeName1');
                $patientinformationClass->ProcedureTypeName2=$this->input->post('ProcedureTypeName2');
                $patientinformationClass->ProcedureTypeName3=$this->input->post('ProcedureTypeName3');
                $patientinformationClass->ProcedureTypeName4=$this->input->post('ProcedureTypeName4');
                $patientinformationClass->ProcedureTypeName5=$this->input->post('ProcedureTypeName5');
                $patientinformationClass->CancerLSHeight=$this->input->post('CancerLSHeight');
                $patientinformationClass->CancerLSWeight=$this->input->post('CancerLSWeight');
                $patientinformationClass->CancerLSSmokingAmount=$this->input->post('CancerLSSmokingAmount');
                $patientinformationClass->CancerLSSmokingYear=$this->input->post('CancerLSSmokingYear');
                
                 $patientinformationClass->CancerLSSmokingQuitYear=$this->input->post('CancerLSSmokingQuitYear');
                $patientinformationClass->CancerLSBetelNutsAmount=$this->input->post('CancerLSBetelNutsAmount');
                $patientinformationClass->CancerLSBetelNutsYear=$this->input->post('CancerLSBetelNutsYear');
                $patientinformationClass->CancerLSBetelNutsQuitYear=$this->input->post('CancerLSBetelNutsQuitYear');
                $patientinformationClass->CancerLSDrinking=$this->input->post('CancerLSDrinking');
                $patientinformationClass->Cancer_KPS=$this->input->post('Cancer_KPS');
                $patientinformationClass->Cancer_ECOG=$this->input->post('Cancer_ECOG');
                $patientinformationClass->CancerClinical_T=$this->input->post('CancerClinical_T');
                $patientinformationClass->CancerClinical_N=$this->input->post('CancerClinical_N');
                $patientinformationClass->CancerClinical_M=$this->input->post('CancerClinical_M');
                $patientinformationClass->CancerPathological_T=$this->input->post('CancerPathological_T');
                $patientinformationClass->CancerPathological_N=$this->input->post('CancerPathological_N');
                $patientinformationClass->CancerPathological_M=$this->input->post('CancerPathological_M');
                $patientinformationClass->CancerPathological_Stage=$this->input->post('CancerPathological_Stage');
                $patientinformationClass->CancerStage_memo=$this->input->post('CancerStage_memo');
                $patientinformationClass->CharlsonScore_MI=$this->input->post('CharlsonScore_MI');
                $patientinformationClass->CharlsonScore_CHF=$this->input->post('CharlsonScore_CHF');
                $patientinformationClass->CharlsonScore_PVD=$this->input->post('CharlsonScore_PVD');
                $patientinformationClass->CharlsonScore_CVA=$this->input->post('CharlsonScore_CVA');
                $patientinformationClass->CharlsonScore_Dementia=$this->input->post('CharlsonScore_Dementia');
                $patientinformationClass->CharlsonScore_COPD=$this->input->post('CharlsonScore_COPD');
                $patientinformationClass->CharlsonScore_ConnectiveTissueDisease=$this->input->post('CharlsonScore_ConnectiveTissueDisease');
                $patientinformationClass->CharlsonScore_PepticUlcerDisease=$this->input->post('CharlsonScore_PepticUlcerDisease');
                $patientinformationClass->CharlsonScore_LiverDisease=$this->input->post('CharlsonScore_LiverDisease');
                $patientinformationClass->CharlsonScore_DiabetesMellitus=$this->input->post('CharlsonScore_DiabetesMellitus');
                $patientinformationClass->CharlsonScore_Hemiplegia=$this->input->post('CharlsonScore_Hemiplegia');
                $patientinformationClass->CharlsonScore_CKD=$this->input->post('CharlsonScore_CKD');
                $patientinformationClass->CharlsonScore_SolidTumor=$this->input->post('CharlsonScore_SolidTumor');
                $patientinformationClass->CharlsonScore_Leukemia=$this->input->post('CharlsonScore_Leukemia');
                $patientinformationClass->CharlsonScore_Lymphoma=$this->input->post('CharlsonScore_Lymphoma');
                $patientinformationClass->CharlsonScore_AIDS=$this->input->post('CharlsonScore_AIDS');
                $patientinformationClass->CharlsonScore_Score=$this->input->post('CharlsonScore_Score');
                $patientinformationClass->outcomeDeath=$this->input->post('outcomeDeath');
                $patientinformationClass->outcomeDeathDate=$this->input->post('outcomeDeathDate');
                $patientinformationClass->outcomeDeathMemo=$this->input->post('outcomeDeathMemo');
                $patientinformationClass->outcomeMortalityCheck=$this->input->post('outcomeMortalityCheck');
                $patientinformationClass->outcomeMortalityNote=$this->input->post('outcomeMortalityNote');
                $patientinformationClass->outcomeInfectionCheck=$this->input->post('outcomeInfectionCheck');
                $patientinformationClass->outcomeInfectionNote=$this->input->post('outcomeInfectionNote');
                $patientinformationClass->outcomeReoperationCheck=$this->input->post('outcomeReoperationCheck');
                $patientinformationClass->outcomeReoperationNote=$this->input->post('outcomeReoperationNote');
                 $patientinformationClass->outcomePneumoniaCheck=$this->input->post('outcomePneumoniaCheck');
                 $patientinformationClass->outcomePneumoniaNote=$this->input->post('outcomePneumoniaNote');
                 $patientinformationClass->outcomeIntubationCheck=$this->input->post('outcomeIntubationCheck');
                 $patientinformationClass->outcomeIntubationNote=$this->input->post('outcomeIntubationNote');
                 $patientinformationClass->outcomeHemothoraxCheck=$this->input->post('outcomeHemothoraxCheck');
                 $patientinformationClass->outcomeHemothoraxNote=$this->input->post('outcomeHemothoraxNote');
                 $patientinformationClass->outcomePneumothoraxCheck=$this->input->post('outcomePneumothoraxCheck');
                 $patientinformationClass->outcomePneumothoraxNote=$this->input->post('outcomePneumothoraxNote');
                 $patientinformationClass->outcomeBPFistulaCheck=$this->input->post('outcomeBPFistulaCheck');
                 $patientinformationClass->outcomeBPFistulaNote=$this->input->post('outcomeBPFistulaNote');
                 $patientinformationClass->outcomeChylothoraxCheck=$this->input->post('outcomeChylothoraxCheck');
                 
                $patientinformationClass->outcomeChylothoraxNote=$this->input->post('outcomeChylothoraxNote');
                $patientinformationClass->outcomeAnastomosisCheck=$this->input->post('outcomeAnastomosisCheck');
                $patientinformationClass->outcomeAnastomosisNote=$this->input->post('outcomeAnastomosisNote');
                $patientinformationClass->outcomeIleusCheck=$this->input->post('outcomeIleusCheck');
                $patientinformationClass->outcomeIleusNote=$this->input->post('outcomeIleusNote');
                $patientinformationClass->outcomeAspirationCheck=$this->input->post('outcomeAspirationCheck');
                $patientinformationClass->outcomeAspirationNote=$this->input->post('outcomeAspirationNote');
                $patientinformationClass->outcomeDysphagiaCheck=$this->input->post('outcomeDysphagiaCheck');
                $patientinformationClass->outcomeDysphagiaNote=$this->input->post('outcomeDysphagiaNote');
                $patientinformationClass->outcomeArrthymiaCheck=$this->input->post('outcomeArrthymiaCheck');
                $patientinformationClass->outcomeArrthymiaNote=$this->input->post('outcomeArrthymiaNote');
                $patientinformationClass->outcomeOthersCheck=$this->input->post('outcomeOthersCheck');
                $patientinformationClass->outcomeOthersNote=$this->input->post('outcomeOthersNote');
                $patientinformationClass->isDeleted=$this->input->post('isDeleted');
                $patientinformationClass->outcomeStatus=$this->input->post('outcomeStatus');
                $patientinformationClass->createPerson=$this->input->post('createPerson');
                $patientinformationClass->createTime=$this->input->post('createTime');
                $patientinformationClass->modifyPerson=$this->input->post('modifyPerson');
                $patientinformationClass->modifyTime=$this->input->post('modifyTime');
                $patientinformationClass->patientHospitalUUID=$this->input->post('patientHospitalUUID');
                $patientinformationClass->agreement=$this->input->post('agreement');
                $patientinformationClass->hospitalagreement=$this->input->post('hospitalagreement');
                $patientinformationClass->isSaved=$this->input->post('isSaved');
                $patientinformationClass->modifiedFlag=$this->input->post('modifiedFlag');
               echo "新增病人資料:".$this->input->post('patientName')."<br/>";
                $insert_id=$this->PatientInformation_Model->Save_patient($patientinformationClass);
                }
                   
                }
       }

public function send(){
    // 建立CURL連線
   $this->load->library('Curl');
  $d1=  $this->input->post('u1');
  $d2=  $this->input->post('u2');
  $h1=$this->input->post('h');
$ch = curl_init();
$html="病患資料上傳結果如下：<br/><br/>";
// 設定擷取的URL網址
curl_setopt($ch, CURLOPT_URL, "http://www.twcvs.org.tw/api/receive");
curl_setopt($ch, CURLOPT_HEADER, false);
//設定要傳的 變數A=值A & 變數B=值B (中間要用&符號串接)
$this->load->model('PatientInformation_Model');
      
$patientList=$this->PatientInformation_Model->export_uploadpatientdo($d1,$d2,'');
//$column = $this->PatientInformation_Model->viewRecord('270')->row();
  foreach($patientList->result() as $row){       
$PostData = http_build_query((array) $row);

//設定CURLOPT_POST 為 1或true，表示要用POST方式傳遞
curl_setopt($ch, CURLOPT_POST, 1); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//CURLOPT_POSTFIELDS 後面則是要傳接的POST資料。
curl_setopt($ch, CURLOPT_POSTFIELDS, $PostData);
// 執行
//curl_exec($ch);

$html.=curl_exec($ch);
  }
// 關閉CURL連線
curl_close($ch);
$data['page']="upload";    
$data['subpage']="patient"; 
$data['html']=$html;
$data['path']="<li>上傳學會</li><li  class='break'>&#187;</li><li>病患資料上傳結果</li>";
$this->load->view('upload/patient',$data);
//echo $html;
}
public function sendnosurgery(){
    // 建立CURL連線
   $this->load->library('Curl');
  $y1=  $this->input->post('u1');
  $m1=  $this->input->post('u2');
  $y2=  $this->input->post('u3');
  $m2=  $this->input->post('u4');
  $h1=$this->input->post('h');
$ch = curl_init();
$html="非開心手術資料上傳結果如下：<br/><br/>";
// 設定擷取的URL網址
curl_setopt($ch, CURLOPT_URL, "http://www.twcvs.org.tw/api/receivenosurgery");
curl_setopt($ch, CURLOPT_HEADER, false);
//設定要傳的 變數A=值A & 變數B=值B (中間要用&符號串接)
$this->load->model('PatientInformation_Model');
      
$patientList=$this->PatientInformation_Model->export_uploadNonSurgery($y1,$m1,$y2,$m2,$h1);
//$column = $this->PatientInformation_Model->viewRecord('270')->row();
  foreach($patientList->result() as $row){       
$PostData = http_build_query((array) $row);

//設定CURLOPT_POST 為 1或true，表示要用POST方式傳遞
curl_setopt($ch, CURLOPT_POST, 1); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//CURLOPT_POSTFIELDS 後面則是要傳接的POST資料。
curl_setopt($ch, CURLOPT_POSTFIELDS, $PostData);
// 執行
//curl_exec($ch);

$html.=curl_exec($ch);
  }
// 關閉CURL連線
curl_close($ch);
$data['page']="upload";    
$data['subpage']="nonsurgery"; 
$data['html']=$html;
$data['path']="<li>上傳學會</li><li  class='break'>&#187;</li><li>非開心手術資料上傳結果</li>";
$this->load->view('upload/result',$data);
//echo $html;
}
public function receivenosurgery(){
           $this->load->model('Nonopenheart_Model');
        $this->load->library('nonopenheartClass');
       
              $y=$this->input->post('qYear');
            $m=$this->input->post('qMonth');
              $h=$this->input->post('patientHospital');
         $query = $this->Nonopenheart_Model->checkUpload($y,$m,$h); 
                 if ($query->num_rows() ==1)
                    {
                        
                       $nonopenheartClass= new nonopenheartClass;
               $nonopenheartClass=$query->row();
             
               $pid=$nonopenheartClass->nid;
                
                $nonopenheartClass->qYear=$this->input->post('qYear');
                $nonopenheartClass->qMonth=$this->input->post('qMonth');
                $nonopenheartClass->item1=$this->input->post('item1');
                $nonopenheartClass->item2=$this->input->post('item2');
                $nonopenheartClass->item3=$this->input->post('item3');
                $nonopenheartClass->item4=$this->input->post('item4');
                $nonopenheartClass->item5=$this->input->post('item5');
                $nonopenheartClass->item6=$this->input->post('item6');
                $nonopenheartClass->item7=$this->input->post('item7');
                $nonopenheartClass->item8=$this->input->post('item8');
                $nonopenheartClass->item9=$this->input->post('item9');
                $nonopenheartClass->item10=$this->input->post('item10');
                $nonopenheartClass->patientHospital=$h;
            
                $this->Nonopenheart_Model->update_nonopenheart($pid, $nonopenheartClass);
                   echo "<br/>修改非開心手術資料:".$this->input->post('qYear')."/".$this->input->post('qMonth');
                      
                } else {
                    //新增
                        $nonopenheartClass = new nonopenheartClass;
                $nonopenheartClass->qYear=$this->input->post('qYear');
                $nonopenheartClass->qMonth=$this->input->post('qMonth');
                $nonopenheartClass->item1=$this->input->post('item1');
                $nonopenheartClass->item2=$this->input->post('item2');
                $nonopenheartClass->item3=$this->input->post('item3');
                $nonopenheartClass->item4=$this->input->post('item4');
                $nonopenheartClass->item5=$this->input->post('item5');
                $nonopenheartClass->item6=$this->input->post('item6');
                $nonopenheartClass->item7=$this->input->post('item7');
                $nonopenheartClass->item8=$this->input->post('item8');
                $nonopenheartClass->item9=$this->input->post('item9');
                $nonopenheartClass->item10=$this->input->post('item10');
                $nonopenheartClass->patientHospital=$h;
               
                 echo "<br/><b>新增非開心手術資料:".$this->input->post('qYear')."/".$this->input->post('qMonth')."</b>";
                $insert_id=$this->Nonopenheart_Model->save_nonopenheart($nonopenheartClass);
                    
                   
                }
       }
public function test(){
    echo phpinfo();
}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */