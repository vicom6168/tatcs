<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calc extends CI_Controller {

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
        if($this->session->userdata('userID')=="")
        redirect(base_url().'home', 'refresh');
         
        $this->load->model('Analysis_Model');
        $this->load->helper('form');
    }
    
    public function index()
    {
            $this->load->model('PatientInformation_Model');
     
        $patient= $this->PatientInformation_Model->query_agelist(0,0) ;
         foreach($patient->result() as $row){
               if($row->ageDate<31){
                   $patient= $this->PatientInformation_Model->insert_age($row->ageDate,'3',$row->patientID);
               } else if($row->ageDate<365) {
                   $patient= $this->PatientInformation_Model->insert_age(round($row->ageDate/30.5,1),'2',$row->patientID);
               } else {
                   $patient= $this->PatientInformation_Model->insert_age(round($row->ageDate/365.25,1),'1',$row->patientID);
               }
         }
     }
        public function calEuroScore()
    {
            $this->load->model('PatientInformation_Model');
          
        $patient= $this->PatientInformation_Model->query_agelist(0,0) ;
         foreach($patient->result() as $row){
              $result=0;
             
               if($row->patientGender=="M"){
                                 $result+=0;
               } else {
                                $result+=0.2196434;
               }
       if($row->pastHistoryRenalImpairment=="1"){
          $result+=0;
     } else if($row->pastHistoryRenalImpairment=="2"){
          $result+=0.303553;
     } else if($row->pastHistoryRenalImpairment=="3"){
          $result+=0.8592256;
     }else if($row->pastHistoryRenalImpairment=="4"){
          $result+=0.6421508;
     }
       if($row->pastHistoryExtracardiacArteriopathy=="Y"){
          $result+=0.5360268;
     }
       if($row->pastHistoryPoorMobility=="Y"){
         $result+=0.2407181;
     }        
       if($row->pastHistoryPreviousCardiacSurgery=="Y"){
         $result+=1.118599;
     }
       if($row->pastHistoryChronicLungDisease=="Y"){
          $result+=0.1886564;
     }
       if($row->pastHistoryActiveEndocarditis=="Y"){
         $result+=0.6194522;
     }
       if($row->pastHistoryCriticalPreoperativeState=="Y"){
         $result+=1.086517;
     }
       if($row->pastHistoryDiabetesOnInsulin=="Y"){
         $result+=0.3542749;
     }
         if($row->pastHistoryNYHA=="1"){
         $result+=0;
     } else if($row->pastHistoryNYHA=="2"){
         $result+=0.1070545;
     } else if($row->pastHistoryNYHA=="3"){
         $result+=0.2958358;
     }else if($row->pastHistoryNYHA=="4"){
         $result+=0.5597929;
     }
     if($row->pastHistoryCCSClass4Angina=="Y"){
         $result+=0.2226147;
     }
      if($row->pastHistoryLVFunction=="1"){
         $result+=0;
     } else if($row->pastHistoryLVFunction=="2"){
         $result+=0.3150652;
     } else if($row->pastHistoryLVFunction=="3"){
         $result+=0.8084096;
     }else if($row->pastHistoryLVFunction=="4"){
         $result+=0.9346919;
     }
     if($row->pastHistoryRecentMI=="Y"){
         $result+=0.1528943;
     }
      if($row->pastHistoryPulmonaryHypertension=="1"){
         $result+=0;
     } else if($row->pastHistoryPulmonaryHypertension=="2"){
         $result+=0.1788899;
     } else if($row->pastHistoryPulmonaryHypertension=="3"){
         $result+=0.3491475;
     }
      if($row->pastHistoryUrgency=="1"){
         $result+=0;
     } else if($row->pastHistoryUrgency=="2"){
         $result+=0.3174673;
     } else if($row->pastHistoryUrgency=="3"){
         $result+=0.7039121;
     }else if($row->pastHistoryUrgency=="4"){
         $result+=1.362947;
     }
      if($row->pastHistoryWeightOfTheIntervention=="1"){
         $result+=0;
     } else if($row->pastHistoryWeightOfTheIntervention=="2"){
         $result+=0.0062118;
     } else if($row->pastHistoryWeightOfTheIntervention=="3"){
         $result+=0.5521478;
     } else if($row->pastHistoryWeightOfTheIntervention=="4"){
         $result+=0.9724533;
     }
     if($row->pastHistorySurgeryThoracicAorta=="Y"){
         $result+=0.6527205;
     }
     if($row->patientAgeUnit=="1"){
      $patientAge=(intval($row->ageDate/365.25)+1)*0.0285181;
     } else {
         $patientAge=0.0285181;
     }
//alert('patientAge'+patientAge);
    if ($patientAge<=1.711086) {
        $patientAge=0.0285181;
        }  else {
            $patientAge = $patientAge-(60*0.0285181);
        }
//form.zage.value= Fmt(t)
//alert('patientAge'+patientAge);
$result+= $patientAge ;
echo $result."<br/>";
//alert(result);
$result = $result-5.324537;
//alert(result);
$result=exp($result) / (1 + exp($result));
//alert(result);
$result = round(100 * $result,2) ;
echo $result."<br/>";
               $patient= $this->PatientInformation_Model->insert_euro($result,$row->patientID);
         }
     }
  public function calLOS()
    {
            $this->load->model('PatientInformation_Model');
          
        $patient= $this->PatientInformation_Model->query_agelist(0,0) ;
         foreach($patient->result() as $row){
              $result=0;
             
               if($row->patientGender=="M"){
                                 $result+=0;
               } else {
                                $result+=0.2196434;
               }
       if($row->pastHistoryRenalImpairment=="1"){
          $result+=0;
     } else if($row->pastHistoryRenalImpairment=="2"){
          $result+=0.303553;
     } else if($row->pastHistoryRenalImpairment=="3"){
          $result+=0.8592256;
     }else if($row->pastHistoryRenalImpairment=="4"){
          $result+=0.6421508;
     }
       if($row->pastHistoryExtracardiacArteriopathy=="Y"){
          $result+=0.5360268;
     }
       if($row->pastHistoryPoorMobility=="Y"){
         $result+=0.2407181;
     }        
       if($row->pastHistoryPreviousCardiacSurgery=="Y"){
         $result+=1.118599;
     }
       if($row->pastHistoryChronicLungDisease=="Y"){
          $result+=0.1886564;
     }
       if($row->pastHistoryActiveEndocarditis=="Y"){
         $result+=0.6194522;
     }
       if($row->pastHistoryCriticalPreoperativeState=="Y"){
         $result+=1.086517;
     }
       if($row->pastHistoryDiabetesOnInsulin=="Y"){
         $result+=0.3542749;
     }
         if($row->pastHistoryNYHA=="1"){
         $result+=0;
     } else if($row->pastHistoryNYHA=="2"){
         $result+=0.1070545;
     } else if($row->pastHistoryNYHA=="3"){
         $result+=0.2958358;
     }else if($row->pastHistoryNYHA=="4"){
         $result+=0.5597929;
     }
     if($row->pastHistoryCCSClass4Angina=="Y"){
         $result+=0.2226147;
     }
      if($row->pastHistoryLVFunction=="1"){
         $result+=0;
     } else if($row->pastHistoryLVFunction=="2"){
         $result+=0.3150652;
     } else if($row->pastHistoryLVFunction=="3"){
         $result+=0.8084096;
     }else if($row->pastHistoryLVFunction=="4"){
         $result+=0.9346919;
     }
     if($row->pastHistoryRecentMI=="Y"){
         $result+=0.1528943;
     }
      if($row->pastHistoryPulmonaryHypertension=="1"){
         $result+=0;
     } else if($row->pastHistoryPulmonaryHypertension=="2"){
         $result+=0.1788899;
     } else if($row->pastHistoryPulmonaryHypertension=="3"){
         $result+=0.3491475;
     }
      if($row->pastHistoryUrgency=="1"){
         $result+=0;
     } else if($row->pastHistoryUrgency=="2"){
         $result+=0.3174673;
     } else if($row->pastHistoryUrgency=="3"){
         $result+=0.7039121;
     }else if($row->pastHistoryUrgency=="4"){
         $result+=1.362947;
     }
      if($row->pastHistoryWeightOfTheIntervention=="1"){
         $result+=0;
     } else if($row->pastHistoryWeightOfTheIntervention=="2"){
         $result+=0.0062118;
     } else if($row->pastHistoryWeightOfTheIntervention=="3"){
         $result+=0.5521478;
     } else if($row->pastHistoryWeightOfTheIntervention=="4"){
         $result+=0.9724533;
     }
     if($row->pastHistorySurgeryThoracicAorta=="Y"){
         $result+=0.6527205;
     }
     if($row->patientAgeUnit=="1"){
      $patientAge=(intval($row->ageDate/365.25)+1)*0.0285181;
     } else {
         $patientAge=0.0285181;
     }
//alert('patientAge'+patientAge);
    if ($patientAge<=1.711086) {
        $patientAge=0.0285181;
        }  else {
            $patientAge = $patientAge-(60*0.0285181);
        }
//form.zage.value= Fmt(t)
//alert('patientAge'+patientAge);
$result+= $patientAge ;
echo $result."<br/>";
//alert(result);
$result = $result-5.324537;
//alert(result);
$result=exp($result) / (1 + exp($result));
//alert(result);
$result = round(100 * $result,2) ;
echo $result."<br/>";
               $patient= $this->PatientInformation_Model->insert_euro($result,$row->patientID);
         }
     }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */