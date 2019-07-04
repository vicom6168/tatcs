<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Evaluation extends CI_Controller {

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
        if($this->session->userdata('userID')=="")
        redirect(base_url().'homenew', 'refresh');
         
        $this->load->model('Analysis_Model');
        $this->load->model('user_Model');
        $this->load->helper('form');
    }
    
public function index($qryField="0",$qryOrder="0",$qryStr='999999999',$page=0)
    {
         $this->load->library('session');
        if($this->session->userdata('userID')=="" )
        redirect(base_url().'homenew', 'refresh');
        
         if($qryStr=="" || $qryStr=="Keyword" )
                          $qryStr="";
        $data['result_msg']='';
        //$this->load->view('home/home',$data);
         $this->load->model('Evaluation_Model');
      $this->load->model('Parameter_Model');
      //  $column = $this->PatientInformation_Model->query_patientlist();
        $config['per_page'] = 20; 
        $data['patientList']=$this->Evaluation_Model->query_patientlist($qryField,$qryOrder,urldecode($qryStr),$page,$config['per_page']);
        $config['total_rows'] = $this->Evaluation_Model->query_patientlist($qryField,$qryOrder,urldecode($qryStr),0,0)->num_rows() ;
        $config['base_url'] = base_url().'evaluation/index/'.$qryField.'/'.$qryOrder.'/'.$qryStr;
        $config['num_links'] = 2;
        $config['uri_segment'] = 6;
        $config['first_link'] = 'Fisrt';
        $config['first_tag_open'] = '';
        $config['first_tag_close'] = '';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = ' ';
        $config['last_tag_close'] = '';
        $config['full_tag_open'] = '<div class="dataTables_paginate">';
        $config['full_tag_close'] = '</div>';
    
        $this->load->library('pagination');
        $this->pagination->initialize($config); 
        //foreach ($result as $key => $value)
        //      $result->$key=str_replace("00:00:00","",str_replace("0000-00-00","",$value));

        $data['Pagination_str']=$this->pagination->create_links();
    
        
       // $data['patientList']= $data['query'];
            $data['page']="evaluation";    
        $data['path']="<li>術前評估</li><li  class='break'>&#187;</li><li>病患資料列表</li>";
        $data['qStr']=$qryStr=="999999999"?"":urldecode($qryStr);
        $data['qField']=$qryField;
        $data['qOrder']=$qryOrder;
        $this->load->view('evaluation/query',$data);
    }
   
 function viewRecord($pid){
         $this->load->library('session');
        if($this->session->userdata('userID')=="" )
        redirect(base_url().'homenew', 'refresh');
        
        $data['page']="evaluation";   
        $data['msg']="";  
        $data['path']="<li>術前評估</li><li  class='break'>&#187;</li><li>病患資料</li>";
        $this->load->model('Evaluation_Model'); 
       
        if($pid!='')
        $column = $this->Evaluation_Model->viewRecord($pid);
        $data['myContent']=$column;  
        $this->load->model('Parameter_Model');  
        $Bacteria= $this->Parameter_Model->query_BacteriaList();
        $data['BacteriaList']=$Bacteria;    
        $vsList = $this->Parameter_Model->query_vsList();
        $data['vsList']=$vsList;  
        $this->load->view('evaluation/content',$data);
    }
 function patientProfiles(){
        $this->load->library('session');
     
        if($this->session->userdata('userID')=="" )
             redirect(base_url().'homenew', 'refresh');
           
        $this->load->model('Evaluation_Model');
        
        $patientID=$this->input->post('patientID');
        
        $this->load->library('evaluationClass');
        
               // $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                $patientinformationClass= new evaluationClass;
                $patientinformationClass = $this->Evaluation_Model->viewRecord($patientID)->row();
                $patientinformationClass->patientID=$patientID;
                $patientinformationClass->patientHospital=$this->input->post('patientHospital');
                $patientinformationClass->patientSSN=$this->input->post('patientSSN');
                $patientinformationClass->patientChartNumber=$this->input->post('patientChartNumber');
                $patientinformationClass->patientName=$this->input->post('patientName');
                $patientinformationClass->patientBirthday=$this->input->post('patientBirthday');
                $patientinformationClass->patientAge=$this->input->post('patientAge');
                $patientinformationClass->patientAgeUnit=$this->input->post('patientAgeUnit');
                $patientinformationClass->patientGender=$this->input->post('patientGender')==null?"":$this->input->post('patientGender');
                $patientinformationClass->patientOpDate=$this->input->post('patientOpDate');
                $patientinformationClass->patientSurgeon=$this->input->post('patientSurgeon');
                $patientinformationClass->patientDischargeDate=$this->input->post('patientDischargeDate');
                $patientinformationClass->patientOpenHeartSurgery=$this->input->post('patientOpenHeartSurgery')=="0"?"N":"Y";
                $patientinformationClass->patientCongenitalSurgery=$this->input->post('patientCongenitalSurgery')=="0"?"N":"Y";
                $patientinformationClass->patientNonOpenHeart=$this->input->post('patientNonOpenHeart')=="0"?"N":"Y";
                $patientinformationClass->patientDiagnosis=$this->input->post('patientDiagnosis');
                $patientinformationClass->patientAssociatedDisease=$this->input->post('patientAssociatedDisease');
                $patientinformationClass->pastHistoryRenalImpairment=$this->input->post('pastHistoryRenalImpairment');
                $patientinformationClass->patientBodyWeight=$this->input->post('patientBodyWeight');
                $patientinformationClass->patientSerumCreatinine=$this->input->post('patientSerumCreatinine');
                $patientinformationClass->CcrberforOperation=$this->input->post('CcrberforOperation');
                $patientinformationClass->pastHistoryExtracardiacArteriopathy=$this->input->post('pastHistoryExtracardiacArteriopathy')==null?"":$this->input->post('pastHistoryExtracardiacArteriopathy');
                        $patientinformationClass->pastHistoryPoorMobility=$this->input->post('pastHistoryPoorMobility')==null?"":$this->input->post('pastHistoryExtracardiacArteriopathy');
                $patientinformationClass->pastHistoryPreviousCardiacSurgery=$this->input->post('pastHistoryPreviousCardiacSurgery')==null?"":$this->input->post('pastHistoryPreviousCardiacSurgery');
                $patientinformationClass->pastHistoryChronicLungDisease=$this->input->post('pastHistoryChronicLungDisease')==null?"":$this->input->post('pastHistoryChronicLungDisease');
                $patientinformationClass->pastHistoryDiabetesOnInsulin=$this->input->post('pastHistoryDiabetesOnInsulin')==null?"":$this->input->post('pastHistoryDiabetesOnInsulin');
                $patientinformationClass->pastHistoryActiveEndocarditis=$this->input->post('pastHistoryActiveEndocarditis')==null?"":$this->input->post('pastHistoryActiveEndocarditis');
                $patientinformationClass->pastHistoryCriticalPreoperativeState=$this->input->post('pastHistoryCriticalPreoperativeState')==null?"":$this->input->post('pastHistoryCriticalPreoperativeState');
                        $patientinformationClass->pastHistoryNYHA=$this->input->post('pastHistoryNYHA');
                $patientinformationClass->pastHistoryCCSClass4Angina=$this->input->post('pastHistoryCCSClass4Angina')==null?"":$this->input->post('pastHistoryCCSClass4Angina');
                $patientinformationClass->pastHistoryLVFunction=$this->input->post('pastHistoryLVFunction');
                $patientinformationClass->pastHistoryRecentMI=$this->input->post('pastHistoryRecentMI')==null?"":$this->input->post('pastHistoryRecentMI');
                $patientinformationClass->pastHistoryUrgency=$this->input->post('pastHistoryUrgency');
                $patientinformationClass->pastHistoryWeightOfTheIntervention=$this->input->post('pastHistoryWeightOfTheIntervention');
                $patientinformationClass->pastHistoryPulmonaryHypertension=$this->input->post('pastHistoryPulmonaryHypertension');
                $patientinformationClass->pastHistorySurgeryThoracicAorta=$this->input->post('pastHistorySurgeryThoracicAorta')==null?"":$this->input->post('pastHistorySurgeryThoracicAorta');
                $patientinformationClass->euroScoreII=$this->input->post('euroScoreII');
                $patientinformationClass->modifyPerson=$this->session->userdata('userID');
                $patientinformationClass->modifyTime=date('Y-m-d H:i:s');
                 if($this->input->post('patientSurgeon')!=""){
                        $surgeon=$this->user_Model->queryUserbyRealname(urldecode($this->input->post('patientSurgeon')));
                if($surgeon->num_rows() ==1){
                              $patientinformationClass->patientSurgeon_id=$surgeon->row()->userID;
                    $patientinformationClass->patientSurgeon_associalid=$surgeon->row()->associateID;
                     }
                          }
                $this->Evaluation_Model->Update_patient($patientID, $patientinformationClass);
                accessLog('U','EVALUATION',$patientID,$this->session->userdata('userRealname').'修改術前評估資料(病歷號:'.$patientinformationClass->patientChartNumber.')','S');
             
                //$this->calEuroScore($patientinformationClass);
                  
                $data['page']="divPatientProfiles";  
                $data['msg']="Patient Profiles Saved";    
                  $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
                    $column = $this->Evaluation_Model->viewRecord($patientID);
                 $data['myContent']=$column;  
                 $this->load->model('Parameter_Model'); 
        $Bacteria= $this->Parameter_Model->query_BacteriaList();
        $data['BacteriaList']=$Bacteria;    
        $vsList = $this->Parameter_Model->query_vsList();
        $data['vsList']=$vsList;  
                 $this->load->view('evaluation/content',$data);
  }
  function patientEuroscore(){
        $this->load->library('session');
        if($this->session->userdata('userID')=="" )
             redirect(base_url().'homenew', 'refresh');
           
        $this->load->model('Evaluation_Model');
        
        $patientID=$this->input->post('patientID');
        
        $this->load->library('patientinformationClass');
        
               // $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                $patientinformationClass= new patientinformationClass;
                $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                $patientinformationClass->patientID=$patientID;
                $patientinformationClass->pastHistoryRenalImpairment=$this->input->post('pastHistoryRenalImpairment');
                $patientinformationClass->patientBodyWeight=$this->input->post('patientBodyWeight');
                $patientinformationClass->patientSerumCreatinine=$this->input->post('patientSerumCreatinine');
                $patientinformationClass->CcrberforOperation=$this->input->post('CcrberforOperation');
                $patientinformationClass->pastHistoryExtracardiacArteriopathy=$this->input->post('pastHistoryExtracardiacArteriopathy')==null?"":$this->input->post('pastHistoryExtracardiacArteriopathy');
                        $patientinformationClass->pastHistoryPoorMobility=$this->input->post('pastHistoryPoorMobility')==null?"":$this->input->post('pastHistoryExtracardiacArteriopathy');
                $patientinformationClass->pastHistoryPreviousCardiacSurgery=$this->input->post('pastHistoryPreviousCardiacSurgery')==null?"":$this->input->post('pastHistoryPreviousCardiacSurgery');
                $patientinformationClass->pastHistoryChronicLungDisease=$this->input->post('pastHistoryChronicLungDisease')==null?"":$this->input->post('pastHistoryChronicLungDisease');
                $patientinformationClass->pastHistoryDiabetesOnInsulin=$this->input->post('pastHistoryDiabetesOnInsulin')==null?"":$this->input->post('pastHistoryDiabetesOnInsulin');
                $patientinformationClass->pastHistoryActiveEndocarditis=$this->input->post('pastHistoryActiveEndocarditis')==null?"":$this->input->post('pastHistoryActiveEndocarditis');
                $patientinformationClass->pastHistoryCriticalPreoperativeState=$this->input->post('pastHistoryCriticalPreoperativeState')==null?"":$this->input->post('pastHistoryCriticalPreoperativeState');
                        $patientinformationClass->pastHistoryNYHA=$this->input->post('pastHistoryNYHA');
                $patientinformationClass->pastHistoryCCSClass4Angina=$this->input->post('pastHistoryCCSClass4Angina')==null?"":$this->input->post('pastHistoryCCSClass4Angina');
                $patientinformationClass->pastHistoryLVFunction=$this->input->post('pastHistoryLVFunction');
                $patientinformationClass->pastHistoryRecentMI=$this->input->post('pastHistoryRecentMI')==null?"":$this->input->post('pastHistoryRecentMI');
                $patientinformationClass->pastHistoryUrgency=$this->input->post('pastHistoryUrgency');
                $patientinformationClass->pastHistoryWeightOfTheIntervention=$this->input->post('pastHistoryWeightOfTheIntervention');
                $patientinformationClass->pastHistoryPulmonaryHypertension=$this->input->post('pastHistoryPulmonaryHypertension');
                $patientinformationClass->pastHistorySurgeryThoracicAorta=$this->input->post('pastHistorySurgeryThoracicAorta')==null?"":$this->input->post('pastHistorySurgeryThoracicAorta');
                $patientinformationClass->euroScoreII=$this->input->post('euroScoreII');
                
                $this->PatientInformation_Model->Update_patient($patientID, $patientinformationClass);
               $this->calEuroScore($patientinformationClass);
                //   $data['page']="divPastHistory";   
                $data['page']="evaluation";  
                   $data['msg']="EuroScore II Saved";   
                  $data['path']="<li>術前評估</li><li  class='break'>&#187;</li>";
                    $column = $this->PatientInformation_Model->viewRecord($patientID);
                 $data['myContent']=$column;    
                   $this->load->model('Parameter_Model'); 
        $Bacteria= $this->Parameter_Model->query_BacteriaList();
        $data['BacteriaList']=$Bacteria;  
         $vsList = $this->Parameter_Model->query_vsList();
        $data['vsList']=$vsList;   
                 $this->load->view('evaluation/content',$data);
  }
    function addPatient(){
        $this->load->library('session');
        if($this->session->userdata('userID')=="" )
             redirect(base_url().'homenew', 'refresh');
           
        $this->load->model('PatientInformation_Model');
        $this->load->model('Parameter_Model');
        $vsList = $this->Parameter_Model->query_vsList();
        $data['vsList']=$vsList;  
        $data['page']="evaluation";    
        $data['path']="<li>術前評估</li><li  class='break'>&#187; 新增病患</li>";
        $this->load->view('evaluation/addPatient',$data);
  }
   function savePatient(){
       $this->load->library('session');
        if($this->session->userdata('userID')=="" )
             redirect(base_url().'homenew', 'refresh');
           
        $this->load->model('Evaluation_Model');
        
        
        $this->load->library('evaluationClass');
        
               // $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                $patientinformationClass= new evaluationClass;
                $patientinformationClass->patientSSN=$this->input->post('patientSSN');
                $patientinformationClass->patientChartNumber=$this->input->post('patientChartNumber');
                $patientinformationClass->patientHospital=$this->input->post('patientHospital');
                $patientinformationClass->patientName=$this->input->post('patientName');
                $patientinformationClass->patientBirthday=$this->input->post('patientBirthday');
                $patientinformationClass->patientAge=$this->input->post('patientAge');
                $patientinformationClass->patientAgeUnit=$this->input->post('patientAgeUnit');
                $patientinformationClass->patientGender=$this->input->post('patientGender')==null?"":$this->input->post('patientGender');
                $patientinformationClass->patientSurgeon=$this->input->post('patientSurgeon');
               
                $patientinformationClass->patientOpDate=$this->input->post('patientOpDate');
                $patientinformationClass->patientDischargeDate=$this->input->post('patientDischargeDate');
            
                $patientinformationClass->pastHistoryRenalImpairment=$this->input->post('pastHistoryRenalImpairment');
                $patientinformationClass->patientBodyWeight=$this->input->post('patientBodyWeight');
                $patientinformationClass->patientSerumCreatinine=$this->input->post('patientSerumCreatinine');
                $patientinformationClass->CcrberforOperation=$this->input->post('CcrberforOperation');
                $patientinformationClass->pastHistoryExtracardiacArteriopathy=$this->input->post('pastHistoryExtracardiacArteriopathy')==null?"":$this->input->post('pastHistoryExtracardiacArteriopathy');
                        $patientinformationClass->pastHistoryPoorMobility=$this->input->post('pastHistoryPoorMobility')==null?"":$this->input->post('pastHistoryExtracardiacArteriopathy');
                $patientinformationClass->pastHistoryPreviousCardiacSurgery=$this->input->post('pastHistoryPreviousCardiacSurgery')==null?"":$this->input->post('pastHistoryPreviousCardiacSurgery');
                $patientinformationClass->pastHistoryChronicLungDisease=$this->input->post('pastHistoryChronicLungDisease')==null?"":$this->input->post('pastHistoryChronicLungDisease');
                $patientinformationClass->pastHistoryDiabetesOnInsulin=$this->input->post('pastHistoryDiabetesOnInsulin')==null?"":$this->input->post('pastHistoryDiabetesOnInsulin');
                $patientinformationClass->pastHistoryActiveEndocarditis=$this->input->post('pastHistoryActiveEndocarditis')==null?"":$this->input->post('pastHistoryActiveEndocarditis');
                $patientinformationClass->pastHistoryCriticalPreoperativeState=$this->input->post('pastHistoryCriticalPreoperativeState')==null?"":$this->input->post('pastHistoryCriticalPreoperativeState');
                        $patientinformationClass->pastHistoryNYHA=$this->input->post('pastHistoryNYHA');
                $patientinformationClass->pastHistoryCCSClass4Angina=$this->input->post('pastHistoryCCSClass4Angina')==null?"":$this->input->post('pastHistoryCCSClass4Angina');
                $patientinformationClass->pastHistoryLVFunction=$this->input->post('pastHistoryLVFunction');
                $patientinformationClass->pastHistoryRecentMI=$this->input->post('pastHistoryRecentMI')==null?"":$this->input->post('pastHistoryRecentMI');
                $patientinformationClass->pastHistoryUrgency=$this->input->post('pastHistoryUrgency');
                $patientinformationClass->pastHistoryWeightOfTheIntervention=$this->input->post('pastHistoryWeightOfTheIntervention');
                $patientinformationClass->pastHistoryPulmonaryHypertension=$this->input->post('pastHistoryPulmonaryHypertension');
                $patientinformationClass->pastHistorySurgeryThoracicAorta=$this->input->post('pastHistorySurgeryThoracicAorta')==null?"":$this->input->post('pastHistorySurgeryThoracicAorta');
                $patientinformationClass->euroScoreII=$this->input->post('euroScoreII');
                $patientinformationClass->isDeleted="N";
                $patientinformationClass->isSaved="0";
                $patientinformationClass->createPerson=$this->session->userdata('userID');
                $patientinformationClass->createTime=date('Y-m-d H:i:s');
                 if($this->input->post('patientSurgeon')!=""){
                        $surgeon=$this->user_Model->queryUserbyRealname(urldecode($this->input->post('patientSurgeon')));
                if($surgeon->num_rows() ==1){
                              $patientinformationClass->patientSurgeon_id=$surgeon->row()->userID;
                    $patientinformationClass->patientSurgeon_associalid=$surgeon->row()->associateID;
                     }
                          }
                $insert_id=$this->Evaluation_Model->Save_patient($patientinformationClass);
                accessLog('A','EVALUATION',$insert_id,$this->session->userdata('userRealname').'新增術前評估資料(病歷號:'.$patientinformationClass->patientChartNumber.')','S');
             
                redirect(base_url().'evaluation/viewRecord/'.$insert_id, 'refresh');
                 
   }

