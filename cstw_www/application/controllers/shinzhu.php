<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shinzhu  extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
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
       // if($this->session->userdata('bookingID')=="" || $this->session->userdata('isAdmin')=="")
      //  redirect(base_url().'home/home', 'refresh');
         
        $this->load->model('user_Model');
        $this->load->model('PatientInformation_Model');
        $this->load->model('Shinzhu_Model');
        $this->load->helper('form');
    }
    
	public function index()
	{
	   
	       $SurgeonList=$this->Shinzhu_Model->query_shinZhuList();
         
        foreach($SurgeonList->result() as $row){
                  echo $row->Index."<br/>";
                 $this->load->library('patientinformationClass');
            
                $patientinformationClass= new patientinformationClass;
                $patientinformationClass->patientHospital='台大醫院新竹分院';
                $patientinformationClass->patientSSN=$row->Index;
                $patientinformationClass->patientChartNumber=trim($row->ID_no_portal);
                $patientinformationClass->patientName=trim($row->Name);
                $patientinformationClass->patientBirthday=$row->Birth;
                $patientinformationClass->patientAge=$row->Age;
                $patientinformationClass->patientAgeUnit='';
                $patientinformationClass->patientGender=$row->Sex=='.2196434'?"F":'M';
                $patientinformationClass->patientSurgeon=$row->Surgeon;
                $patientinformationClass->AdultDiagnosisOthers=$row->Post_dx.chr(0x0D).chr(0x0A).$row->Asso_Dz;
                        if($row->Creat=="0")
                        $patientinformationClass->pastHistoryRenalImpairment="1";
                        elseif($row->Creat==".303553")
                        $patientinformationClass->pastHistoryRenalImpairment="2";
                         elseif($row->Creat==".8592256")
                        $patientinformationClass->pastHistoryRenalImpairment="3";
                          elseif($row->Creat==".6421508")
                        $patientinformationClass->pastHistoryRenalImpairment="4";
                          
                           if($row->Arterio=="0")
                        $patientinformationClass->pastHistoryExtracardiacArteriopathy="N";
                  else //      elseif($row->Arterio==".5360268")
                        $patientinformationClass->pastHistoryExtracardiacArteriopathy="Y";
                        
                             if($row->Neuro=="0")
                        $patientinformationClass->pastHistoryPoorMobility="N";
                   else //     elseif($row->Neuro==".2407181")
                        $patientinformationClass->pastHistoryPoorMobility="Y";
                        
                              if($row->Redux=="0")
                        $patientinformationClass->pastHistoryPreviousCardiacSurgery="N";
                  else //      elseif($row->Redux=="1.118599")
                        $patientinformationClass->pastHistoryPreviousCardiacSurgery="Y";
                        
                         if($row->Copd=="0")
                        $patientinformationClass->pastHistoryChronicLungDisease="N";
                  else //      elseif($row->Copd==".1886564")
                        $patientinformationClass->pastHistoryChronicLungDisease="Y";
                        
                            if($row->Endo=="0")
                        $patientinformationClass->pastHistoryActiveEndocarditis="N";
                 else //       elseif($row->Endo=="0.6194522")
                        $patientinformationClass->pastHistoryActiveEndocarditis="Y";
                        
                          if($row->Critic=="0")
                        $patientinformationClass->pastHistoryCriticalPreoperativeState="N";
                 else //       elseif($row->Critic=="1.086517")
                        $patientinformationClass->pastHistoryCriticalPreoperativeState="Y";
                        
                             if($row->Newtest=="0")
                        $patientinformationClass->pastHistoryDiabetesOnInsulin="N";
                  else //      elseif($row->Newtest==".3542749")
                        $patientinformationClass->pastHistoryDiabetesOnInsulin="Y";
                        
                        if($row->Septum=="0")
                        $patientinformationClass->pastHistoryNYHA="1";
                        elseif($row->Septum==".1070545")
                        $patientinformationClass->pastHistoryNYHA="2";
                         elseif($row->Septum==".2958358")
                        $patientinformationClass->pastHistoryNYHA="3";
                          elseif($row->Septum==".5597929")
                        $patientinformationClass->pastHistoryNYHA="4";
                        
                        if($row->Angor=="0")
                        $patientinformationClass->pastHistoryCCSClass4Angina="N";
                 else //       elseif($row->Angor==".2226147")
                        $patientinformationClass->pastHistoryCCSClass4Angina="Y";
                        
                        if($row->Lvef=="0")
                        $patientinformationClass->pastHistoryLVFunction="1";
                        elseif($row->Lvef==".3150652")
                        $patientinformationClass->pastHistoryLVFunction="2";
                         elseif($row->Lvef==".8084096")
                        $patientinformationClass->pastHistoryLVFunction="3";
                          elseif($row->Lvef==".9346919")
                        $patientinformationClass->pastHistoryLVFunction="4";
                        
                                if($row->idm=="0")
                        $patientinformationClass->pastHistoryRecentMI="N";
                 else //       elseif($row->idm==".1528943")
                        $patientinformationClass->pastHistoryRecentMI="Y";
                        
                           if($row->pap=="0")
                        $patientinformationClass->pastHistoryPulmonaryHypertension="1";
                        elseif($row->pap==".1788899")
                        $patientinformationClass->pastHistoryPulmonaryHypertension="2";
                         elseif($row->pap==".3491475")
                        $patientinformationClass->pastHistoryPulmonaryHypertension="3";
                         
                          if($row->Urg=="0")
                        $patientinformationClass->pastHistoryUrgency="1";
                        elseif($row->Urg==".3174673")
                        $patientinformationClass->pastHistoryUrgency="2";
                         elseif($row->Urg==".7039121")
                        $patientinformationClass->pastHistoryUrgency="3";
                          elseif($row->Urg=="1.362947")
                        $patientinformationClass->pastHistoryUrgency="4";
                          
                            if($row->Autre=="0")
                        $patientinformationClass->pastHistoryWeightOfTheIntervention="1";
                        elseif($row->Autre==".0062118")
                        $patientinformationClass->pastHistoryWeightOfTheIntervention="2";
                         elseif($row->Autre==".5521478")
                        $patientinformationClass->pastHistoryWeightOfTheIntervention="3";
                          elseif($row->Autre==".9724533")
                        $patientinformationClass->pastHistoryWeightOfTheIntervention="4";
                          
                            if($row->Tho=="0")
                        $patientinformationClass->pastHistorySurgeryThoracicAorta="N";
else //       elseif($row->Tho==".6527205   ")
                        $patientinformationClass->pastHistorySurgeryThoracicAorta="Y";
                        
                        $patientinformationClass->euroScoreII=$row->Euroscore;
                        
                          if($row->Post_death=="0")
                        $patientinformationClass->outcomeStatus="";
                        elseif($row->Post_death=="1")
                        $patientinformationClass->outcomeStatus="4: 死亡";
                        
                        $patientinformationClass->patientDischargeDate=$row->Post_death_date;
                        
                         if($row->Post_wound_type=="2")
                        $patientinformationClass->outcomeCheck5="Y";
                         if($row->Post_hos30=="1")
                        $patientinformationClass->outcomeCheck10="Y";
                        if($row->Post_dialysis=="1")
                        $patientinformationClass->outcomeCheck3="Y";
                         if($row->Post_stroke=="1")
                        $patientinformationClass->outcomeCheck2="Y";
                          if($row->Post_venti30=="1")
                        $patientinformationClass->outcomeCheck4="Y";
                          
                            if($row->CABG_yes=="1")
                        $patientinformationClass->operationCABG="Y";
                            $patientinformationClass->operationLIMA=$row->LIMA;
                            $patientinformationClass->operationRIMA=$row->RIMA;
                            $patientinformationClass->operationRIMA_RadialA=$row->Vein_graft;
                         if($row->CABG_bypass=="1")
                        $patientinformationClass->operationCardiopulmonaryBypass="Y";
                         if($row->CABG_arrest=="1")
                        $patientinformationClass->operationCardiacArrest="Y";
                         if($row->AV_yes=="1")
                        $patientinformationClass->operationAorticValve="Y";
                         
                         if($row->AVR=="2")
                        $patientinformationClass->operationMVR="Bioprosthetic valve";
                         elseif($row->AVR=="1")
                        $patientinformationClass->operationMVR="Mechanical valve";
                         
                          if($row->MV_yes=="1")
                        $patientinformationClass->operationMitralValve="Y";
                          
                           if(strpos($row->MVP, '1') !== false)
                        $patientinformationClass->operationMVPRing="Y";
                           if(strpos($row->MVP, '2') !== false)
                        $patientinformationClass->operationMVPArtificialChord="Y";
                            if(strpos($row->MVP, '3') !== false)
                        $patientinformationClass->operationMVPAnnularPlication="Y";
                          
                         if($row->MVR=="2")
                        $patientinformationClass->operationMVR="Bioprosthetic valve";
                         elseif($row->MVR=="1")
                        $patientinformationClass->operationMVR="Mechanical valve";
                            
                              if($row->TV_yes=="1")
                        $patientinformationClass->operationTricuspidValve="Y";
                              
                              if(strpos($row->TVP, '1') !== false)
                        $patientinformationClass->operationTVPRing="Y";
                           if(strpos($row->TVP, '2') !== false)
                        $patientinformationClass->operationTVPArtificialChord="Y";
                            if(strpos($row->TVP, '3') !== false)
                        $patientinformationClass->operationTVPAnnularPlication="Y";
                            
                    if($row->TVR=="2")
                        $patientinformationClass->operationMVR="Bioprosthetic valve";
                         elseif($row->TVR=="1")
                        $patientinformationClass->operationMVR="Mechanical valve";
                         
                          if($row->Arr_yes=="1")
                        $patientinformationClass->operationArrythmiaSurgery="Y";
                          
                            if($row->Maze_area=="3")
                        $patientinformationClass->operationMazeOthers="Y";
                         elseif($row->Maze_area=="2")
                        $patientinformationClass->operationMazeOthers="Y";
                         elseif($row->Maze_area=="1")
                        $patientinformationClass->operationMazeLA="Y";
                         elseif($row->Maze_area=="1/2")
                        $patientinformationClass->operationMazebiatrialLesion="Y";
                         
                          if($row->Ao_yes=="1")
                        $patientinformationClass->operationAorticSurgery="Y";
                        
                        
                           if(strpos($row->Ao_surg, '1') !== false)
                        $patientinformationClass->operationDissection="Y";
                           if(strpos($row->Ao_surg, '2') !== false)
                        $patientinformationClass->operationAneurysm="Y";
                            
                            if($row->Ao_location== '1')
                        $patientinformationClass->operationAorticSurgeryLocation="ascending";
                           if($row->Ao_location== '2')
                        $patientinformationClass->operationAorticSurgeryLocation="arch";
                            if($row->Ao_location== '3')
                        $patientinformationClass->operationAorticSurgeryLocation="thoracic aorta";
                           
                             
                             
                               if(strpos($row->Ao_method, '1'))
                        $patientinformationClass->operationAorticSurgeryMethod="Open grafting";
                             
                             if($row->Hx_yes=="1")
                        $patientinformationClass->operationHeartTransplantationOP="Y";
                             
                             
                              if($row->Cardiac_tu!="")
                        $patientinformationClass->operationOtherCardiacSurgery4="Y";
                           
                        $patientinformationClass->operationAorticSurgeryMemo=$row->Ao_remark;
                         if($row->AVP!="")
                        $patientinformationClass->operationAorticValve="Y";
                       //$patientinformationClass->patientSurgeon3=$this->input->post('patientSurgeon3');
                       //$patientinformationClass->patientSurgeon4=$this->input->post('patientSurgeon4');
                        $patientinformationClass->patientOpDate=$row->OP_date;
                $this->PatientInformation_Model->Save_patient($patientinformationClass);
                
                  
                 
           }
	}
      
   
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */