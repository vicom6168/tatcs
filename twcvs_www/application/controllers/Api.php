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
        //      $t=$this->input->post('type');
         //$query = $this->News_Model->query_NewsList('1');
    //  $arr=array('status'=>'success','result'=>$query->result());
       //  echo json_encode($arr);
      
     $this->load->library('patientinformationClass');
        $uuid=$this->input->post('patientHospitalUUID');
         $query = $this->PatientInformation_Model->checkUpload($uuid,$this->input->post('patientHospital')); 
                 if ($query->num_rows() ==1)
                    {
                        //變更
                     // $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                      $patientinformationClass= new patientinformationClass;
               $patientinformationClass=$query->row();
             
               $pid=$patientinformationClass->patientID;
                 if($this->input->post('isDeleted')=="Y"){
                   //刪除
                       $this->PatientInformation_Model->deleteRecord($pid);
                           echo "<br/><font color='red'>刪除病人資料:".$this->input->post('patientName')."</font>";
               } else {
                        $patientinformationClass->patientHospital=$this->input->post('patientHospital');
                $patientinformationClass->patientSSN=$this->input->post('patientSSN');
                $patientinformationClass->patientChartNumber=$this->input->post('patientChartNumber');
                $patientinformationClass->patientName=$this->input->post('patientName');
                $patientinformationClass->patientBirthday=$this->input->post('patientBirthday');
                $patientinformationClass->patientAge=$this->input->post('patientAge');
                $patientinformationClass->patientAgeUnit=$this->input->post('patientAgeUnit');
                $patientinformationClass->patientGender=$this->input->post('patientGender');
                       //$patientinformationClass->patientSurgeon=$this->input->post('patientSurgeon');
                       //$patientinformationClass->patientSurgeon2=$this->input->post('patientSurgeon2');
                       //$patientinformationClass->patientSurgeon3=$this->input->post('patientSurgeon3');
                       //$patientinformationClass->patientSurgeon4=$this->input->post('patientSurgeon4');
                        $patientinformationClass->patientOpDate=$this->input->post('patientOpDate');
                $patientinformationClass->patientDischargeDate=$this->input->post('patientDischargeDate');
                $patientinformationClass->patientOpenHeartSurgery=$this->input->post('patientOpenHeartSurgery');
                $patientinformationClass->patientCongenitalSurgery=$this->input->post('patientCongenitalSurgery');
                $patientinformationClass->patientNonOpenHeart=$this->input->post('patientNonOpenHeart');
                $patientinformationClass->patientDiagnosis=$this->input->post('patientDiagnosis');
                $patientinformationClass->patientAssociatedDisease=$this->input->post('patientAssociatedDisease')=="0"?"":$this->input->post('patientAssociatedDisease');
                $patientinformationClass->euroScoreII=$this->input->post('euroScoreII');
                $patientinformationClass->CcrberforOperation=$this->input->post('CcrberforOperation');
                $patientinformationClass->pastHistoryRenalImpairment=$this->input->post('pastHistoryRenalImpairment');
                $patientinformationClass->patientBodyWeight=$this->input->post('patientBodyWeight');
                $patientinformationClass->patientSerumCreatinine=$this->input->post('patientSerumCreatinine');
                $patientinformationClass->CcrberforOperation=$this->input->post('CcrberforOperation');
                $patientinformationClass->pastHistoryExtracardiacArteriopathy=$this->input->post('pastHistoryExtracardiacArteriopathy');
                        $patientinformationClass->pastHistoryPoorMobility=$this->input->post('pastHistoryPoorMobility');
                $patientinformationClass->pastHistoryPreviousCardiacSurgery=$this->input->post('pastHistoryPreviousCardiacSurgery');
                $patientinformationClass->pastHistoryChronicLungDisease=$this->input->post('pastHistoryChronicLungDisease');
                $patientinformationClass->pastHistoryDiabetesOnInsulin=$this->input->post('pastHistoryDiabetesOnInsulin');
                $patientinformationClass->pastHistoryActiveEndocarditis=$this->input->post('pastHistoryActiveEndocarditis');
                $patientinformationClass->pastHistoryCriticalPreoperativeState=$this->input->post('pastHistoryCriticalPreoperativeState');
                        $patientinformationClass->pastHistoryNYHA=$this->input->post('pastHistoryNYHA');
                $patientinformationClass->pastHistoryCCSClass4Angina=$this->input->post('pastHistoryCCSClass4Angina');
                $patientinformationClass->pastHistoryLVFunction=$this->input->post('pastHistoryLVFunction');
                $patientinformationClass->pastHistoryRecentMI=$this->input->post('pastHistoryRecentMI');
                $patientinformationClass->pastHistoryUrgency=$this->input->post('pastHistoryUrgency');
                $patientinformationClass->pastHistoryWeightOfTheIntervention=$this->input->post('pastHistoryWeightOfTheIntervention');
                $patientinformationClass->pastHistoryPulmonaryHypertension=$this->input->post('pastHistoryPulmonaryHypertension');
                $patientinformationClass->pastHistorySurgeryThoracicAorta=$this->input->post('pastHistorySurgeryThoracicAorta');
                $patientinformationClass->outcomeCheck1=$this->input->post('outcomeCheck1');
                $patientinformationClass->outcomeData1=$this->input->post('outcomeData1');
                $patientinformationClass->outcomeCheck2=$this->input->post('outcomeCheck2');
                $patientinformationClass->outcomeData2=$this->input->post('outcomeData2');
                $patientinformationClass->outcomeCheck3=$this->input->post('outcomeCheck3');
                $patientinformationClass->outcomeData3=$this->input->post('outcomeData3');
                $patientinformationClass->outcomeCheck4=$this->input->post('outcomeCheck4');
                $patientinformationClass->outcomeData4=$this->input->post('outcomeData4');
                $patientinformationClass->outcomeCheck5=$this->input->post('outcomeCheck5');
                $patientinformationClass->outcomeData5=$this->input->post('outcomeData5');
                $patientinformationClass->outcomeCheck6=$this->input->post('outcomeCheck6');
                $patientinformationClass->outcomeData6=$this->input->post('outcomeData6');
                $patientinformationClass->outcomeCheck7=$this->input->post('outcomeCheck7');
                $patientinformationClass->outcomeData7=$this->input->post('outcomeData7');
                $patientinformationClass->outcomeCheck8=$this->input->post('outcomeCheck8');
                $patientinformationClass->outcomeData8=$this->input->post('outcomeData8');
                $patientinformationClass->outcomeCheck9=$this->input->post('outcomeCheck9');
                $patientinformationClass->outcomeData9=$this->input->post('outcomeData9');
                $patientinformationClass->outcomeCheck10=$this->input->post('outcomeCheck10');
                $patientinformationClass->outcomeData10=$this->input->post('outcomeData10');
                
                 $patientinformationClass->patientDischargeDate=$this->input->post('patientDischargeDate');
                $patientinformationClass->outcomeExtubationDate=$this->input->post('outcomeExtubationDate');
                $patientinformationClass->outcomeStatus=$this->input->post('outcomeStatus');
                $patientinformationClass->outcomeChildComplication1=$this->input->post('outcomeChildComplication1');
                $patientinformationClass->outcomeChildComplication2=$this->input->post('outcomeChildComplication2');
                $patientinformationClass->outcomeChildComplication3=$this->input->post('outcomeChildComplication3');
                $patientinformationClass->outcomeChildComplication4=$this->input->post('outcomeChildComplication4');
                $patientinformationClass->outcomeChildComplication5=$this->input->post('outcomeChildComplication5');
                $patientinformationClass->outcomeChildComplication6=$this->input->post('outcomeChildComplication6');
                $patientinformationClass->outcomeChildComplication7=$this->input->post('outcomeChildComplication7');
                $patientinformationClass->outcomeChildComplication8=$this->input->post('outcomeChildComplication8');
                $patientinformationClass->outcomeChildComplication9=$this->input->post('outcomeChildComplication9');
                $patientinformationClass->outcomeChildComplication10=$this->input->post('outcomeChildComplication10');
                $patientinformationClass->outcomeChildComplication11=$this->input->post('outcomeChildComplication11');
                $patientinformationClass->outcomeChildComplication12=$this->input->post('outcomeChildComplication12');
                $patientinformationClass->outcomeChildComplication13=$this->input->post('outcomeChildComplication13');
                $patientinformationClass->outcomeChildComplication14=$this->input->post('outcomeChildComplication14');
                $patientinformationClass->outcomeChildComplication15=$this->input->post('outcomeChildComplication15');
                $patientinformationClass->outcomeChildComplication16=$this->input->post('outcomeChildComplication16');
                $patientinformationClass->outcomeChildComplication17=$this->input->post('outcomeChildComplication17');
                $patientinformationClass->outcomeChildComplication18=$this->input->post('outcomeChildComplication18');
                $patientinformationClass->outcomeChildComplication19=$this->input->post('outcomeChildComplication19');
                $patientinformationClass->outcomeChildComplication20=$this->input->post('outcomeChildComplication20');
                $patientinformationClass->outcomeChildComplication21=$this->input->post('outcomeChildComplication21');
                $patientinformationClass->outcomeChildComplication22=$this->input->post('outcomeChildComplication22');
                $patientinformationClass->outcomeChildComplication23=$this->input->post('outcomeChildComplication23');
                $patientinformationClass->outcomeChildComplication24=$this->input->post('outcomeChildComplication24');
                $patientinformationClass->outcomeChildComplication25=$this->input->post('outcomeChildComplication25');
                $patientinformationClass->outcomeChildComplication26=$this->input->post('outcomeChildComplication26');
                $patientinformationClass->outcomeChildComplication27=$this->input->post('outcomeChildComplication27');
                $patientinformationClass->outcomeChildComplication28=$this->input->post('outcomeChildComplication28');
                $patientinformationClass->outcomeChildComplication29=$this->input->post('outcomeChildComplication29');
                $patientinformationClass->outcomeChildComplication30=$this->input->post('outcomeChildComplication30');
                $patientinformationClass->outcomeChildComplication31=$this->input->post('outcomeChildComplication31');
                $patientinformationClass->outcomeChildComplication32=$this->input->post('outcomeChildComplication32');
                $patientinformationClass->outcomeChildComplication33=$this->input->post('outcomeChildComplication33');
                $patientinformationClass->outcomeChildComplication34=$this->input->post('outcomeChildComplication34');
                $patientinformationClass->outcomeChildComplication35=$this->input->post('outcomeChildComplication35');
                $patientinformationClass->outcomeChildComplication36=$this->input->post('outcomeChildComplication36');
                $patientinformationClass->outcomeChildCauseofDeath=$this->input->post('outcomeChildCauseofDeath');
                $patientinformationClass->operationAssociateCategory=$this->input->post('operationAssociateCategory');
                 $patientinformationClass->AdultDiagnosis1=$this->input->post('AdultDiagnosis1');
                 $patientinformationClass->AdultDiagnosis2=$this->input->post('AdultDiagnosis2');
                 $patientinformationClass->AdultDiagnosis3=$this->input->post('AdultDiagnosis3');
                 $patientinformationClass->AdultDiagnosis4=$this->input->post('AdultDiagnosis4');
                 $patientinformationClass->AdultDiagnosis5=$this->input->post('AdultDiagnosis5');
                 $patientinformationClass->AdultDiagnosis_id1=$this->input->post('AdultDiagnosis_id1');
                 $patientinformationClass->AdultDiagnosis_id2=$this->input->post('AdultDiagnosis_id2');
                 $patientinformationClass->AdultDiagnosis_id3=$this->input->post('AdultDiagnosis_id3');
                 $patientinformationClass->AdultDiagnosis_id4=$this->input->post('AdultDiagnosis_id4');
                 $patientinformationClass->AdultDiagnosis_id5=$this->input->post('AdultDiagnosis_id5');
                 $patientinformationClass->AdultDiagnosisOthers=$this->input->post('AdultDiagnosisOthers');
                 
                $patientinformationClass->operationCABG=$this->input->post('operationCABG');
                $patientinformationClass->operationLIMA=$this->input->post('operationLIMA');
                $patientinformationClass->operationRIMA=$this->input->post('operationRIMA');
                $patientinformationClass->operationRIMA_RadialA=$this->input->post('operationRIMA_RadialA');
                $patientinformationClass->operationRIMA_GEA=$this->input->post('operationRIMA_GEA');
                $patientinformationClass->operationVeinGraft=$this->input->post('operationVeinGraft');
                $patientinformationClass->operationCardiopulmonaryBypass=$this->input->post('operationCardiopulmonaryBypass');
                $patientinformationClass->operationCardiacArrest=$this->input->post('operationCardiacArrest');
                $patientinformationClass->operationCABGMemo=$this->input->post('operationCABGMemo');
                $patientinformationClass->operationAorticValve=$this->input->post('operationAorticValve');
                $patientinformationClass->operationAorticValve_AVP=$this->input->post('operationAorticValve_AVP');
                $patientinformationClass->operationAorticValve_AVR=$this->input->post('operationAorticValve_AVR');
                $patientinformationClass->operationAVP=$this->input->post('operationAVP');
                $patientinformationClass->operationMitralValveBentall=$this->input->post('operationMitralValveBentall');
                $patientinformationClass->operationAVRSelect=$this->input->post('operationAVRSelect');
                $patientinformationClass->operationAorticMemo=$this->input->post('operationAorticMemo');
                $patientinformationClass->operationMitralValve=$this->input->post('operationMitralValve');
                $patientinformationClass->Operation_MitralValve_MVP=$this->input->post('Operation_MitralValve_MVP');
                $patientinformationClass->operationMVPRing=$this->input->post('operationMVPRing');
                $patientinformationClass->operationMVPArtificialChord=$this->input->post('operationMVPArtificialChord');
                $patientinformationClass->operationMVPAnnularPlication=$this->input->post('operationMVPAnnularPlication');
                $patientinformationClass->operationMVPLeafletResection=$this->input->post('operationMVPLeafletResection');
                $patientinformationClass->operationMVPOthers=$this->input->post('operationMVPOthers');
                $patientinformationClass->Operation_MitralValve_MVR=$this->input->post('Operation_MitralValve_MVR');
                $patientinformationClass->operationMVR=$this->input->post('operationMVR');
                $patientinformationClass->operationMVRMemo=$this->input->post('operationMVRMemo');
                $patientinformationClass->operationTricuspidValve=$this->input->post('operationTricuspidValve');
                $patientinformationClass->operationTVPRing=$this->input->post('operationTVPRing');
                $patientinformationClass->operationTVPArtificialChord=$this->input->post('operationTVPArtificialChord');
                $patientinformationClass->operationTVPAnnularPlication=$this->input->post('operationTVPAnnularPlication');
                $patientinformationClass->operationTVPLeafletResection=$this->input->post('operationTVPLeafletResection');
                $patientinformationClass->operationTVPOthers=$this->input->post('operationTVPOthers');
                $patientinformationClass->operationTVR=$this->input->post('operationTVR');
                $patientinformationClass->Operation_TricuspidValve_TVP=$this->input->post('Operation_TricuspidValve_TVP');
                $patientinformationClass->Operation_TricuspidValve_TVR=$this->input->post('Operation_TricuspidValve_TVR');
                
                $patientinformationClass->operationTricuspidValveMemo=$this->input->post('operationTricuspidValveMemo');
                $patientinformationClass->operationPulmonaryValve=$this->input->post('operationPulmonaryValve');
                $patientinformationClass->Operation_PulmonaryValve_PVP=$this->input->post('Operation_PulmonaryValve_PVP');
                $patientinformationClass->Operation_PulmonaryValve_PVR=$this->input->post('Operation_PulmonaryValve_PVR');
                $patientinformationClass->operationPulmonaryValvePVP=$this->input->post('operationPulmonaryValvePVP');
                $patientinformationClass->operationPulmonaryValvePVR=$this->input->post('operationPulmonaryValvePVR');
                $patientinformationClass->operationPulmonaryValveMemo=$this->input->post('operationPulmonaryValveMemo');
                $patientinformationClass->operationArrythmiaSurgery=$this->input->post('operationArrythmiaSurgery');
                $patientinformationClass->operationMazebiatrialLesion=$this->input->post('operationMazebiatrialLesion');
                $patientinformationClass->operationMazePVIwithLAA=$this->input->post('operationMazePVIwithLAA');
                $patientinformationClass->operationMazePVIwithoutLAA=$this->input->post('operationMazePVIwithoutLAA');
                $patientinformationClass->operationMazeLA=$this->input->post('operationMazeLA');
                $patientinformationClass->operationMazeRA=$this->input->post('operationMazeRA');
                $patientinformationClass->operationMazeOthers=$this->input->post('operationMazeOthers');
                $patientinformationClass->operationMazeEnergySource=$this->input->post('operationMazeEnergySource');
                $patientinformationClass->operationAorticSurgery=$this->input->post('operationAorticSurgery');
                $patientinformationClass->operationDissection=$this->input->post('operationDissection');
                $patientinformationClass->operationAneurysmAscending=$this->input->post('operationAneurysmAscending');
                $patientinformationClass->operationAneurysm=$this->input->post('operationAneurysm');
                $patientinformationClass->operationEtiologyOthers=$this->input->post('operationEtiologyOthers');
                $patientinformationClass->operationEtiologyCardiopulmonarBypass=$this->input->post('operationEtiologyCardiopulmonarBypass');
                $patientinformationClass->operationAorticSurgeryCerebralProtection=$this->input->post('operationAorticSurgeryCerebralProtection');
                $patientinformationClass->operationAorticSurgeryLocation=$this->input->post('operationAorticSurgeryLocation');
                $patientinformationClass->operationAneurysmArch=$this->input->post('operationAneurysmArch');
                $patientinformationClass->operationAneurysmThoracicAorta=$this->input->post('operationAneurysmThoracicAorta');
                $patientinformationClass->operationAneurysmAbdominalAorta=$this->input->post('operationAneurysmAbdominalAorta');
                $patientinformationClass->operationAorticSurgeryMethod=$this->input->post('operationAorticSurgeryMethod');
                $patientinformationClass->operationAorticSurgeryMemo=$this->input->post('operationAorticSurgeryMemo');
                $patientinformationClass->operationMazeMemo=$this->input->post('operationMazeMemo');
                $patientinformationClass->operationHeartTransplantation=$this->input->post('operationHeartTransplantation');
                $patientinformationClass->operationHeartTransplantationOP=$this->input->post('operationHeartTransplantationOP');
                $patientinformationClass->operationHeartTransplantationLVAD=$this->input->post('operationHeartTransplantationLVAD');
                $patientinformationClass->operationHeartTransplantationRVAD=$this->input->post('operationHeartTransplantationRVAD');
                $patientinformationClass->operationHeartTransplantationMemo=$this->input->post('operationHeartTransplantationMemo');
                
                        $patientinformationClass->operationOtherCardiacSurgery=$this->input->post('operationOtherCardiacSurgery');
                        $patientinformationClass->operationOtherCardiacSurgery1=$this->input->post('operationOtherCardiacSurgery1');
                        $patientinformationClass->operationOtherCardiacSurgery2=$this->input->post('operationOtherCardiacSurgery2');
                        $patientinformationClass->operationOtherCardiacSurgery3=$this->input->post('operationOtherCardiacSurgery3');
                        $patientinformationClass->operationOtherCardiacSurgery4=$this->input->post('operationOtherCardiacSurgery4');
                        $patientinformationClass->operationOtherCardiacSurgery5=$this->input->post('operationOtherCardiacSurgery5');
                        $patientinformationClass->operationOtherCardiacSurgery6=$this->input->post('operationOtherCardiacSurgery6');
                        $patientinformationClass->operationOtherCardiacSurgery7=$this->input->post('operationOtherCardiacSurgery7');
                        $patientinformationClass->operationOtherCardiacSurgery8=$this->input->post('operationOtherCardiacSurgery8');
                        $patientinformationClass->operationOtherCardiacSurgery9=$this->input->post('operationOtherCardiacSurgery9');
                        $patientinformationClass->operationOtherCardiacSurgery10=$this->input->post('operationOtherCardiacSurgery10');
                        $patientinformationClass->operationOtherCardiacSurgery11=$this->input->post('operationOtherCardiacSurgery11');
                        $patientinformationClass->operationOtherCardiacSurgeryMemo=$this->input->post('operationOtherCardiacSurgeryMemo');
                        //20161201修改開始
                        $patientinformationClass->patientSurgeon=$this->input->post('patientSurgeon');
                $patientinformationClass->patientSurgeon2=$this->input->post('patientSurgeon2');
                $patientinformationClass->patientSurgeon3=$this->input->post('patientSurgeon3');
                $patientinformationClass->patientSurgeon4=$this->input->post('patientSurgeon4');
                $patientinformationClass->patientReoperation=$this->input->post('patientReoperation');
                $patientinformationClass->patientCongenitalSurgery=$this->input->post('patientCongenitalSurgery');
                 $patientinformationClass->CongenitalDiagnosis1=$this->input->post('CongenitalDiagnosis1')=="0"?"":$this->input->post('CongenitalDiagnosis1');
                $patientinformationClass->CongenitalDiagnosis2=$this->input->post('CongenitalDiagnosis2')=="0"?"":$this->input->post('CongenitalDiagnosis2');
                $patientinformationClass->CongenitalDiagnosis3=$this->input->post('CongenitalDiagnosis3')=="0"?"":$this->input->post('CongenitalDiagnosis3');
                $patientinformationClass->CongenitalDiagnosis4=$this->input->post('CongenitalDiagnosis4')=="0"?"":$this->input->post('CongenitalDiagnosis4');
                $patientinformationClass->CongenitalDiagnosis5=$this->input->post('CongenitalDiagnosis5')=="0"?"":$this->input->post('CongenitalDiagnosis5');
                $patientinformationClass->CongenitalDiagnosis_id1=$this->input->post('CongenitalDiagnosis_id1')=="0"?"":$this->input->post('CongenitalDiagnosis_id1');
                $patientinformationClass->CongenitalDiagnosis_id2=$this->input->post('CongenitalDiagnosis_id2')=="0"?"":$this->input->post('CongenitalDiagnosis_id2');
                $patientinformationClass->CongenitalDiagnosis_id3=$this->input->post('CongenitalDiagnosis_id3')=="0"?"":$this->input->post('CongenitalDiagnosis_id3');
                $patientinformationClass->CongenitalDiagnosis_id4=$this->input->post('CongenitalDiagnosis_id4')=="0"?"":$this->input->post('CongenitalDiagnosis_id4');
                $patientinformationClass->CongenitalDiagnosis_id5=$this->input->post('CongenitalDiagnosis_id5')=="0"?"":$this->input->post('CongenitalDiagnosis_id5');
                $patientinformationClass->CongenitalDiagnosisOthers=$this->input->post('CongenitalDiagnosisOthers')=="0"?"":$this->input->post('CongenitalDiagnosisOthers');
                $patientinformationClass->CongenitalProcedure1=$this->input->post('CongenitalProcedure1')=="0"?"":$this->input->post('CongenitalProcedure1');
                $patientinformationClass->CongenitalProcedure2=$this->input->post('CongenitalProcedure2')=="0"?"":$this->input->post('CongenitalProcedure2');
                $patientinformationClass->CongenitalProcedure3=$this->input->post('CongenitalProcedure3')=="0"?"":$this->input->post('CongenitalProcedure3');
                $patientinformationClass->CongenitalProcedure4=$this->input->post('CongenitalProcedure4')=="0"?"":$this->input->post('CongenitalProcedure4');
                $patientinformationClass->CongenitalProcedure5=$this->input->post('CongenitalProcedure5')=="0"?"":$this->input->post('CongenitalProcedure5');
                $patientinformationClass->CongenitalProcedure_id1=$this->input->post('CongenitalProcedure_id1')=="0"?"":$this->input->post('CongenitalDiagnosis1');
                $patientinformationClass->CongenitalProcedure_id2=$this->input->post('CongenitalProcedure_id2')=="0"?"":$this->input->post('CongenitalDiagnosis1');
                $patientinformationClass->CongenitalProcedure_id3=$this->input->post('CongenitalProcedure_id3')=="0"?"":$this->input->post('CongenitalDiagnosis1');
                $patientinformationClass->CongenitalProcedure_id4=$this->input->post('CongenitalProcedure_id4')=="0"?"":$this->input->post('CongenitalProcedure_id4');
                $patientinformationClass->CongenitalProcedure_id5=$this->input->post('CongenitalProcedure_id5')=="0"?"":$this->input->post('CongenitalProcedure_id5');
                $patientinformationClass->CongenitalProcedureOthers=$this->input->post('CongenitalProcedureOthers')=="0"?"":$this->input->post('CongenitalProcedureOthers');
                $patientinformationClass->operationCongenitalBypass=$this->input->post('operationCongenitalBypass');
                $patientinformationClass->operationCongenitalBypassCPBTime=$this->input->post('operationCongenitalBypassCPBTime');
                $patientinformationClass->operationCongenitalBypassAorticTime=$this->input->post('operationCongenitalBypassAorticTime');
                $patientinformationClass->operationCongenitalBypassCirculatoryTime=$this->input->post('operationCongenitalBypassCirculatoryTime');
                $patientinformationClass->operationCongenitalBypassCardioplegia=$this->input->post('operationCongenitalBypassCardioplegia');
                $patientinformationClass->operationCongenitalBypassRACHS=$this->input->post('operationCongenitalBypassRACHS');
                $patientinformationClass->operationCongenitalBypassSTS=$this->input->post('operationCongenitalBypassSTS');
                $patientinformationClass->operationCongenitalBypassMemo=$this->input->post('operationCongenitalBypassMemo')=="0"?"":$this->input->post('operationCongenitalBypassMemo');
                $patientinformationClass->patientSyntaxScore=$this->input->post('patientSyntaxScore')=="0"?"":$this->input->post('patientSyntaxScore');
                $patientinformationClass->associationCategory2006=$this->input->post('associationCategory2006');
                $patientinformationClass->associationCategory2009=$this->input->post('associationCategory2009');
                $this->PatientInformation_Model->Update_patient($pid, $patientinformationClass);
                   echo "<br/>修改病人資料:".$this->input->post('patientName');
                       
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
                       //$patientinformationClass->patientSurgeon=$this->input->post('patientSurgeon');
                       //$patientinformationClass->patientSurgeon2=$this->input->post('patientSurgeon2');
                       //$patientinformationClass->patientSurgeon3=$this->input->post('patientSurgeon3');
                       //$patientinformationClass->patientSurgeon4=$this->input->post('patientSurgeon4');
                        $patientinformationClass->patientOpDate=$this->input->post('patientOpDate');
                $patientinformationClass->patientDischargeDate=$this->input->post('patientDischargeDate');
                $patientinformationClass->patientOpenHeartSurgery=$this->input->post('patientOpenHeartSurgery');
                $patientinformationClass->patientCongenitalSurgery=$this->input->post('patientCongenitalSurgery');
                $patientinformationClass->patientNonOpenHeart=$this->input->post('patientNonOpenHeart');
                $patientinformationClass->patientDiagnosis=$this->input->post('patientDiagnosis');
                $patientinformationClass->patientAssociatedDisease=$this->input->post('patientAssociatedDisease')=="0"?"":$this->input->post('patientAssociatedDisease');
                $patientinformationClass->euroScoreII=$this->input->post('euroScoreII');
                $patientinformationClass->CcrberforOperation=$this->input->post('CcrberforOperation');
                $patientinformationClass->pastHistoryRenalImpairment=$this->input->post('pastHistoryRenalImpairment');
                $patientinformationClass->patientBodyWeight=$this->input->post('patientBodyWeight');
                $patientinformationClass->patientSerumCreatinine=$this->input->post('patientSerumCreatinine');
                $patientinformationClass->CcrberforOperation=$this->input->post('CcrberforOperation');
                $patientinformationClass->pastHistoryExtracardiacArteriopathy=$this->input->post('pastHistoryExtracardiacArteriopathy');
                        $patientinformationClass->pastHistoryPoorMobility=$this->input->post('pastHistoryPoorMobility');
                $patientinformationClass->pastHistoryPreviousCardiacSurgery=$this->input->post('pastHistoryPreviousCardiacSurgery');
                $patientinformationClass->pastHistoryChronicLungDisease=$this->input->post('pastHistoryChronicLungDisease');
                $patientinformationClass->pastHistoryDiabetesOnInsulin=$this->input->post('pastHistoryDiabetesOnInsulin');
                $patientinformationClass->pastHistoryActiveEndocarditis=$this->input->post('pastHistoryActiveEndocarditis');
                $patientinformationClass->pastHistoryCriticalPreoperativeState=$this->input->post('pastHistoryCriticalPreoperativeState');
                        $patientinformationClass->pastHistoryNYHA=$this->input->post('pastHistoryNYHA');
                $patientinformationClass->pastHistoryCCSClass4Angina=$this->input->post('pastHistoryCCSClass4Angina');
                $patientinformationClass->pastHistoryLVFunction=$this->input->post('pastHistoryLVFunction');
                $patientinformationClass->pastHistoryRecentMI=$this->input->post('pastHistoryRecentMI');
                $patientinformationClass->pastHistoryUrgency=$this->input->post('pastHistoryUrgency');
                $patientinformationClass->pastHistoryWeightOfTheIntervention=$this->input->post('pastHistoryWeightOfTheIntervention');
                $patientinformationClass->pastHistoryPulmonaryHypertension=$this->input->post('pastHistoryPulmonaryHypertension');
                $patientinformationClass->pastHistorySurgeryThoracicAorta=$this->input->post('pastHistorySurgeryThoracicAorta');
                $patientinformationClass->outcomeCheck1=$this->input->post('outcomeCheck1');
                $patientinformationClass->outcomeData1=$this->input->post('outcomeData1');
                $patientinformationClass->outcomeCheck2=$this->input->post('outcomeCheck2');
                $patientinformationClass->outcomeData2=$this->input->post('outcomeData2');
                $patientinformationClass->outcomeCheck3=$this->input->post('outcomeCheck3');
                $patientinformationClass->outcomeData3=$this->input->post('outcomeData3');
                $patientinformationClass->outcomeCheck4=$this->input->post('outcomeCheck4');
                $patientinformationClass->outcomeData4=$this->input->post('outcomeData4');
                $patientinformationClass->outcomeCheck5=$this->input->post('outcomeCheck5');
                $patientinformationClass->outcomeData5=$this->input->post('outcomeData5');
                $patientinformationClass->outcomeCheck6=$this->input->post('outcomeCheck6');
                $patientinformationClass->outcomeData6=$this->input->post('outcomeData6');
                $patientinformationClass->outcomeCheck7=$this->input->post('outcomeCheck7');
                $patientinformationClass->outcomeData7=$this->input->post('outcomeData7');
                $patientinformationClass->outcomeCheck8=$this->input->post('outcomeCheck8');
                $patientinformationClass->outcomeData8=$this->input->post('outcomeData8');
                $patientinformationClass->outcomeCheck9=$this->input->post('outcomeCheck9');
                $patientinformationClass->outcomeData9=$this->input->post('outcomeData9');
                $patientinformationClass->outcomeCheck10=$this->input->post('outcomeCheck10');
                $patientinformationClass->outcomeData10=$this->input->post('outcomeData10');
                
                 $patientinformationClass->patientDischargeDate=$this->input->post('patientDischargeDate');
                $patientinformationClass->outcomeExtubationDate=$this->input->post('outcomeExtubationDate');
                $patientinformationClass->outcomeStatus=$this->input->post('outcomeStatus');
                $patientinformationClass->outcomeChildComplication1=$this->input->post('outcomeChildComplication1');
                $patientinformationClass->outcomeChildComplication2=$this->input->post('outcomeChildComplication2');
                $patientinformationClass->outcomeChildComplication3=$this->input->post('outcomeChildComplication3');
                $patientinformationClass->outcomeChildComplication4=$this->input->post('outcomeChildComplication4');
                $patientinformationClass->outcomeChildComplication5=$this->input->post('outcomeChildComplication5');
                $patientinformationClass->outcomeChildComplication6=$this->input->post('outcomeChildComplication6');
                $patientinformationClass->outcomeChildComplication7=$this->input->post('outcomeChildComplication7');
                $patientinformationClass->outcomeChildComplication8=$this->input->post('outcomeChildComplication8');
                $patientinformationClass->outcomeChildComplication9=$this->input->post('outcomeChildComplication9');
                $patientinformationClass->outcomeChildComplication10=$this->input->post('outcomeChildComplication10');
                $patientinformationClass->outcomeChildComplication11=$this->input->post('outcomeChildComplication11');
                $patientinformationClass->outcomeChildComplication12=$this->input->post('outcomeChildComplication12');
                $patientinformationClass->outcomeChildComplication13=$this->input->post('outcomeChildComplication13');
                $patientinformationClass->outcomeChildComplication14=$this->input->post('outcomeChildComplication14');
                $patientinformationClass->outcomeChildComplication15=$this->input->post('outcomeChildComplication15');
                $patientinformationClass->outcomeChildComplication16=$this->input->post('outcomeChildComplication16');
                $patientinformationClass->outcomeChildComplication17=$this->input->post('outcomeChildComplication17');
                $patientinformationClass->outcomeChildComplication18=$this->input->post('outcomeChildComplication18');
                $patientinformationClass->outcomeChildComplication19=$this->input->post('outcomeChildComplication19');
                $patientinformationClass->outcomeChildComplication20=$this->input->post('outcomeChildComplication20');
                $patientinformationClass->outcomeChildComplication21=$this->input->post('outcomeChildComplication21');
                $patientinformationClass->outcomeChildComplication22=$this->input->post('outcomeChildComplication22');
                $patientinformationClass->outcomeChildComplication23=$this->input->post('outcomeChildComplication23');
                $patientinformationClass->outcomeChildComplication24=$this->input->post('outcomeChildComplication24');
                $patientinformationClass->outcomeChildComplication25=$this->input->post('outcomeChildComplication25');
                $patientinformationClass->outcomeChildComplication26=$this->input->post('outcomeChildComplication26');
                $patientinformationClass->outcomeChildComplication27=$this->input->post('outcomeChildComplication27');
                $patientinformationClass->outcomeChildComplication28=$this->input->post('outcomeChildComplication28');
                $patientinformationClass->outcomeChildComplication29=$this->input->post('outcomeChildComplication29');
                $patientinformationClass->outcomeChildComplication30=$this->input->post('outcomeChildComplication30');
                $patientinformationClass->outcomeChildComplication31=$this->input->post('outcomeChildComplication31');
                $patientinformationClass->outcomeChildComplication32=$this->input->post('outcomeChildComplication32');
                $patientinformationClass->outcomeChildComplication33=$this->input->post('outcomeChildComplication33');
                $patientinformationClass->outcomeChildComplication34=$this->input->post('outcomeChildComplication34');
                $patientinformationClass->outcomeChildComplication35=$this->input->post('outcomeChildComplication35');
                $patientinformationClass->outcomeChildComplication36=$this->input->post('outcomeChildComplication36');
                $patientinformationClass->outcomeChildCauseofDeath=$this->input->post('outcomeChildCauseofDeath');
                $patientinformationClass->operationAssociateCategory=$this->input->post('operationAssociateCategory');
                 $patientinformationClass->AdultDiagnosis1=$this->input->post('AdultDiagnosis1');
                 $patientinformationClass->AdultDiagnosis2=$this->input->post('AdultDiagnosis2');
                 $patientinformationClass->AdultDiagnosis3=$this->input->post('AdultDiagnosis3');
                 $patientinformationClass->AdultDiagnosis4=$this->input->post('AdultDiagnosis4');
                 $patientinformationClass->AdultDiagnosis5=$this->input->post('AdultDiagnosis5');
                 $patientinformationClass->AdultDiagnosis_id1=$this->input->post('AdultDiagnosis_id1');
                 $patientinformationClass->AdultDiagnosis_id2=$this->input->post('AdultDiagnosis_id2');
                 $patientinformationClass->AdultDiagnosis_id3=$this->input->post('AdultDiagnosis_id3');
                 $patientinformationClass->AdultDiagnosis_id4=$this->input->post('AdultDiagnosis_id4');
                 $patientinformationClass->AdultDiagnosis_id5=$this->input->post('AdultDiagnosis_id5');
                 $patientinformationClass->AdultDiagnosisOthers=$this->input->post('AdultDiagnosisOthers');
                 
                $patientinformationClass->operationCABG=$this->input->post('operationCABG');
                $patientinformationClass->operationLIMA=$this->input->post('operationLIMA');
                $patientinformationClass->operationRIMA=$this->input->post('operationRIMA');
                $patientinformationClass->operationRIMA_RadialA=$this->input->post('operationRIMA_RadialA');
                $patientinformationClass->operationRIMA_GEA=$this->input->post('operationRIMA_GEA');
                $patientinformationClass->operationVeinGraft=$this->input->post('operationVeinGraft');
                $patientinformationClass->operationCardiopulmonaryBypass=$this->input->post('operationCardiopulmonaryBypass');
                $patientinformationClass->operationCardiacArrest=$this->input->post('operationCardiacArrest');
                $patientinformationClass->operationCABGMemo=$this->input->post('operationCABGMemo');
                $patientinformationClass->operationAorticValve=$this->input->post('operationAorticValve');
                $patientinformationClass->operationAorticValve_AVP=$this->input->post('operationAorticValve_AVP');
                $patientinformationClass->operationAorticValve_AVR=$this->input->post('operationAorticValve_AVR');
                $patientinformationClass->operationAVP=$this->input->post('operationAVP');
                $patientinformationClass->operationMitralValveBentall=$this->input->post('operationMitralValveBentall');
                $patientinformationClass->operationAVRSelect=$this->input->post('operationAVRSelect');
                $patientinformationClass->operationAorticMemo=$this->input->post('operationAorticMemo');
                $patientinformationClass->operationMitralValve=$this->input->post('operationMitralValve');
                $patientinformationClass->Operation_MitralValve_MVP=$this->input->post('Operation_MitralValve_MVP');
                $patientinformationClass->operationMVPRing=$this->input->post('operationMVPRing');
                $patientinformationClass->operationMVPArtificialChord=$this->input->post('operationMVPArtificialChord');
                $patientinformationClass->operationMVPAnnularPlication=$this->input->post('operationMVPAnnularPlication');
                $patientinformationClass->operationMVPLeafletResection=$this->input->post('operationMVPLeafletResection');
                $patientinformationClass->operationMVPOthers=$this->input->post('operationMVPOthers');
                $patientinformationClass->Operation_MitralValve_MVR=$this->input->post('Operation_MitralValve_MVR');
                $patientinformationClass->operationMVR=$this->input->post('operationMVR');
                $patientinformationClass->operationMVRMemo=$this->input->post('operationMVRMemo');
                $patientinformationClass->operationTricuspidValve=$this->input->post('operationTricuspidValve');
                $patientinformationClass->operationTVPRing=$this->input->post('operationTVPRing');
                $patientinformationClass->operationTVPArtificialChord=$this->input->post('operationTVPArtificialChord');
                $patientinformationClass->operationTVPAnnularPlication=$this->input->post('operationTVPAnnularPlication');
                $patientinformationClass->operationTVPLeafletResection=$this->input->post('operationTVPLeafletResection');
                $patientinformationClass->operationTVPOthers=$this->input->post('operationTVPOthers');
                $patientinformationClass->operationTVR=$this->input->post('operationTVR');
                $patientinformationClass->Operation_TricuspidValve_TVP=$this->input->post('Operation_TricuspidValve_TVP');
                $patientinformationClass->Operation_TricuspidValve_TVR=$this->input->post('Operation_TricuspidValve_TVR');
                
                $patientinformationClass->operationTricuspidValveMemo=$this->input->post('operationTricuspidValveMemo');
                $patientinformationClass->operationPulmonaryValve=$this->input->post('operationPulmonaryValve');
                $patientinformationClass->Operation_PulmonaryValve_PVP=$this->input->post('Operation_PulmonaryValve_PVP');
                $patientinformationClass->Operation_PulmonaryValve_PVR=$this->input->post('Operation_PulmonaryValve_PVR');
                $patientinformationClass->operationPulmonaryValvePVP=$this->input->post('operationPulmonaryValvePVP');
                $patientinformationClass->operationPulmonaryValvePVR=$this->input->post('operationPulmonaryValvePVR');
                $patientinformationClass->operationPulmonaryValveMemo=$this->input->post('operationPulmonaryValveMemo');
                $patientinformationClass->operationArrythmiaSurgery=$this->input->post('operationArrythmiaSurgery');
                $patientinformationClass->operationMazebiatrialLesion=$this->input->post('operationMazebiatrialLesion');
                $patientinformationClass->operationMazePVIwithLAA=$this->input->post('operationMazePVIwithLAA');
                $patientinformationClass->operationMazePVIwithoutLAA=$this->input->post('operationMazePVIwithoutLAA');
                $patientinformationClass->operationMazeLA=$this->input->post('operationMazeLA');
                $patientinformationClass->operationMazeRA=$this->input->post('operationMazeRA');
                $patientinformationClass->operationMazeOthers=$this->input->post('operationMazeOthers');
                $patientinformationClass->operationMazeEnergySource=$this->input->post('operationMazeEnergySource');
                $patientinformationClass->operationAorticSurgery=$this->input->post('operationAorticSurgery');
                $patientinformationClass->operationDissection=$this->input->post('operationDissection');
                $patientinformationClass->operationAneurysmAscending=$this->input->post('operationAneurysmAscending');
                $patientinformationClass->operationAneurysm=$this->input->post('operationAneurysm');
                $patientinformationClass->operationEtiologyOthers=$this->input->post('operationEtiologyOthers');
                $patientinformationClass->operationEtiologyCardiopulmonarBypass=$this->input->post('operationEtiologyCardiopulmonarBypass');
                $patientinformationClass->operationAorticSurgeryCerebralProtection=$this->input->post('operationAorticSurgeryCerebralProtection');
                $patientinformationClass->operationAorticSurgeryLocation=$this->input->post('operationAorticSurgeryLocation');
                $patientinformationClass->operationAneurysmArch=$this->input->post('operationAneurysmArch');
                $patientinformationClass->operationAneurysmThoracicAorta=$this->input->post('operationAneurysmThoracicAorta');
                $patientinformationClass->operationAneurysmAbdominalAorta=$this->input->post('operationAneurysmAbdominalAorta');
                $patientinformationClass->operationAorticSurgeryMethod=$this->input->post('operationAorticSurgeryMethod');
                $patientinformationClass->operationAorticSurgeryMemo=$this->input->post('operationAorticSurgeryMemo');
                $patientinformationClass->operationMazeMemo=$this->input->post('operationMazeMemo');
                $patientinformationClass->operationHeartTransplantation=$this->input->post('operationHeartTransplantation');
                $patientinformationClass->operationHeartTransplantationOP=$this->input->post('operationHeartTransplantationOP');
                $patientinformationClass->operationHeartTransplantationLVAD=$this->input->post('operationHeartTransplantationLVAD');
                $patientinformationClass->operationHeartTransplantationRVAD=$this->input->post('operationHeartTransplantationRVAD');
                $patientinformationClass->operationHeartTransplantationMemo=$this->input->post('operationHeartTransplantationMemo');
                
                        $patientinformationClass->operationOtherCardiacSurgery=$this->input->post('operationOtherCardiacSurgery');
                        $patientinformationClass->operationOtherCardiacSurgery1=$this->input->post('operationHeartTransplantationMemo');
                        $patientinformationClass->operationOtherCardiacSurgery2=$this->input->post('operationHeartTransplantationMemo');
                        $patientinformationClass->operationOtherCardiacSurgery3=$this->input->post('operationHeartTransplantationMemo');
                        $patientinformationClass->operationOtherCardiacSurgery4=$this->input->post('operationHeartTransplantationMemo');
                        $patientinformationClass->operationOtherCardiacSurgery5=$this->input->post('operationHeartTransplantationMemo');
                        $patientinformationClass->operationOtherCardiacSurgery6=$this->input->post('operationHeartTransplantationMemo');
                        $patientinformationClass->operationOtherCardiacSurgery7=$this->input->post('operationHeartTransplantationMemo');
                        $patientinformationClass->operationOtherCardiacSurgery8=$this->input->post('operationHeartTransplantationMemo');
                        $patientinformationClass->operationOtherCardiacSurgery9=$this->input->post('operationHeartTransplantationMemo');
                        $patientinformationClass->operationOtherCardiacSurgery10=$this->input->post('operationHeartTransplantationMemo');
                        $patientinformationClass->operationOtherCardiacSurgery11=$this->input->post('operationHeartTransplantationMemo');
                        $patientinformationClass->operationOtherCardiacSurgeryMemo=$this->input->post('operationOtherCardiacSurgeryMemo');
                        
                        //20161201修改開始
                        $patientinformationClass->patientSurgeon=$this->input->post('patientSurgeon');
                $patientinformationClass->patientSurgeon2=$this->input->post('patientSurgeon2');
                $patientinformationClass->patientSurgeon3=$this->input->post('patientSurgeon3');
                $patientinformationClass->patientSurgeon4=$this->input->post('patientSurgeon4');
                $patientinformationClass->patientReoperation=$this->input->post('patientReoperation');
                $patientinformationClass->patientCongenitalSurgery=$this->input->post('patientCongenitalSurgery');
                  $patientinformationClass->CongenitalDiagnosis1=$this->input->post('CongenitalDiagnosis1')=="0"?"":$this->input->post('CongenitalDiagnosis1');
                $patientinformationClass->CongenitalDiagnosis2=$this->input->post('CongenitalDiagnosis2')=="0"?"":$this->input->post('CongenitalDiagnosis2');
                $patientinformationClass->CongenitalDiagnosis3=$this->input->post('CongenitalDiagnosis3')=="0"?"":$this->input->post('CongenitalDiagnosis3');
                $patientinformationClass->CongenitalDiagnosis4=$this->input->post('CongenitalDiagnosis4')=="0"?"":$this->input->post('CongenitalDiagnosis4');
                $patientinformationClass->CongenitalDiagnosis5=$this->input->post('CongenitalDiagnosis5')=="0"?"":$this->input->post('CongenitalDiagnosis5');
                $patientinformationClass->CongenitalDiagnosis_id1=$this->input->post('CongenitalDiagnosis_id1')=="0"?"":$this->input->post('CongenitalDiagnosis_id1');
                $patientinformationClass->CongenitalDiagnosis_id2=$this->input->post('CongenitalDiagnosis_id2')=="0"?"":$this->input->post('CongenitalDiagnosis_id2');
                $patientinformationClass->CongenitalDiagnosis_id3=$this->input->post('CongenitalDiagnosis_id3')=="0"?"":$this->input->post('CongenitalDiagnosis_id3');
                $patientinformationClass->CongenitalDiagnosis_id4=$this->input->post('CongenitalDiagnosis_id4')=="0"?"":$this->input->post('CongenitalDiagnosis_id4');
                $patientinformationClass->CongenitalDiagnosis_id5=$this->input->post('CongenitalDiagnosis_id5')=="0"?"":$this->input->post('CongenitalDiagnosis_id5');
                $patientinformationClass->CongenitalDiagnosisOthers=$this->input->post('CongenitalDiagnosisOthers')=="0"?"":$this->input->post('CongenitalDiagnosisOthers');
                $patientinformationClass->CongenitalProcedure1=$this->input->post('CongenitalProcedure1')=="0"?"":$this->input->post('CongenitalProcedure1');
                $patientinformationClass->CongenitalProcedure2=$this->input->post('CongenitalProcedure2')=="0"?"":$this->input->post('CongenitalProcedure2');
                $patientinformationClass->CongenitalProcedure3=$this->input->post('CongenitalProcedure3')=="0"?"":$this->input->post('CongenitalProcedure3');
                $patientinformationClass->CongenitalProcedure4=$this->input->post('CongenitalProcedure4')=="0"?"":$this->input->post('CongenitalProcedure4');
                $patientinformationClass->CongenitalProcedure5=$this->input->post('CongenitalProcedure5')=="0"?"":$this->input->post('CongenitalProcedure5');
                $patientinformationClass->CongenitalProcedure_id1=$this->input->post('CongenitalProcedure_id1')=="0"?"":$this->input->post('CongenitalDiagnosis1');
                $patientinformationClass->CongenitalProcedure_id2=$this->input->post('CongenitalProcedure_id2')=="0"?"":$this->input->post('CongenitalDiagnosis1');
                $patientinformationClass->CongenitalProcedure_id3=$this->input->post('CongenitalProcedure_id3')=="0"?"":$this->input->post('CongenitalDiagnosis1');
                $patientinformationClass->CongenitalProcedure_id4=$this->input->post('CongenitalProcedure_id4')=="0"?"":$this->input->post('CongenitalProcedure_id4');
                $patientinformationClass->CongenitalProcedure_id5=$this->input->post('CongenitalProcedure_id5')=="0"?"":$this->input->post('CongenitalProcedure_id5');
                $patientinformationClass->CongenitalProcedureOthers=$this->input->post('CongenitalProcedureOthers')=="0"?"":$this->input->post('CongenitalProcedureOthers');
                        $patientinformationClass->operationCongenitalBypass=$this->input->post('operationCongenitalBypass');
                $patientinformationClass->operationCongenitalBypassCPBTime=$this->input->post('operationCongenitalBypassCPBTime');
                $patientinformationClass->operationCongenitalBypassAorticTime=$this->input->post('operationCongenitalBypassAorticTime');
                $patientinformationClass->operationCongenitalBypassCirculatoryTime=$this->input->post('operationCongenitalBypassCirculatoryTime');
                $patientinformationClass->operationCongenitalBypassCardioplegia=$this->input->post('operationCongenitalBypassCardioplegia');
                $patientinformationClass->operationCongenitalBypassRACHS=$this->input->post('operationCongenitalBypassRACHS');
                $patientinformationClass->operationCongenitalBypassSTS=$this->input->post('operationCongenitalBypassSTS');
                $patientinformationClass->operationCongenitalBypassMemo=$this->input->post('operationCongenitalBypassMemo')=="0"?"":$this->input->post('operationCongenitalBypassMemo');
                $patientinformationClass->patientHospitalUUID=$this->input->post('patientHospitalUUID');
                $patientinformationClass->patientSyntaxScore=$this->input->post('patientSyntaxScore')=="0"?"":$this->input->post('patientSyntaxScore');
                $patientinformationClass->associationCategory2006=$this->input->post('associationCategory2006');
                 $patientinformationClass->isDeleted=$this->input->post('isDeleted');
               echo "<br/><b>新增病人資料:".$this->input->post('patientName')."</b>";
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
                $nonopenheartClass->patientHospital=$this->input->post('patientHospital');
            
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
                $nonopenheartClass->patientHospital=$this->input->post('patientHospital');
               
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