public function deleteRecord($pid){
       // $this->load->library('session');
       // if($this->session->userdata('userID')=="" )
       // redirect(base_url().'homenew', 'refresh');
         $this->load->model('Evaluation_Model'); 
        if($pid!='')
        $column = $this->Evaluation_Model->deleteRecord($pid);

        redirect(base_url().'evaluation', 'refresh');
    }


        public function evaluationTrans(){
           $patientID=$this->input->post('patientID');
        $patientOPdate=$this->input->post('patientOPdate');
       
       $this->load->model('Evaluation_Model');
        $this->load->model('PatientInformation_Model');
        
        
        $this->load->library('evaluationClass');
          $this->load->library('patientinformationClass');
               // $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                $patientinformationClass= new patientinformationClass;
          $e= new evaluationClass;
          $p= new patientinformationClass;
           $e= $this->Evaluation_Model->viewRecord($patientID);
           if($e->num_rows() ==1) {
                $p= $this->PatientInformation_Model->selectEvaluation($e->row()->patientChartNumber, $patientOPdate);
         if ($p->num_rows() ==0)
            {
               $p=  $e->row();
               $p->patientID=null;
               $e->row()->isSaved='1';
            // $this->Evaluation_Model->Update_patient($patientID, $e->row());
                          
             $p->createPerson=$this->session->userdata('userID');
             $p->createTime=date('Y-m-d H:i:s');
             $insert_id=$this->PatientInformation_Model->Save_patient($p);
             $insert_id=accessLog('T','PATIENT',$insert_id,$this->session->userdata('userRealname').'由術前評估轉入病患資料(病歷號:'.$p->patientChartNumber.')','S');
             
             $p->patientID=null;
             $p->isSaved=$insert_id;
             $p->SyntaxScoreDominance='0';
             $this->PatientInformation_Model->Save_patienthistory($p);
             $this->Evaluation_Model->transferCompleted($patientID);
            $arr=array('status'=>'success','result'=>$p);
                } else {
                    $arr=array('status'=>'fail','result'=>'1');
         }
             echo json_encode($arr);  
           } else {
               $arr=array('status'=>'fail','result'=>'2');
               echo json_encode($arr); 
           } 
 }
     
  function calEuroScore($row)
    {
            $this->load->model('Evaluation_Model');
          
       
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
      $patientAge=(intval($row->patientAge)+1)*0.0285181;
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

//alert(result);
$result = $result-5.324537;
//alert(result);
$result=exp($result) / (1 + exp($result));
//alert(result);
$result = round(100 * $result,2) ;

               $patient= $this->Evaluation_Model->insert_euro($result,$row->patientID);
         }
  
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */