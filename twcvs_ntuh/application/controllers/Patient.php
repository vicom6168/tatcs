<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Patient extends CI_Controller {

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
        
        $this->load->model('user_Model');
        $this->load->helper('form');
    }
    
	public function index($qryField="0",$qryOrder="0",$qryStr='999999999',$page=0)
	{
	     $this->load->library('session');
        if($this->session->userdata('userID')=="")
        redirect(base_url().'homenew', 'refresh');
      if($qryStr=="" || $qryStr=="Keyword" )
           $qryStr="";
	    $data['result_msg']='';
		//$this->load->view('homenew',$data);
		 $this->load->model('PatientInformation_Model');
      $this->load->model('Parameter_Model');
      //  $column = $this->PatientInformation_Model->query_patientlist();
            $config['per_page'] = 20; 
        $data['patientList']=$this->PatientInformation_Model->query_patientlist($qryField,$qryOrder,urldecode($qryStr),$page,$config['per_page']);
        $config['total_rows'] = $this->PatientInformation_Model->query_patientlist($qryField,$qryOrder,urldecode($qryStr),0,0)->num_rows() ;
        $config['base_url'] = base_url().'patient/index/'.$qryField.'/'.$qryOrder.'/'.$qryStr;
        $config['num_links'] = 2;
        $config['uri_segment'] =6;
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
            $data['page']="index";    
        $data['path']="<li>病患資料列表</li>";
        $data['qStr']=$qryStr=="999999999"?"":urldecode($qryStr);
        $data['qField']=$qryField;
        $data['qOrder']=$qryOrder;
        $this->load->view('patient/query',$data);
	}
   
 
   public function uncomplete($qryField="0",$qryOrder="0",$qryCondition="0",$qryStr='999999999',$page=0)
    {
         $this->load->library('session');
        if($this->session->userdata('userID')=="" )
        redirect(base_url().'homenew', 'refresh');
        if($qryStr=="" || $qryStr=="Keyword" )
           $qryStr="";
        $data['result_msg']='';
        //$this->load->view('homenew',$data);
         $this->load->model('PatientInformation_Model');
      $this->load->model('Parameter_Model');
      //  $column = $this->PatientInformation_Model->query_patientlist();
        $config['per_page'] = 20; 
        $data['patientList']=$this->PatientInformation_Model->query_uncompletelist($qryField,$qryOrder,$qryCondition,urldecode($qryStr),$page,$config['per_page']);
        $config['total_rows'] = $this->PatientInformation_Model->query_uncompletelist($qryField,$qryOrder,$qryCondition,urldecode($qryStr),0,0)->num_rows() ;
        $config['base_url'] = base_url().'patient/uncomplete/'.$qryField.'/'.$qryOrder.'/'.$qryCondition.'/'.$qryStr;
        $config['num_links'] = 2;
        $config['uri_segment'] = 7;
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
            $data['page']="uncomplete";    
        $data['path']="<li>未完成病患資料列表</li>";
        $data['qStr']=$qryStr=="999999999"?"":urldecode($qryStr);
        $data['qField']=$qryField;
        $data['qOrder']=$qryOrder;
        $data['qCondition']=$qryCondition;
        $this->load->view('patient/uncomplete',$data);
    }
   
   

 
    public function deleteRecord($pid){
       // $this->load->library('session');
       // if($this->session->userdata('userID')=="" )
       // redirect(base_url().'homenew', 'refresh');
         $this->load->model('PatientInformation_Model'); 
        if($pid!=''){
            $query = $this->PatientInformation_Model->viewRecord($pid);
        $column = $this->PatientInformation_Model->deleteRecord($pid);
        accessLog('D','PATIENT',$query->row()->patientID,$this->session->userdata('userRealname').'刪除病患資料【病歷號碼：'.$query->row()->patientChartNumber.'】','S');
        }
        redirect(base_url().'patient', 'refresh');
    }
    
    function viewRecord($pid,$fromSource='divPatientProfiles'){
         $this->load->library('session');
        if($this->session->userdata('userID')=="" )
        redirect(base_url().'homenew', 'refresh');
        
        $data['page']="index";   
        $data['patientpage']=$fromSource;   
        $data['msg']="";  
        $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
        $this->load->model('PatientInformation_Model'); 
       
        if($pid!='')
            $column = $this->PatientInformation_Model->viewRecord($pid);
        $data['myContent']=$column;  
         //query LVAD count
                     $data['LVADCount'] = $this->PatientInformation_Model->query_LVADCount()->row()->LVADCount;
        //query data permission beginning
            $data['dataPermission']="N";
        $dataOwnerID=$column->row()->patientSurgeon_id;
        $this->load->model('user_Model');
         if($dataOwnerID=="" || $dataOwnerID==$this->session->userdata('userID') || 
                  $this->user_Model->query_user($dataOwnerID)->row()->vsPermission=="1" || 
                  $this->PatientInformation_Model->queryDataOwner($dataOwnerID,$this->session->userdata('userID'))->num_rows() >=1)
                  {
            $data['dataPermission']="Y";
        }
      //query data permission ending
       
        
        
        //Select data History beginning
        $column = $this->PatientInformation_Model->qryPatientHistory($pid);
        $data['dataHistory']=$column;  
        //Select data History end
        $this->load->model('Parameter_Model');  
        
        $vsList = $this->Parameter_Model->query_vsList();
        $data['vsList']=$vsList;  
        $this->load->view('patient/content',$data);
    }
   function syntaxscore($pid){
         $this->load->library('session');
        if($this->session->userdata('userID')=="" )
        redirect(base_url().'homenew', 'refresh');
        
        $data['page']="index";      
        $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
         $this->load->model('PatientInformation_Model'); 
        if($pid!='')
        $column = $this->PatientInformation_Model->viewRecord($pid);
        $data['myContent']=$column;    
         //query LVAD count
                     $data['LVADCount'] = $this->PatientInformation_Model->query_LVADCount()->row()->LVADCount;
        //query data permission beginning
            $data['dataPermission']="N";
        $dataOwnerID=$column->row()->patientSurgeon_id;
        $this->load->model('user_Model');
         if($dataOwnerID=="" || $dataOwnerID==$this->session->userdata('userID') || $this->user_Model->query_user($dataOwnerID)->row()->vsPermission=="1" || $this->PatientInformation_Model->queryDataOwner($dataOwnerID,$this->session->userdata('userID'))->num_rows() >=1){
            $data['dataPermission']="Y";
        }
      //query data permission ending
        $this->load->model('Parameter_Model');
        
        $vsList = $this->Parameter_Model->query_vsList();
        $data['vsList']=$vsList;   
        $this->load->view('patient/syntaxscore',$data);
    }
     function syntaxscore2($pid){
         $this->load->library('session');
        if($this->session->userdata('userID')=="" )
        redirect(base_url().'homenew', 'refresh');
        
        $data['page']="index";   ; 
            $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
         $this->load->model('PatientInformation_Model'); 
        if($pid!='')
        $column = $this->PatientInformation_Model->viewRecord($pid);
        $data['myContent']=$column;    
         //query LVAD count
                     $data['LVADCount'] = $this->PatientInformation_Model->query_LVADCount()->row()->LVADCount;
        //query data permission beginning
            $data['dataPermission']="N";
        $dataOwnerID=$column->row()->patientSurgeon_id;
        $this->load->model('user_Model');
         if($dataOwnerID=="" || $dataOwnerID==$this->session->userdata('userID') || $this->user_Model->query_user($dataOwnerID)->row()->vsPermission=="1" || $this->PatientInformation_Model->queryDataOwner($dataOwnerID,$this->session->userdata('userID'))->num_rows() >=1){
            $data['dataPermission']="Y";
        }
      //query data permission ending
        $this->load->model('Parameter_Model');
          
        $vsList = $this->Parameter_Model->query_vsList();
        $data['vsList']=$vsList;  
        $this->load->view('patient/syntaxscore2',$data);
    }
  function download(){
     $this->load->model('Android_Model'); 
        $data['page']="query";    
        $data['path']="<li>訂床查詢</li>";
       
        $column = $this->Android_Model->download_data();
        $this->load->helper('cvs');
        query_to_csv($column,TRUE, "Result.csv");
  }
  
  function patientProfiles(){
        $this->load->library('session');
        $LOS="";
        if($this->session->userdata('userID')=="" )
             redirect(base_url().'homenew', 'refresh');
           
        $this->load->model('PatientInformation_Model');
        
        $patientID=$this->input->post('patientID');
        
        $this->load->library('patientinformationClass');
      $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'doc|docx|ppt|pptx|xls|xlsx|pdf|txt|gif|jpg|png';
      $config['max_size']   = '300';
  
      $config['file_name']  = "A".time(); 
    //echo $_FILES['abanner']['tmp_name'];
    
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        if (isset($_FILES['agreement']['tmp_name']) && $_FILES['agreement']['tmp_name']!="" && !$this->upload->do_upload("agreement"))
        {
            $error = array('error' => $this->upload->display_errors());
         $data['msg']="學會同意書上傳失敗:".$this->upload->display_errors();
              $data['page']="index";   
              $data['patientpage']="divPatientProfiles"; 
                
           // $data['msg']="Patient Profiles Saved";    
            $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
       //  echo "AAAAAAAAAAAAAA".$this->upload->display_errors();
          
         $column = $this->PatientInformation_Model->viewRecord($patientID);
         $data['myContent']=$column;  
          //query LVAD count
                     $data['LVADCount'] = $this->PatientInformation_Model->query_LVADCount()->row()->LVADCount;
             //Select data History end
            $this->load->model('Parameter_Model'); 
        
        $vsList = $this->Parameter_Model->query_vsList();
        $data['vsList']=$vsList;  
           //query data permission beginning
            $data['dataPermission']="N";
        $dataOwnerID=$column->row()->patientSurgeon_id;
        $this->load->model('user_Model');
         if($dataOwnerID=="" || $dataOwnerID==$this->session->userdata('userID') || $this->user_Model->query_user($dataOwnerID)->row()->vsPermission=="1" || $this->PatientInformation_Model->queryDataOwner($dataOwnerID,$this->session->userdata('userID'))->num_rows() >=1){
            $data['dataPermission']="Y";
        }
      //query data permission ending
      //Select data History beginning
                  $column = $this->PatientInformation_Model->qryPatientHistory($patientID);
            $data['dataHistory']=$column;  
             //Select data History end
         $this->load->view('patient/content',$data);
         exit();
        }
       if(isset($_FILES['agreement']['tmp_name']) && $_FILES['agreement']['tmp_name']!="" ){
             $uploaddata = array('upload_data' => $this->upload->data());
            }
    
    //echo $_FILES['abanner']['tmp_name'];
            $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'doc|docx|ppt|pptx|xls|xlsx|pdf|txt|gif|jpg|png';
      $config['max_size']   = '300';
  
      $config['file_name']  = "H".time(); 
      $this->upload->initialize($config);
          if (isset($_FILES['hospitalagreement']['tmp_name']) && $_FILES['hospitalagreement']['tmp_name']!="" && !$this->upload->do_upload("hospitalagreement"))
        {
            $error = array('error' => $this->upload->display_errors());
         $data['msg']="醫院同意書上傳失敗:".$this->upload->display_errors();
              $data['page']="index";   
              $data['patientpage']="divPatientProfiles"; 
                
           // $data['msg']="Patient Profiles Saved";    
            $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
       //  echo "AAAAAAAAAAAAAA".$this->upload->display_errors();
          
         $column = $this->PatientInformation_Model->viewRecord($patientID);
         $data['myContent']=$column;  
          //query LVAD count
                     $data['LVADCount'] = $this->PatientInformation_Model->query_LVADCount()->row()->LVADCount;
             //Select data History end
            $this->load->model('Parameter_Model'); 
        
        $vsList = $this->Parameter_Model->query_vsList();
        $data['vsList']=$vsList;  
           //query data permission beginning
            $data['dataPermission']="N";
        $dataOwnerID=$column->row()->patientSurgeon_id;
        $this->load->model('user_Model');
         if($dataOwnerID=="" || $dataOwnerID==$this->session->userdata('userID') || $this->user_Model->query_user($dataOwnerID)->row()->vsPermission=="1" || $this->PatientInformation_Model->queryDataOwner($dataOwnerID,$this->session->userdata('userID'))->num_rows() >=1){
            $data['dataPermission']="Y";
        }
      //query data permission ending
      //Select data History beginning
                  $column = $this->PatientInformation_Model->qryPatientHistory($patientID);
            $data['dataHistory']=$column;  
             //Select data History end
         $this->load->view('patient/content',$data);
         exit();
        }
            
            
           
            if(isset($_FILES['hospitalagreement']['tmp_name']) && $_FILES['hospitalagreement']['tmp_name']!="" ){
             $uploaddatahospital = array('upload_data_hospital' => $this->upload->data());
            }
        
               // $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                        $patientinformationClassOrignal= new patientinformationClass;
                $patientinformationClass= new patientinformationClass;
                $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                $patientinformationClassOrignal=$this->PatientInformation_Model->viewRecord($patientID)->row();
                $patientinformationClass->patientID=$patientID;
                $patientinformationClass->patientHospital=$this->input->post('patientHospital');
                $patientinformationClass->patientSSN=$this->input->post('patientSSN');
                $patientinformationClass->patientChartNumber=$this->input->post('patientChartNumber');
                $patientinformationClass->patientName=$this->input->post('patientName');
                $patientinformationClass->patientBirthday=$this->input->post('patientBirthday');
                $patientinformationClass->patientAge=$this->input->post('patientAge');
                $patientinformationClass->patientAgeUnit=$this->input->post('patientAgeUnit');
                $patientinformationClass->patientGender=$this->input->post('patientGender')==null?"":$this->input->post('patientGender');
                       //$patientinformationClass->patientSurgeon=$this->input->post('patientSurgeon');
                       //$patientinformationClass->patientSurgeon2=$this->input->post('patientSurgeon2');
                       //$patientinformationClass->patientSurgeon3=$this->input->post('patientSurgeon3');
                       //$patientinformationClass->patientSurgeon4=$this->input->post('patientSurgeon4');
                        $patientinformationClass->patientOpDate=$this->input->post('patientOpDate');
                $patientinformationClass->patientDischargeDate=$this->input->post('patientDischargeDate');
                $patientinformationClass->patientOpenHeartSurgery=$this->input->post('patientOpenHeartSurgery')=="0"?"N":"Y";
               // $patientinformationClass->patientCongenitalSurgery=$this->input->post('patientCongenitalSurgery')=="0"?"N":"Y";
                $patientinformationClass->patientNonOpenHeart=$this->input->post('patientNonOpenHeart')=="0"?"N":"Y";
                $patientinformationClass->patientDiagnosis=$this->input->post('patientDiagnosis');
                $patientinformationClass->patientAssociatedDisease=$this->input->post('patientAssociatedDisease');
                $LOS=$this->dateDiff($this->input->post('patientOpDate'),$this->input->post('patientDischargeDate'));
                $patientinformationClass->outcomeCheck8=$LOS;
                if($LOS==""){
                                          $patientinformationClass->outcomeCheck9="N";
                            $patientinformationClass->outcomeCheck10="N";
                } else {
                               if($LOS<6){
                                          $patientinformationClass->outcomeCheck9="Y";
                            $patientinformationClass->outcomeCheck10="N";
                        } elseif ($LOS>14){
                                          $patientinformationClass->outcomeCheck9="N";
                            $patientinformationClass->outcomeCheck10="Y";
                        } else {
                                          $patientinformationClass->outcomeCheck9="N";
                            $patientinformationClass->outcomeCheck10="N";
                            
                        }
                                }
                        
                          if(isset($_FILES['agreement']['tmp_name']) && $_FILES['agreement']['tmp_name']!="" ){
                        $patientinformationClass->agreement=$uploaddata['upload_data']['file_name'];
                    }
                              if(isset($_FILES['hospitalagreement']['tmp_name']) && $_FILES['hospitalagreement']['tmp_name']!="" ){
                        $patientinformationClass->hospitalagreement=$uploaddatahospital['upload_data_hospital']['file_name'];
                    }
                $patientinformationClass->euroScoreII=$this->calEuroScore($patientinformationClass);
           $patientinformationClass->CcrberforOperation=$this->calCCRScore($patientinformationClass);
           $this->PatientInformation_Model->Update_patient($patientID, $patientinformationClass);
           $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
           if(comparePatient($patientinformationClassOrignal,$patientinformationClass)=="Y"){
                
           $access_id=accessLog('U','PATIENT',$patientID,$this->session->userdata('userRealname').'修改病患資料【Patient Profiles】(病歷號:'.$patientinformationClass->patientChartNumber.')','S');
           $patientinformationClassOrignal->patientID=null;
           $patientinformationClassOrignal->SyntaxScoreDominance='1';
           $patientinformationClassOrignal->isSaved=$access_id;
           $patientinformationClass->patientID=null;
           $patientinformationClass->SyntaxScoreDominance='2';
           $patientinformationClass->isSaved=$access_id;
           $this->PatientInformation_Model->Save_patienthistory($patientinformationClassOrignal);
           $this->PatientInformation_Model->Save_patienthistory($patientinformationClass);
           
                } 
                 // $this->calEuroScore($patientinformationClass);
                 // $this->calCCRScore($patientinformationClass);
                 $data['page']="index";   
              $data['patientpage']="divPatientProfiles"; 
                
            $data['msg']="Patient Profiles Saved";    
            $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
            $column = $this->PatientInformation_Model->viewRecord($patientID);
            $data['myContent']=$column;  
             //query LVAD count
                     $data['LVADCount'] = $this->PatientInformation_Model->query_LVADCount()->row()->LVADCount;
            //query data permission beginning
            $data['dataPermission']="N";
        $dataOwnerID=$column->row()->patientSurgeon_id;
        $this->load->model('user_Model');
         if($dataOwnerID=="" || $dataOwnerID==$this->session->userdata('userID') || $this->user_Model->query_user($dataOwnerID)->row()->vsPermission=="1" || $this->PatientInformation_Model->queryDataOwner($dataOwnerID,$this->session->userdata('userID'))->num_rows() >=1){
            $data['dataPermission']="Y";
        }
      //query data permission ending
            //Select data History beginning
                  $column = $this->PatientInformation_Model->qryPatientHistory($patientID);
            $data['dataHistory']=$column;  
             //Select data History end
            $this->load->model('Parameter_Model'); 
        
        $vsList = $this->Parameter_Model->query_vsList();
        $data['vsList']=$vsList;  
                 $this->load->view('patient/content',$data);
                 
  }
  function patientEuroscore(){
        $this->load->library('session');
        if($this->session->userdata('userID')=="" )
             redirect(base_url().'homenew', 'refresh');
           
        $this->load->model('PatientInformation_Model');
        
        $patientID=$this->input->post('patientID');
        
        $this->load->library('patientinformationClass');
        
               // $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                $patientinformationClassOrignal= new patientinformationClass;
                $patientinformationClass= new patientinformationClass;
                $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                $patientinformationClassOrignal=$this->PatientInformation_Model->viewRecord($patientID)->row();
                $patientinformationClass->patientID=$patientID;
                $patientinformationClass->pastHistoryRenalImpairment=$this->input->post('pastHistoryRenalImpairment');
                $patientinformationClass->patientBodyWeight=$this->input->post('patientBodyWeight');
                $patientinformationClass->patientSerumCreatinine=$this->input->post('patientSerumCreatinine');
                $patientinformationClass->CcrberforOperation=$this->input->post('CcrberforOperation');
                $patientinformationClass->pastHistoryExtracardiacArteriopathy=$this->input->post('pastHistoryExtracardiacArteriopathy')==null?"":$this->input->post('pastHistoryExtracardiacArteriopathy');
                        $patientinformationClass->pastHistoryPoorMobility=$this->input->post('pastHistoryPoorMobility')==null?"":$this->input->post('pastHistoryPoorMobility');
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
                $patientinformationClass->euroScoreII=$this->calEuroScore($patientinformationClass);
             $this->PatientInformation_Model->Update_patient($patientID, $patientinformationClass);
                $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();            
           if(comparePatient($patientinformationClassOrignal,$patientinformationClass)=="Y"){
                
           $access_id=accessLog('U','PATIENT',$patientID,$this->session->userdata('userRealname').'修改病患資料【EUROSCORE II】(病歷號:'.$patientinformationClass->patientChartNumber.')','S');
           $patientinformationClassOrignal->patientID=null;
           $patientinformationClassOrignal->SyntaxScoreDominance='1';
           $patientinformationClassOrignal->isSaved=$access_id;
           $patientinformationClass->patientID=null;
           $patientinformationClass->SyntaxScoreDominance='2';
           $patientinformationClass->isSaved=$access_id;
           $this->PatientInformation_Model->Save_patienthistory($patientinformationClassOrignal);
           $this->PatientInformation_Model->Save_patienthistory($patientinformationClass);
           
                } 
             //   $this->PatientInformation_Model->Update_patient($patientID, $patientinformationClass);
            //   $this->calEuroScore($patientinformationClass);
                //   $data['page']="divPastHistory";   
                $data['page']="index";   
            $data['patientpage']="divPatientProfiles"; 
                          
                  $data['msg']="EuroScore II Saved";   
                  $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
                  $column = $this->PatientInformation_Model->viewRecord($patientID);
                   $data['myContent']=$column;   
                    //query LVAD count
                     $data['LVADCount'] = $this->PatientInformation_Model->query_LVADCount()->row()->LVADCount;
                   //query data permission beginning
            $data['dataPermission']="N";
        $dataOwnerID=$column->row()->patientSurgeon_id;
        $this->load->model('user_Model');
        if($dataOwnerID=="" || $dataOwnerID==$this->session->userdata('userID') || $this->user_Model->query_user($dataOwnerID)->row()->vsPermission=="1" || $this->PatientInformation_Model->queryDataOwner($dataOwnerID,$this->session->userdata('userID'))->num_rows() >=1){
            $data['dataPermission']="Y";
        }
      //query data permission ending 
                           //Select data History beginning
                           $column = $this->PatientInformation_Model->qryPatientHistory($patientID);
                    $data['dataHistory']=$column;  
                           //Select data History end
                          $this->load->model('Parameter_Model'); 
                       
                      $vsList = $this->Parameter_Model->query_vsList();
                       $data['vsList']=$vsList;   
                 $this->load->view('patient/content',$data);
  }

  function patientOutcome(){
    $this->load->library('session');
        if($this->session->userdata('userID')=="" )
             redirect(base_url().'homenew', 'refresh');
           
        $this->load->model('PatientInformation_Model');
        
        $patientID=$this->input->post('patientID');
        
        $this->load->library('patientinformationClass');
        
               // $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                $patientinformationClass= new patientinformationClass;
                $patientinformationClassOrignal= new patientinformationClass;
                $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                $patientinformationClassOrignal=$this->PatientInformation_Model->viewRecord($patientID)->row();
                $patientinformationClass->patientID=$patientID;
                /*
                $patientinformationClass->outcomeDeath=$this->input->post('outcomeDeath');
                $patientinformationClass->outcomeDeathDate=$this->input->post('outcomeDeathDate');
                $patientinformationClass->outcomeDeathMemo=$this->input->post('outcomeDeathMemo');
                $patientinformationClass->outcomeWoundInfection=$this->input->post('outcomeWoundInfection');
                $patientinformationClass->outcomeWoundInfectionData=$this->input->post('outcomeWoundInfectionData');
                $patientinformationClass->outcomeWoundInfectionMemo=$this->input->post('outcomeWoundInfectionMemo');
                $patientinformationClass->outcomeBacteremia=$this->input->post('outcomeBacteremia');
                $patientinformationClass->outcomeBacteremiaData=$this->input->post('outcomeBacteremiaData');
                $patientinformationClass->outcomeBacteremiaMemo=$this->input->post('outcomeBacteremiaMemo');
                $patientinformationClass->outcomeReentry=$this->input->post('outcomeReentry');
                $patientinformationClass->outcomeReentryMemo=$this->input->post('outcomeReentryMemo');
                $patientinformationClass->outcomeDialysis=$this->input->post('outcomeDialysis');
                $patientinformationClass->outcomeDialysisDate=$this->input->post('outcomeDialysisDate');
                $patientinformationClass->outcomeDialysisMemo=$this->input->post('outcomeDialysisMemo');
                $patientinformationClass->outcomeECMO=$this->input->post('outcomeECMO');
                $patientinformationClass->outcomeECMOData=$this->input->post('outcomeECMOData');
                $patientinformationClass->outcomeECMOMemo=$this->input->post('outcomeECMOMemo');
                $patientinformationClass->outcomeIABP=$this->input->post('outcomeIABP');
                $patientinformationClass->outcomeIABPMemo=$this->input->post('outcomeIABPMemo');
                $patientinformationClass->outcomeStroke=$this->input->post('outcomeStroke');
                $patientinformationClass->outcomeStrokeMemo=$this->input->post('outcomeStrokeMemo');
                $patientinformationClass->outcomeArrthymia=$this->input->post('outcomeArrthymia');
                $patientinformationClass->outcomeArrthymiaData=$this->input->post('outcomeArrthymiaData');
                $patientinformationClass->outcomeArrthymiaMemo=$this->input->post('outcomeArrthymiaMemo');
                */
                $patientinformationClass->outcomeCheck1=$this->input->post('outcomeCheck1')==null?"N":"Y";
                $patientinformationClass->outcomeData1=$this->input->post('outcomeData1');
                $patientinformationClass->outcomeCheck2=$this->input->post('outcomeCheck2')==null?"N":"Y";
                $patientinformationClass->outcomeData2=$this->input->post('outcomeData2');
                $patientinformationClass->outcomeCheck3=$this->input->post('outcomeCheck3')==null?"N":"Y";
                $patientinformationClass->outcomeData3=$this->input->post('outcomeData3');
                $patientinformationClass->outcomeCheck4=$this->input->post('outcomeCheck4')==null?"N":"Y";
                $patientinformationClass->outcomeData4=$this->input->post('outcomeData4');
                $patientinformationClass->outcomeCheck5=$this->input->post('outcomeCheck5')==null?"N":"Y";
                $patientinformationClass->outcomeData5=$this->input->post('outcomeData5');
                $patientinformationClass->outcomeCheck6=$this->input->post('outcomeCheck6')==null?"N":"Y";
                $patientinformationClass->outcomeData6=$this->input->post('outcomeData6');
                $patientinformationClass->outcomeCheck7=$this->input->post('outcomeCheck7')==null?"N":"Y";
                $patientinformationClass->outcomeData7=$this->input->post('outcomeData7');
                $patientinformationClass->outcomeCheck8=$this->input->post('outcomeCheck8');
                $patientinformationClass->outcomeData8=$this->input->post('outcomeData8');
                $patientinformationClass->outcomeCheck9=$this->input->post('outcomeCheck9')==null?"N":"Y";
                $patientinformationClass->outcomeData9=$this->input->post('outcomeData9');
                $patientinformationClass->outcomeCheck10=$this->input->post('outcomeCheck10')==null?"N":"Y";
                $patientinformationClass->outcomeData10=$this->input->post('outcomeData10');
                
                 $patientinformationClass->patientDischargeDate=$this->input->post('patientDischargeDate');
                $patientinformationClass->outcomeExtubationDate=$this->input->post('outcomeExtubationDate');
                $patientinformationClass->patientICUDischargeDate=$this->input->post('patientICUDischargeDate');
                $patientinformationClass->outcomeStatus=$this->input->post('outcomeStatus');
                $patientinformationClass->outcomeChildComplication1=$this->input->post('outcomeChildComplication1')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication2=$this->input->post('outcomeChildComplication2')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication3=$this->input->post('outcomeChildComplication3')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication4=$this->input->post('outcomeChildComplication4')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication5=$this->input->post('outcomeChildComplication5')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication6=$this->input->post('outcomeChildComplication6')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication7=$this->input->post('outcomeChildComplication7')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication8=$this->input->post('outcomeChildComplication8')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication9=$this->input->post('outcomeChildComplication9')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication10=$this->input->post('outcomeChildComplication10')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication11=$this->input->post('outcomeChildComplication11')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication12=$this->input->post('outcomeChildComplication12')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication13=$this->input->post('outcomeChildComplication13')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication14=$this->input->post('outcomeChildComplication14')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication15=$this->input->post('outcomeChildComplication15')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication16=$this->input->post('outcomeChildComplication16')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication17=$this->input->post('outcomeChildComplication17')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication18=$this->input->post('outcomeChildComplication18')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication19=$this->input->post('outcomeChildComplication19')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication20=$this->input->post('outcomeChildComplication20')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication21=$this->input->post('outcomeChildComplication21')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication22=$this->input->post('outcomeChildComplication22')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication23=$this->input->post('outcomeChildComplication23')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication24=$this->input->post('outcomeChildComplication24')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication25=$this->input->post('outcomeChildComplication25')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication26=$this->input->post('outcomeChildComplication26')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication27=$this->input->post('outcomeChildComplication27')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication28=$this->input->post('outcomeChildComplication28')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication29=$this->input->post('outcomeChildComplication29')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication30=$this->input->post('outcomeChildComplication30')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication31=$this->input->post('outcomeChildComplication31')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication32=$this->input->post('outcomeChildComplication32')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication33=$this->input->post('outcomeChildComplication33')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication34=$this->input->post('outcomeChildComplication34')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication35=$this->input->post('outcomeChildComplication35')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication36=$this->input->post('outcomeChildComplication36')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication37=$this->input->post('outcomeChildComplication37')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication38=$this->input->post('outcomeChildComplication38')==null?"N":"Y";
                $patientinformationClass->outcomeChildComplication39=$this->input->post('outcomeChildComplication39')==null?"N":"Y";
                $patientinformationClass->outcomeChildCauseofDeath=$this->input->post('outcomeChildCauseofDeath')==null?"0":$this->input->post('outcomeChildCauseofDeath');
                $this->PatientInformation_Model->Update_patient($patientID, $patientinformationClass);
                 $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                 if(comparePatient($patientinformationClassOrignal,$patientinformationClass)=="Y"){
                             
                   $access_id=accessLog('U','PATIENT',$patientID,$this->session->userdata('userRealname').'修改病患資料【Outcome Results:Adult】(病歷號:'.$patientinformationClass->patientChartNumber.')','S');
                    $patientinformationClassOrignal->patientID=null;
                   $patientinformationClassOrignal->SyntaxScoreDominance='1';
                   $patientinformationClassOrignal->isSaved=$access_id;
                   $patientinformationClass->patientID=null;
                   $patientinformationClass->SyntaxScoreDominance='2';
                   $patientinformationClass->isSaved=$access_id;
                   $this->PatientInformation_Model->Save_patienthistory($patientinformationClassOrignal);
                   $this->PatientInformation_Model->Save_patienthistory($patientinformationClass);
           
                } 
                //$this->PatientInformation_Model->Update_patient($patientID, $patientinformationClass);
                $data['page']="index";   
            $data['patientpage']="divOutcome"; 
                  $data['msg']="Outcomes Saved";   
                  $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
                  $column = $this->PatientInformation_Model->viewRecord($patientID);
                   $data['myContent']=$column;    
                    //query LVAD count
                     $data['LVADCount'] = $this->PatientInformation_Model->query_LVADCount()->row()->LVADCount;
                   //query data permission beginning
            $data['dataPermission']="N";
        $dataOwnerID=$column->row()->patientSurgeon_id;
        $this->load->model('user_Model');
          if($dataOwnerID=="" || $dataOwnerID==$this->session->userdata('userID') || $this->user_Model->query_user($dataOwnerID)->row()->vsPermission=="1" || $this->PatientInformation_Model->queryDataOwner($dataOwnerID,$this->session->userdata('userID'))->num_rows() >=1){
            $data['dataPermission']="Y";
        }
      //query data permission ending
                           //Select data History beginning
                            $column = $this->PatientInformation_Model->qryPatientHistory($patientID);
                   $data['dataHistory']=$column;  
                           //Select data History end
                            $this->load->model('Parameter_Model');
                        
                        $vsList = $this->Parameter_Model->query_vsList();
                        $data['vsList']=$vsList;  
                    $this->load->view('patient/content',$data);
  }
function patientChildOutcome(){
    $this->load->library('session');
        if($this->session->userdata('userID')=="" )
             redirect(base_url().'homenew', 'refresh');
           
        $this->load->model('PatientInformation_Model');
        
        $patientID=$this->input->post('patientID');
        
        $this->load->library('patientinformationClass');
        
               // $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                $patientinformationClass= new patientinformationClass;
                $patientinformationClassOrignal= new patientinformationClass;
                $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                $patientinformationClassOrignal=$this->PatientInformation_Model->viewRecord($patientID)->row();
                $patientinformationClass->patientID=$patientID;
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
                $patientinformationClass->outcomeChildComplication37=$this->input->post('outcomeChildComplication37');
                $patientinformationClass->outcomeChildComplication38=$this->input->post('outcomeChildComplication38');
                $patientinformationClass->outcomeChildComplication39=$this->input->post('outcomeChildComplication39');
                $patientinformationClass->outcomeChildCauseofDeath=$this->input->post('outcomeChildCauseofDeath');
                $this->PatientInformation_Model->Update_patient($patientID, $patientinformationClass);
                $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                 if(comparePatient($patientinformationClassOrignal,$patientinformationClass)=="Y"){
                                   
                       $access_id=accessLog('U','PATIENT',$patientID,$this->session->userdata('userRealname').'修改病患資料【Outcome Results: Child】(病歷號:'.$patientinformationClass->patientChartNumber.')','S');
                                   $patientinformationClassOrignal->patientID=null;
                       $patientinformationClassOrignal->SyntaxScoreDominance='1';
                       $patientinformationClassOrignal->isSaved=$access_id;
                       $patientinformationClass->patientID=null;
                       $patientinformationClass->SyntaxScoreDominance='2';
                       $patientinformationClass->isSaved=$access_id;
                       $this->PatientInformation_Model->Save_patienthistory($patientinformationClassOrignal);
                       $this->PatientInformation_Model->Save_patienthistory($patientinformationClass);
                       
                } 
                //$this->PatientInformation_Model->Update_patient($patientID, $patientinformationClass);
                
                            $data['page']="index";   
                      $data['patientpage']="divOutcome";  
                   $data['msg']="Outcomes Saved";   
                    $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
                   $column = $this->PatientInformation_Model->viewRecord($patientID);
                     $data['myContent']=$column; 
                      //query LVAD count
                     $data['LVADCount'] = $this->PatientInformation_Model->query_LVADCount()->row()->LVADCount;
                     //query data permission beginning
            $data['dataPermission']="N";
        $dataOwnerID=$column->row()->patientSurgeon_id;
        $this->load->model('user_Model');
        if($dataOwnerID=="" || $dataOwnerID==$this->session->userdata('userID') || $this->user_Model->query_user($dataOwnerID)->row()->vsPermission=="1" || $this->PatientInformation_Model->queryDataOwner($dataOwnerID,$this->session->userdata('userID'))->num_rows() >=1){
            $data['dataPermission']="Y";
        }
      //query data permission ending
                            //Select data History beginning
                            $column = $this->PatientInformation_Model->qryPatientHistory($patientID);
                     $data['dataHistory']=$column;  
                            //Select data History end   
                            $this->load->model('Parameter_Model');
                       
                        $vsList = $this->Parameter_Model->query_vsList();
                        $data['vsList']=$vsList;  
                  $this->load->view('patient/content',$data);
  }
  function patientOperation(){
    $this->load->library('session');
        if($this->session->userdata('userID')=="" )
             redirect(base_url().'homenew', 'refresh');
           
        $this->load->model('PatientInformation_Model');
        $this->load->model('user_Model');
        
        $patientID=$this->input->post('patientID');
        
        $this->load->library('patientinformationClass');
        
               // $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                        $patientinformationClassOrignal= new patientinformationClass;
                $patientinformationClass= new patientinformationClass;
                $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                $patientinformationClassOrignal=$this->PatientInformation_Model->viewRecord($patientID)->row();
                
                 $patientinformationClass->patientID=$patientID;
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
                 
                $patientinformationClass->operationCABG=$this->input->post('operationCABG')==null?"N":"Y";
                $patientinformationClass->operationLIMA=$this->input->post('operationLIMA');
                $patientinformationClass->operationRIMA=$this->input->post('operationRIMA');
                $patientinformationClass->operationVeinGraft=$this->input->post('operationVeinGraft');
                $patientinformationClass->operationCardiopulmonaryBypass=$this->input->post('operationCardiopulmonaryBypass')==null?"N":"Y";
                $patientinformationClass->operationCardiacArrest=$this->input->post('operationCardiacArrest')==null?"N":"Y";
                $patientinformationClass->operationCABGMemo=$this->input->post('operationCABGMemo');
                $patientinformationClass->operationAorticValve=$this->input->post('operationAorticValve')==null?"N":"Y";
                $patientinformationClass->operationAVP=$this->input->post('operationAVP');
                $patientinformationClass->operationAVRSelect=$this->input->post('operationAVRSelect');
                $patientinformationClass->operationAorticMemo=$this->input->post('operationAorticMemo');
                $patientinformationClass->operationMitralValve=$this->input->post('operationMitralValve')==null?"N":"Y";
                $patientinformationClass->operationMVPRing=$this->input->post('operationMVPRing')==null?"N":"Y";
                $patientinformationClass->operationMVPArtificialChord=$this->input->post('operationMVPArtificialChord')==null?"N":"Y";
                $patientinformationClass->operationMVPAnnularPlication=$this->input->post('operationMVPAnnularPlication')==null?"N":"Y";
                $patientinformationClass->operationMVPLeafletResection=$this->input->post('operationMVPLeafletResection')==null?"N":"Y";
                $patientinformationClass->operationMVPAlfieriStitch=$this->input->post('operationMVPAlfieriStitch')==null?"N":"Y";
                $patientinformationClass->operationMVPDeVegaAnnularPlasty=$this->input->post('operationMVPDeVegaAnnularPlasty')==null?"N":"Y";
                $patientinformationClass->operationMVR=$this->input->post('operationMVR');
                $patientinformationClass->operationMVRMemo=$this->input->post('operationMVRMemo');
                $patientinformationClass->operationTricuspidValve=$this->input->post('operationTricuspidValve')==null?"N":"Y";
                $patientinformationClass->operationTVPRing=$this->input->post('operationTVPRing')==null?"N":"Y";
                $patientinformationClass->operationTVPArtificialChord=$this->input->post('operationTVPArtificialChord')==null?"N":"Y";
                $patientinformationClass->operationTVPAnnularPlication=$this->input->post('operationTVPAnnularPlication')==null?"N":"Y";
                $patientinformationClass->operationTVPLeafletResection=$this->input->post('operationTVPLeafletResection')==null?"N":"Y";
                $patientinformationClass->operationTVPAlfieriStitch=$this->input->post('operationTVPAlfieriStitch')==null?"N":"Y";
                $patientinformationClass->operationTVPDeVegaAnnularPlasty=$this->input->post('operationTVPDeVegaAnnularPlasty')==null?"N":"Y";
                $patientinformationClass->operationTVR=$this->input->post('operationTVR');
                
                $patientinformationClass->operationTricuspidValveMemo=$this->input->post('operationTricuspidValveMemo');
                $patientinformationClass->operationPulmonaryValve=$this->input->post('operationPulmonaryValve')==null?"N":"Y";
                $patientinformationClass->operationPulmonaryValvePVP=$this->input->post('operationPulmonaryValvePVP');
                $patientinformationClass->operationPulmonaryValvePVR=$this->input->post('operationPulmonaryValvePVR');
                $patientinformationClass->operationPulmonaryValveMemo=$this->input->post('operationPulmonaryValveMemo');
                $patientinformationClass->operationArrythmiaSurgery=$this->input->post('operationArrythmiaSurgery')==null?"N":"Y";
                $patientinformationClass->operationMazeLA=$this->input->post('operationMazeLA')==null?"N":"Y";
                $patientinformationClass->operationMazeRA=$this->input->post('operationMazeRA')==null?"N":"Y";
                $patientinformationClass->operationMazeOthers=$this->input->post('operationMazeOthers')==null?"N":"Y";
                $patientinformationClass->operationMazeEnergySource=$this->input->post('operationMazeEnergySource');
                $patientinformationClass->operationMazeMemo=$this->input->post('operationMazeMemo');
                $patientinformationClass->operationAorticSurgery=$this->input->post('operationAorticSurgery')==null?"N":"Y";
                $patientinformationClass->operationDissection=$this->input->post('operationDissection')==null?"N":"Y";
                $patientinformationClass->operationAneurysmAscending=$this->input->post('operationAneurysmAscending')==null?"N":"Y";
                $patientinformationClass->operationAneurysm=$this->input->post('operationAneurysm')==null?"N":"Y";
                $patientinformationClass->operationAneurysmArch=$this->input->post('operationAneurysmArch')==null?"N":"Y";
                $patientinformationClass->operationAneurysmThoracicAorta=$this->input->post('operationAneurysmThoracicAorta')==null?"N":"Y";
                $patientinformationClass->operationAneurysmAbdominalAorta=$this->input->post('operationAneurysmAbdominalAorta')==null?"N":"Y";
                $patientinformationClass->operationAorticSurgeryMethod=$this->input->post('operationAorticSurgeryMethod');
                $patientinformationClass->operationMazeMemo=$this->input->post('operationMazeMemo');
                $patientinformationClass->operationHeartTransplantation=$this->input->post('operationHeartTransplantation')==null?"N":"Y";
                $patientinformationClass->operationHeartTransplantationMemo=$this->input->post('operationHeartTransplantationMemo');
                        //20161201修改開始
                        $patientinformationClass->patientSurgeon=$this->input->post('patientSurgeon');
                $patientinformationClass->patientSurgeon2=$this->input->post('patientSurgeon2');
                $patientinformationClass->patientSurgeon3=$this->input->post('patientSurgeon3');
                $patientinformationClass->patientSurgeon4=$this->input->post('patientSurgeon4');
                $patientinformationClass->patientReoperation=$this->input->post('patientReoperation');
                $patientinformationClass->patientCardiopulmonaryBypass=$this->input->post('patientCardiopulmonaryBypass');
                         //20181018新增欄位開始
                         $patientinformationClass->patientOperativeApproach=$this->input->post('patientOperativeApproach');
                 $patientinformationClass->patientRoboticUsed=$this->input->post('patientRoboticUsed');
                 $patientinformationClass->patientConvertedDuringProcedure=$this->input->post('patientConvertedDuringProcedure');
                         //20181018新增欄位結束
                    //20180203修改開始
                        $patientinformationClass->operationAorticValve_TAVI=$this->input->post('operationAorticValve_TAVI');
                $patientinformationClass->operationAorticValve_TAVI_S1=$this->input->post('operationAorticValve_TAVI_S1');
                $patientinformationClass->operationAorticValve_TAVI_S2=$this->input->post('operationAorticValve_TAVI_S2');
                
                   //20190214修改開始
                $patientinformationClass->operationBentallSelect=$this->input->post('operationBentallSelect');
                $patientinformationClass->AorticValveProductName=$this->input->post('AorticValveProductName');
                $patientinformationClass->AorticValveProductType=$this->input->post('AorticValveProductType');
                $patientinformationClass->MitralValveProductName=$this->input->post('MitralValveProductName');
                $patientinformationClass->MitralValveProductType=$this->input->post('MitralValveProductType');
                $patientinformationClass->TricuspidValveProductName=$this->input->post('TricuspidValveProductName');
                $patientinformationClass->TricuspidValveProductType=$this->input->post('TricuspidValveProductType');
                $patientinformationClass->PulmonaryValveProductName=$this->input->post('PulmonaryValveProductName');
                $patientinformationClass->PulmonaryValveProductType=$this->input->post('PulmonaryValveProductType');
                
           //     $patientinformationClass->patientCongenitalSurgery=$this->input->post('patientCongenitalSurgery')=="0"?"N":"Y";
                if($this->input->post('patientSurgeon')!=""){
                        $surgeon=$this->user_Model->queryUserbyRealname($this->input->post('patientSurgeon'));
                  if($surgeon->num_rows() ==1){
                               $patientinformationClass->patientSurgeon_id=$surgeon->row()->userID;
                    $patientinformationClass->patientSurgeon_associalid=$surgeon->row()->associateID;
                     }
                          }
                        if($this->input->post('patientSurgeon2')!=""){
                        $surgeon2=$this->user_Model->queryUserbyRealname($this->input->post('patientSurgeon2'));
                if($surgeon2->num_rows() ==1) {
                             $patientinformationClass->patientSurgeon_id2=$surgeon2->row()->userID;
                     $patientinformationClass->patientSurgeon_associalid2=$surgeon2->row()->associateID;
                }
                        }
                        if($this->input->post('patientSurgeon3')!=""){
                        $surgeon3=$this->user_Model->queryUserbyRealname($this->input->post('patientSurgeon3'));
                if($surgeon3->num_rows() ==1) {
                               $patientinformationClass->patientSurgeon_id3=$surgeon3->row()->userID;
                     $patientinformationClass->patientSurgeon_associalid3=$surgeon3->row()->associateID;
                }
                        }
                        if($this->input->post('patientSurgeon4')!=""){
                        $surgeon4=$this->user_Model->queryUserbyRealname($this->input->post('patientSurgeon4'));
                if($surgeon4->num_rows() ==1){
                             $patientinformationClass->patientSurgeon_id4=$surgeon4->row()->userID;
                     $patientinformationClass->patientSurgeon_associalid4=$surgeon->row()->associateID;
                }
                        }
                        //20161201修改結束
                        
                          //20170214修改開始
                        $patientinformationClass->operationRIMA_RadialA=$this->input->post('operationRIMA_RadialA');
                $patientinformationClass->operationRIMA_GEA=$this->input->post('operationRIMA_GEA');
                $patientinformationClass->operationMitralValveBentall=$this->input->post('operationMitralValveBentall')==null?"N":"Y";
                      
                          
                $patientinformationClass->operationAorticValve_AVP=$this->input->post('operationAorticValve_AVP')==null?"N":"Y";
                $patientinformationClass->operationAorticValve_AVR=$this->input->post('operationAorticValve_AVR')==null?"N":"Y";
                $patientinformationClass->Operation_MitralValve_MVP=$this->input->post('Operation_MitralValve_MVP')==null?"N":"Y";
                $patientinformationClass->Operation_MitralValve_MVR=$this->input->post('Operation_MitralValve_MVR')==null?"N":"Y";
                $patientinformationClass->Operation_TricuspidValve_TVP=$this->input->post('Operation_TricuspidValve_TVP')==null?"N":"Y";
                $patientinformationClass->Operation_TricuspidValve_TVR=$this->input->post('Operation_TricuspidValve_TVR')==null?"N":"Y";
                $patientinformationClass->Operation_PulmonaryValve_PVP=$this->input->post('Operation_PulmonaryValve_PVP')==null?"N":"Y";
                $patientinformationClass->Operation_PulmonaryValve_PVR=$this->input->post('Operation_PulmonaryValve_PVR')==null?"N":"Y";
                $patientinformationClass->operationMVPOthers=$this->input->post('operationMVPOthers')==null?"N":"Y";
                $patientinformationClass->operationTVPOthers=$this->input->post('operationTVPOthers')==null?"N":"Y";
                $patientinformationClass->operationMazebiatrialLesion=$this->input->post('operationMazebiatrialLesion')==null?"N":"Y";
                $patientinformationClass->operationMazePVIwithLAA=$this->input->post('operationMazePVIwithLAA')==null?"N":"Y";
                $patientinformationClass->operationMazePVIwithoutLAA=$this->input->post('operationMazePVIwithoutLAA')==null?"N":"Y";

                 $patientinformationClass->operationEtiologyOthers=$this->input->post('operationEtiologyOthers')==null?"N":"Y";
                $patientinformationClass->operationEtiologyCardiopulmonarBypass=$this->input->post('operationEtiologyCardiopulmonarBypass')==null?"N":"Y";
                $patientinformationClass->operationAorticSurgeryCerebralProtection=$this->input->post('operationAorticSurgeryCerebralProtection');
                $patientinformationClass->operationAorticSurgeryLocation=$this->input->post('operationAorticSurgeryLocation');
                $patientinformationClass->operationAorticSurgeryMemo=$this->input->post('operationAorticSurgeryMemo');
                
                $patientinformationClass->operationHeartTransplantationOP=$this->input->post('operationHeartTransplantationOP')==null?"N":"Y";
                $patientinformationClass->operationHeartTransplantationLVAD=$this->input->post('operationHeartTransplantationLVAD')==null?"N":"Y";
                $patientinformationClass->operationHeartTransplantationRVAD=$this->input->post('operationHeartTransplantationRVAD')==null?"N":"Y";
                
                $patientinformationClass->operationOtherCardiacSurgery=$this->input->post('operationOtherCardiacSurgery')==null?"N":"Y";
                $patientinformationClass->operationOtherCardiacSurgery1=$this->input->post('operationOtherCardiacSurgery1')==null?"N":"Y";
                $patientinformationClass->operationOtherCardiacSurgery2=$this->input->post('operationOtherCardiacSurgery2')==null?"N":"Y";
                $patientinformationClass->operationOtherCardiacSurgery3=$this->input->post('operationOtherCardiacSurgery3')==null?"N":"Y";
                $patientinformationClass->operationOtherCardiacSurgery4=$this->input->post('operationOtherCardiacSurgery4')==null?"N":"Y";
                $patientinformationClass->operationOtherCardiacSurgery5=$this->input->post('operationOtherCardiacSurgery5')==null?"N":"Y";
                $patientinformationClass->operationOtherCardiacSurgery6=$this->input->post('operationOtherCardiacSurgery6')==null?"N":"Y";
                $patientinformationClass->operationOtherCardiacSurgery7=$this->input->post('operationOtherCardiacSurgery7')==null?"N":"Y";
                $patientinformationClass->operationOtherCardiacSurgery8=$this->input->post('operationOtherCardiacSurgery8')==null?"N":"Y";
                $patientinformationClass->operationOtherCardiacSurgery9=$this->input->post('operationOtherCardiacSurgery9')==null?"N":"Y";
                $patientinformationClass->operationOtherCardiacSurgery10=$this->input->post('operationOtherCardiacSurgery10')==null?"N":"Y";
                $patientinformationClass->operationOtherCardiacSurgery11=$this->input->post('operationOtherCardiacSurgery11')==null?"N":"Y";
                $patientinformationClass->operationOtherCardiacSurgeryMemo=$this->input->post('operationOtherCardiacSurgeryMemo');
                $this->PatientInformation_Model->Update_patient($patientID, $patientinformationClass);
                $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                        //20170214修改結束
                if(comparePatient($patientinformationClassOrignal,$patientinformationClass)=="Y"){
               
           $access_id=accessLog('U','PATIENT',$patientID,$this->session->userdata('userRealname').'修改病患資料【Operation Procedures:Open heart Surgery】(病歷號:'.$patientinformationClass->patientChartNumber.')','S');
                $patientinformationClassOrignal->patientID=null;
           $patientinformationClassOrignal->SyntaxScoreDominance='1';
           $patientinformationClassOrignal->isSaved=$access_id;
           $patientinformationClass->patientID=null;
           $patientinformationClass->SyntaxScoreDominance='2';
           $patientinformationClass->isSaved=$access_id;
           $this->PatientInformation_Model->Save_patienthistory($patientinformationClassOrignal);
           $this->PatientInformation_Model->Save_patienthistory($patientinformationClass);
                }
                        //$this->PatientInformation_Model->Update_patient($patientID, $patientinformationClass);
                $data['page']="index";   
            $data['patientpage']="divOperation";   
                  $data['msg']="Open heart Surgery   Form Saved";  
                  $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
                  $column = $this->PatientInformation_Model->viewRecord($patientID);
                  $data['myContent']=$column;  
                   //query LVAD count
                     $data['LVADCount'] = $this->PatientInformation_Model->query_LVADCount()->row()->LVADCount;
                  //query data permission beginning
            $data['dataPermission']="N";
        $dataOwnerID=$column->row()->patientSurgeon_id;
        $this->load->model('user_Model');
         if($dataOwnerID=="" || $dataOwnerID==$this->session->userdata('userID') || 
              $this->user_Model->query_user($dataOwnerID)->row()->vsPermission=="1" || $this->PatientInformation_Model->queryDataOwner($dataOwnerID,$this->session->userdata('userID'))->num_rows() >=1){
            $data['dataPermission']="Y";
        }
      //query data permission ending
                          //Select data History beginning
                          $column = $this->PatientInformation_Model->qryPatientHistory($patientID);
                   $data['dataHistory']=$column;  
                         //Select data History end 
                         $this->load->model('Parameter_Model'); 
                     
                     $vsList = $this->Parameter_Model->query_vsList();
                     $data['vsList']=$vsList;  
                 $this->load->view('patient/content',$data);
  }
   function CongenitalSurgery(){
    $this->load->library('session');
        if($this->session->userdata('userID')=="" )
             redirect(base_url().'homenew', 'refresh');
           
        $this->load->model('PatientInformation_Model');
        $this->load->model('user_Model');
        
        $patientID=$this->input->post('patientID');
        
        $this->load->library('patientinformationClass');
        
               // $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                $patientinformationClass= new patientinformationClass;
            $patientinformationClassOrignal= new patientinformationClass;
                $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                $patientinformationClassOrignal=$this->PatientInformation_Model->viewRecord($patientID)->row();
                $patientinformationClass->patientID=$patientID;
                $patientinformationClass->CongenitalDiagnosis1=$this->input->post('CongenitalDiagnosis1');
                $patientinformationClass->CongenitalDiagnosis2=$this->input->post('CongenitalDiagnosis2');
                $patientinformationClass->CongenitalDiagnosis3=$this->input->post('CongenitalDiagnosis3');
                $patientinformationClass->CongenitalDiagnosis4=$this->input->post('CongenitalDiagnosis4');
                $patientinformationClass->CongenitalDiagnosis5=$this->input->post('CongenitalDiagnosis5');
                $patientinformationClass->CongenitalDiagnosis_id1=$this->input->post('CongenitalDiagnosis_id1');
                $patientinformationClass->CongenitalDiagnosis_id2=$this->input->post('CongenitalDiagnosis_id2');
                $patientinformationClass->CongenitalDiagnosis_id3=$this->input->post('CongenitalDiagnosis_id3');
                $patientinformationClass->CongenitalDiagnosis_id4=$this->input->post('CongenitalDiagnosis_id4');
                $patientinformationClass->CongenitalDiagnosis_id5=$this->input->post('CongenitalDiagnosis_id5');
                $patientinformationClass->CongenitalDiagnosisOthers=$this->input->post('CongenitalDiagnosisOthers');
                $patientinformationClass->CongenitalProcedure1=$this->input->post('CongenitalProcedure1');
                $patientinformationClass->CongenitalProcedure2=$this->input->post('CongenitalProcedure2');
                $patientinformationClass->CongenitalProcedure3=$this->input->post('CongenitalProcedure3');
                $patientinformationClass->CongenitalProcedure4=$this->input->post('CongenitalProcedure4');
                $patientinformationClass->CongenitalProcedure5=$this->input->post('CongenitalProcedure5');
                $patientinformationClass->CongenitalProcedure_id1=$this->input->post('CongenitalProcedure_id1');
                $patientinformationClass->CongenitalProcedure_id2=$this->input->post('CongenitalProcedure_id2');
                $patientinformationClass->CongenitalProcedure_id3=$this->input->post('CongenitalProcedure_id3');
                $patientinformationClass->CongenitalProcedure_id4=$this->input->post('CongenitalProcedure_id4');
                $patientinformationClass->CongenitalProcedure_id5=$this->input->post('CongenitalProcedure_id5');
                $patientinformationClass->CongenitalProcedureOthers=$this->input->post('CongenitalProcedureOthers');
                $patientinformationClass->operationCongenitalBypass=$this->input->post('operationCongenitalBypass')==null?"N":"Y";
                $patientinformationClass->operationCongenitalBypassCPBTime=$this->input->post('operationCongenitalBypassCPBTime');
                $patientinformationClass->operationCongenitalBypassAorticTime=$this->input->post('operationCongenitalBypassAorticTime');
                $patientinformationClass->operationCongenitalBypassCirculatoryTime=$this->input->post('operationCongenitalBypassCirculatoryTime');
                $patientinformationClass->operationCongenitalBypassCardioplegia=$this->input->post('operationCongenitalBypassCardioplegia');
                $patientinformationClass->operationCongenitalBypassRACHS=$this->input->post('operationCongenitalBypassRACHS');
                $patientinformationClass->operationCongenitalBypassSTS=$this->input->post('operationCongenitalBypassSTS');
                $patientinformationClass->operationCongenitalBypassMemo=$this->input->post('operationCongenitalBypassMemo');
                         //20171227新增欄位開始
                         $patientinformationClass->BenchmarkSurgery=$this->input->post('BenchmarkSurgery');
                         //20171227新增欄位結束
                         //20181018新增欄位開始
                         $patientinformationClass->patientOperativeApproach=$this->input->post('patientOperativeApproach');
                 $patientinformationClass->patientRoboticUsed=$this->input->post('patientRoboticUsed');
                 $patientinformationClass->patientConvertedDuringProcedure=$this->input->post('patientConvertedDuringProcedure');
                         //20181018新增欄位結束
                        //20161201修改開始
                        $patientinformationClass->patientSurgeon=$this->input->post('patientSurgeon');
                $patientinformationClass->patientSurgeon2=$this->input->post('patientSurgeon2');
                $patientinformationClass->patientSurgeon3=$this->input->post('patientSurgeon3');
                $patientinformationClass->patientSurgeon4=$this->input->post('patientSurgeon4');
                $patientinformationClass->patientReoperation=$this->input->post('patientReoperation');
                $patientinformationClass->patientCardiopulmonaryBypass=$this->input->post('patientCardiopulmonaryBypass');
                
                if($this->input->post('CongenitalDiagnosis1')!="" || $this->input->post('CongenitalDiagnosis2')!="" || 
                $this->input->post('CongenitalDiagnosis3')!="" || $this->input->post('CongenitalDiagnosis4')!="" || 
                $this->input->post('CongenitalDiagnosis5')!="" || $this->input->post('CongenitalDiagnosisOthers')!="" ) {
                                             $patientinformationClass->patientCongenitalSurgery="Y";
                    } else {
                    	$patientinformationClass->patientCongenitalSurgery="N";
                    }
                if($this->input->post('patientSurgeon')!=""){
                        $surgeon=$this->user_Model->queryUserbyRealname(urldecode($this->input->post('patientSurgeon')));
                if($surgeon->num_rows() ==1){
                              $patientinformationClass->patientSurgeon_id=$surgeon->row()->userID;
                    $patientinformationClass->patientSurgeon_associalid=$surgeon->row()->associateID;
                     }
                          }
                        if($this->input->post('patientSurgeon2')!=""){
                        $surgeon2=$this->user_Model->queryUserbyRealname(urldecode($this->input->post('patientSurgeon2')));
                if($surgeon2->num_rows() ==1) {
                             $patientinformationClass->patientSurgeon_id2=$surgeon2->row()->userID;
                     $patientinformationClass->patientSurgeon_associalid2=$surgeon2->row()->associateID;
                }
                        }
                        if($this->input->post('patientSurgeon3')!=""){
                        $surgeon3=$this->user_Model->queryUserbyRealname(urldecode($this->input->post('patientSurgeon3')));
                if($surgeon3->num_rows() ==1) {
                               $patientinformationClass->patientSurgeon_id3=$surgeon3->row()->userID;
                     $patientinformationClass->patientSurgeon_associalid3=$surgeon3->row()->associateID;
                }
                        }
                        if($this->input->post('patientSurgeon4')!=""){
                        $surgeon4=$this->user_Model->queryUserbyRealname(urldecode($this->input->post('patientSurgeon4')));
                if($surgeon4->num_rows() ==1){
                             $patientinformationClass->patientSurgeon_id4=$surgeon4->row()->userID;
                     $patientinformationClass->patientSurgeon_associalid4=$surgeon->row()->associateID;
                }
                        }
                        $this->PatientInformation_Model->Update_patient($patientID, $patientinformationClass);
                $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                        //20161201修改結束             
                         if(comparePatient($patientinformationClassOrignal,$patientinformationClass)=="Y"){
                
           $access_id=accessLog('U','PATIENT',$patientID,$this->session->userdata('userRealname').'修改病患資料【Operation Procedures:Congenital Surgery】(病歷號:'.$patientinformationClass->patientChartNumber.')','S');
                 $patientinformationClassOrignal->patientID=null;
           $patientinformationClassOrignal->SyntaxScoreDominance='1';
           $patientinformationClassOrignal->isSaved=$access_id;
           $patientinformationClass->patientID=null;
           $patientinformationClass->SyntaxScoreDominance='2';
           $patientinformationClass->isSaved=$access_id;
           $this->PatientInformation_Model->Save_patienthistory($patientinformationClassOrignal);
           $this->PatientInformation_Model->Save_patienthistory($patientinformationClass);
           
                }  
                      // $this->PatientInformation_Model->Update_patient($patientID, $patientinformationClass);
                $data['page']="index";   
            $data['patientpage']="divCongenitalSurgery";   
         
        $data['msg']="Congenital Surgery  Form Saved";    
        $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
        $column = $this->PatientInformation_Model->viewRecord($patientID);
        $data['myContent']=$column;    
         //query LVAD count
                     $data['LVADCount'] = $this->PatientInformation_Model->query_LVADCount()->row()->LVADCount;
          //query data permission beginning
            $data['dataPermission']="N";
        $dataOwnerID=$column->row()->patientSurgeon_id;
        $this->load->model('user_Model');
         if($dataOwnerID=="" || $dataOwnerID==$this->session->userdata('userID') || 
              $this->user_Model->query_user($dataOwnerID)->row()->vsPermission=="1" || $this->PatientInformation_Model->queryDataOwner($dataOwnerID,$this->session->userdata('userID'))->num_rows() >=1){
            $data['dataPermission']="Y";
        }
      //query data permission ending
      
            //Select data History beginning
            $column = $this->PatientInformation_Model->qryPatientHistory($patientID);
        $data['dataHistory']=$column;  
             //Select data History end
            $this->load->model('Parameter_Model');
        
        $vsList = $this->Parameter_Model->query_vsList();
        $data['vsList']=$vsList;  
        $this->load->view('patient/content',$data);
  }
function patientNoneSurgery(){
    $this->load->library('session');
        if($this->session->userdata('userID')=="" )
             redirect(base_url().'homenew', 'refresh');
           
        $this->load->model('PatientInformation_Model');
        
        $patientID=$this->input->post('patientID');
        
        $this->load->library('patientinformationClass');
        
               // $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                $patientinformationClass= new patientinformationClass;
                $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                $patientinformationClass->patientID=$patientID;
                 $patientinformationClass->operationAssociateCategory=$this->input->post('operationAssociateCategory');
                $patientinformationClass->NonOpenHeartPeripheralArtery=$this->input->post('NonOpenHeartPeripheralArtery');
                $patientinformationClass->NonOpenHeartPeripheralArteryPAOD=$this->input->post('NonOpenHeartPeripheralArteryPAOD');
                $patientinformationClass->NonOpenHeartPeripheralArteryAVAccess=$this->input->post('NonOpenHeartPeripheralArteryAVAccess');
                $patientinformationClass->NonOpenHeartPeripheralArteryMemo=$this->input->post('NonOpenHeartPeripheralArteryMemo');
                $patientinformationClass->NonOpenHeartVaricoseVeinSurgery=$this->input->post('NonOpenHeartVaricoseVeinSurgery');
                $patientinformationClass->NonOpenHeartVaricoseVeinSurgeryMemo=$this->input->post('NonOpenHeartVaricoseVeinSurgeryMemo');
                $patientinformationClass->NonOpenHeartCentralVeinAccess=$this->input->post('NonOpenHeartCentralVeinAccess');
                $patientinformationClass->NonOpenHeartCentralVeinAccessType=$this->input->post('NonOpenHeartCentralVeinAccessType');
                $patientinformationClass->NonOpenHeartCentralVeinAccessMemo=$this->input->post('NonOpenHeartCentralVeinAccessMemo');
                $patientinformationClass->NonOpenHeartMechanicalSupport=$this->input->post('NonOpenHeartMechanicalSupport');
                $patientinformationClass->NonOpenHeartMechanicalSupportECMO=$this->input->post('NonOpenHeartMechanicalSupportECMO');
                $patientinformationClass->NonOpenHeartMechanicalSupportMemo=$this->input->post('NonOpenHeartMechanicalSupportMemo');
                        //20161201修改開始
                        $patientinformationClass->patientSurgeon=$this->input->post('patientSurgeon');
                $patientinformationClass->patientSurgeon2=$this->input->post('patientSurgeon2');
                $patientinformationClass->patientSurgeon3=$this->input->post('patientSurgeon3');
                $patientinformationClass->patientSurgeon4=$this->input->post('patientSurgeon4');
                        //20161201修改結束             
                        $this->PatientInformation_Model->Update_patient($patientID, $patientinformationClass);
                $data['msg']="Non-open heart  form Saved"; 
                  $data['page']="index";   
                     $data['patientpage']="divNoneSurgery"; 
              
                $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
                $column = $this->PatientInformation_Model->viewRecord($patientID);
                $data['myContent']=$column;  
                 //query LVAD count
                     $data['LVADCount'] = $this->PatientInformation_Model->query_LVADCount()->row()->LVADCount;
                //query data permission beginning
            $data['dataPermission']="N";
        $dataOwnerID=$column->row()->patientSurgeon_id;
        $this->load->model('user_Model');
        if($dataOwnerID=="" || $dataOwnerID==$this->session->userdata('userID') || $this->user_Model->query_user($dataOwnerID)->row()->vsPermission=="1" || $this->PatientInformation_Model->queryDataOwner($dataOwnerID,$this->session->userdata('userID'))->num_rows() >=1){
            $data['dataPermission']="Y";
        }
      //query data permission ending
                        //Select data History beginning
                        $column = $this->PatientInformation_Model->qryPatientHistory($patientID);
                 $data['dataHistory']=$column;  
                        //Select data History end
                        $this->load->model('Parameter_Model'); 
                   
                  $vsList = $this->Parameter_Model->query_vsList();
                    $data['vsList']=$vsList;  
                $this->load->view('patient/content',$data);
  }
    function saveSyntaxscore(){
        $this->load->library('session');
        if($this->session->userdata('userID')=="" )
             redirect(base_url().'homenew', 'refresh');
           
        $this->load->model('PatientInformation_Model');
        
        $patientID=$this->input->post('patientID');
        
        $this->load->library('patientinformationClass');
        
               // $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                  $patientinformationClassOrignal= new patientinformationClass;
                $patientinformationClass= new patientinformationClass;
                $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                $patientinformationClassOrignal=$this->PatientInformation_Model->viewRecord($patientID)->row();
                
                $patientinformationClass->patientID=$patientID;
                $patientinformationClass->patientSyntaxScore=$this->input->post('syntaxscore_reult');
                $patientinformationClass->patientSyntaxScoreContent=$this->input->post('syntaxscore_reultPrint');
                $patientinformationClass->patientSyntaxScoreTable=$this->input->post('syntaxscore_reultTable');      
                $this->PatientInformation_Model->Update_patient($patientID, $patientinformationClass);
                  $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                        //20170214修改結束
                if(comparePatient($patientinformationClassOrignal,$patientinformationClass)=="Y"){
               
           $access_id=accessLog('U','PATIENT',$patientID,$this->session->userdata('userRealname').'修改病患資料【Syntax Score】(病歷號:'.$patientinformationClass->patientChartNumber.')','S');
                $patientinformationClassOrignal->patientID=null;
           $patientinformationClassOrignal->SyntaxScoreDominance='1';
           $patientinformationClassOrignal->isSaved=$access_id;
           $patientinformationClass->patientID=null;
           $patientinformationClass->SyntaxScoreDominance='2';
           $patientinformationClass->isSaved=$access_id;
           $this->PatientInformation_Model->Save_patienthistory($patientinformationClassOrignal);
           $this->PatientInformation_Model->Save_patienthistory($patientinformationClass);
                }
               $data['page']="index";   
        $data['patientpage']="divPatientProfiles";     
                $data['msg']="Syntax Score Saved";  
                $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
                $column = $this->PatientInformation_Model->viewRecord($patientID);
                $data['myContent']=$column;  
                 //query LVAD count
                     $data['LVADCount'] = $this->PatientInformation_Model->query_LVADCount()->row()->LVADCount;
                //query data permission beginning
                        $data['dataPermission']="N";
                    $dataOwnerID=$column->row()->patientSurgeon_id;
                    $this->load->model('user_Model');
                    if($dataOwnerID=="" || $dataOwnerID==$this->session->userdata('userID') || 
                            $this->user_Model->query_user($dataOwnerID)->row()->vsPermission=="1" || $this->PatientInformation_Model->queryDataOwner($dataOwnerID,$this->session->userdata('userID'))->num_rows() >=1){
                            $data['dataPermission']="Y";
                        }
      //query data permission ending
                        //Select data History beginning
                        $column = $this->PatientInformation_Model->qryPatientHistory($patientID);
                 $data['dataHistory']=$column;  
                        //Select data History end  
                       $this->load->model('Parameter_Model');
                  
                   $vsList = $this->Parameter_Model->query_vsList();
                   $data['vsList']=$vsList;  
                $this->load->view('patient/content',$data);
  }
   
   
     function addPatient(){
        $this->load->library('session');
        if($this->session->userdata('userID')=="" )
             redirect(base_url().'homenew', 'refresh');
           
        $this->load->model('PatientInformation_Model');
        $this->load->model('Parameter_Model');
        $vsList = $this->Parameter_Model->query_vsList();
        $data['vsList']=$vsList;  
        $data['page']="index";    
        $data['path']="<li>病患資料</li><li  class='break'>&#187; 新增病患</li>";
        $this->load->view('patient/addPatient',$data);
  }
   function savePatient(){
       $this->load->library('session');
        if($this->session->userdata('userID')=="" )
             redirect(base_url().'homenew', 'refresh');
           
        $this->load->model('PatientInformation_Model');
        
        
        $this->load->library('patientinformationClass');
        
               // $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                $patientinformationClass= new patientinformationClass;
                $patientinformationClass->patientSSN=$this->input->post('patientSSN');
                $patientinformationClass->patientChartNumber=$this->input->post('patientChartNumber');
                $patientinformationClass->patientHospital=$this->input->post('patientHospital');
                $patientinformationClass->patientName=$this->input->post('patientName');
                $patientinformationClass->patientBirthday=$this->input->post('patientBirthday');
                $patientinformationClass->patientAge=$this->input->post('patientAge');
                $patientinformationClass->patientAgeUnit=$this->input->post('patientAgeUnit');
                $patientinformationClass->patientGender=$this->input->post('patientGender')==null?"":$this->input->post('patientGender');
                $patientinformationClass->patientSurgeon=$this->input->post('patientSurgeon');
                $patientinformationClass->patientSurgeon2=$this->input->post('patientSurgeon2');
                $patientinformationClass->patientSurgeon3=$this->input->post('patientSurgeon3');
                $patientinformationClass->patientSurgeon4=$this->input->post('patientSurgeon4');
                $patientinformationClass->patientOpDate=$this->input->post('patientOpDate');
                $patientinformationClass->patientDischargeDate=$this->input->post('patientDischargeDate');
              //  $patientinformationClass->patientDiagnosis=$this->input->post('patientDiagnosis');
                $patientinformationClass->patientAssociatedDisease=$this->input->post('patientAssociatedDisease');
                $patientinformationClass->isDeleted='N';
                $patientinformationClass->createPerson=$this->session->userdata('userID');
        
                $insert_id=$this->PatientInformation_Model->Save_patient($patientinformationClass);
                accessLog('A','PATIENT',$insert_id,$this->session->userdata('userRealname').'新增病患資料【病歷號碼：'.$this->input->post('patientChartNumber').'】','S');
        
                redirect(base_url().'patient/viewRecord/'.$insert_id, 'refresh');
                 
   }

function printPatient($pid){
         $this->load->library('session');
        if($this->session->userdata('userID')=="" )
        redirect(base_url().'homenew', 'refresh');
        
     
        $this->load->model('PatientInformation_Model'); 
        if($pid!=''){
             $column = $this->PatientInformation_Model->viewRecord($pid);
         accessLog('R','PATIENT',$column->row()->patientID,$this->session->userdata('userRealname').'列印病患資料【病歷號碼：'.$column->row()->patientChartNumber.'】','S');
        
        }
        $data['myContent']=$column;    
         //query LVAD count
                     $data['LVADCount'] = $this->PatientInformation_Model->query_LVADCount()->row()->LVADCount;
    $this->load->view('patient/printPatient',$data);
}
function STSMortalitycategory(){
       
    $this->load->view('patient/STSMortalitycategory');
}
function RACHS(){
       
    $this->load->view('patient/RACHS');
}

   function calEuroScore($row)
    {
            $this->load->model('PatientInformation_Model');
          
       
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

              // $patient= $this->PatientInformation_Model->insert_euro($result,$row->patientID);
              return $result;
         }

  function calCCRScore($row)
    {
            $this->load->model('PatientInformation_Model');
          
       
          $result=0;
             if($row->patientSerumCreatinine!="0" && $row->patientSerumCreatinine!=""){
               if($row->patientGender=="M"){
                                 $result=((140 - floatval($row->patientAge))*floatval($row->patientBodyWeight))/(72*floatval($row->patientSerumCreatinine));
               } else {
                                $result=(((140 - floatval($row->patientAge))*floatval($row->patientBodyWeight))/(72*floatval($row->patientSerumCreatinine)))*0.85;
               }
                
               $result=round($result,1);
          //$patient= $this->PatientInformation_Model->insert_CCR($result,$row->patientID);
          return $result;
             }
         }
    
    function dateDiff($date1, $date2){
            $ts1 = strtotime($date1);
        $ts2 = strtotime($date2);
            if(($ts2 - $ts1)<0)
            return "";
            else
         return  round(($ts2 - $ts1)/86400)+1;
    }

  function queryDiagnosis($d){
       $this->load->model('PatientInformation_Model');
   
       $data['Diagnosis']=$this->PatientInformation_Model->selectDiagnosis();
       $data['w']= $d;
       $this->load->view('patient/diagnosis',$data);
  }
  
  function queryProcedure($d){
       $this->load->model('PatientInformation_Model');
   
       $data['Procedure']=$this->PatientInformation_Model->selectProcedure();
       $data['w']= $d;
       $this->load->view('patient/procedure',$data);
  }
  function queryAdultDiagnosis($d){
       $this->load->model('PatientInformation_Model');
   
       $data['Diagnosis']=$this->PatientInformation_Model->selectAdultDiagnosis();
       $data['w']= $d;
       $this->load->view('patient/adultdiagnosis',$data);
  }
  
  function compareHistory($aid,$atype){
        $this->load->model('PatientInformation_Model');
         if($atype=="T"){
                 $data['beforeModify']="";
           $data['afterModify']=$this->PatientInformation_Model->qryPatientHistoryDetail($aid,'0');
         } else {
                 $data['beforeModify']=$this->PatientInformation_Model->qryPatientHistoryDetail($aid,'1');
           $data['afterModify']=$this->PatientInformation_Model->qryPatientHistoryDetail($aid,'2');
          }
           $data['t']= $atype;
       $this->load->view('patient/comparehistory',$data);
  }
  function profilesending(){
         $this->load->model('PatientInformation_Model');
      $surgeonCount=$this->input->post('surgeonCount');
       $patientID=$this->input->post('patientID');
       $data['page']="index";   
       $data['patientpage']="divPrintSending"; 
      
        $data['msg']="Patient Data Sent to your Surgeons";    
        $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
        $patientinformation = $this->PatientInformation_Model->viewRecord($patientID);
         //query data permission beginning
                        $data['dataPermission']="N";
                    $dataOwnerID=$patientinformation->row()->patientSurgeon_id;
                    $this->load->model('user_Model');
                    if($dataOwnerID=="" || $dataOwnerID==$this->session->userdata('userID') || 
                            $this->user_Model->query_user($dataOwnerID)->row()->vsPermission=="1" || $this->PatientInformation_Model->queryDataOwner($dataOwnerID,$this->session->userdata('userID'))->num_rows() >=1){
                            $data['dataPermission']="Y";
                        }
      //query data permission ending
      
        $data['myContent']=$patientinformation;    
             //Select data History beginning
            $column = $this->PatientInformation_Model->qryPatientHistory($patientID);
        $data['dataHistory']=$column;  
             //Select data History end
            $this->load->model('Parameter_Model');
       
        $vsList = $this->Parameter_Model->query_vsList();
        $data['vsList']=$vsList;  
      for($i=0;$i<$surgeonCount;$i++){
          if($this->input->post('profilesending_'.$i)=="1" && $this->input->post('profilesendingEmail_'.$i)!=""){
           

$ci = get_instance();
$ci->load->library('email');
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'ssl://smtp.gmail.com';
$config['smtp_port'] = '465';
$config['smtp_user'] = 'twcvs2017@gmail.com'; 
$config['smtp_pass'] = 'vicwang2008';
$config['charset'] = 'utf-8';
$config['mailtype'] = 'html';
$config['newline'] = "\r\n";

$ci->email->initialize($config);

$ci->email->from('twcvs2017@gmail.com', 'TWCVS');
$list = array($this->input->post('profilesendingEmail_'.$i));
$ci->email->to($list);
$this->email->reply_to('twcvs2017@gmail.com', 'TWCVS');
$ci->email->subject('TWCVS: Patient Data');
$ci->email->message($this->mailBody($patientID));
$ci->email->send();
$access_id=accessLog('M','PATIENT',$patientID,$this->session->userdata('userRealname').'寄出病患資料【給'.$this->input->post('profilesendingVS_'.$i).'('.$this->input->post('profilesendingEmail_'.$i).')】(病歷號:'.$patientinformation->row()->patientChartNumber.')','S');
}
}
//print($this->input->post('profilesendingEmail_'.$i));
          
        $this->load->view('patient/content',$data);
          
      
  }

 function mailBody($pid)
    {
            $this->load->model('PatientInformation_Model');
            $Renalimpairment[0]="";
            $Renalimpairment[1]="normal (CC &gt;85ml/min)";
            $Renalimpairment[2]="moderate (CC &gt;50 &amp; &lt;85)";
            $Renalimpairment[3]="severe (CC &lt;50)";
            $Renalimpairment[4]="dialysis (regardless of CC)";
            $NYHA[0]="";
            $NYHA[1]="I";
            $NYHA[2]="II";
            $NYHA[3]="III";
            $NYHA[4]="IV";
            $LVfunction[0]="";
            $LVfunction[1]="good (LVEF &gt; 50%)";
            $LVfunction[2]="moderate (LVEF 31%-50%)";
            $LVfunction[3]="poor (LVEF 21%-30%)";
            $LVfunction[4]="very poor (LVEF 20% or less)";
            $Pulmonary[0]="";
            $Pulmonary[1]="no";
            $Pulmonary[2]="moderate (PA systolic 31-55 mmHg)";
            $Pulmonary[3]="severe (PA systolic &gt;55 mmHg)";
            $Urgency[0]="";
            $Urgency[1]="elective";
            $Urgency[2]="urgent";
            $Urgency[3]="emergency";
            $Urgency[4]="salvage";
            $Weight[0]="";
            $Weight[1]="isolated CABG";
            $Weight[2]="single non CABG";
            $Weight[3]="2 procedures";
            $Weight[4]="3 procedure";
            $CauseofDeath[0]="";
            $CauseofDeath[1]="Accident";
            $CauseofDeath[2]="Acute or chronic cardiac failure";
            $CauseofDeath[3]="Anoxic event";
            $CauseofDeath[4]="Bleeding";
            $CauseofDeath[5]="Non­cardiac bleeding";
            $CauseofDeath[6]="Surgical bleeding (intra op or post op)";
            $CauseofDeath[7]="Coronary artery event ";
            $CauseofDeath[8]="Gastrointestinal complications";
            $CauseofDeath[9]="Liver failure";
            $CauseofDeath[10]="Malignancy";
            $CauseofDeath[11]="Mechanical circulatory support failure";
            $CauseofDeath[12]="Neurologic event";
            $CauseofDeath[13]="Pulmonary embolism";
            $CauseofDeath[14]="Rejection";
            $CauseofDeath[15]="Renal failure";
            $CauseofDeath[16]="Respiratory failure";
            $CauseofDeath[17]="Rhythm disturbance";
            $CauseofDeath[18]="Suicide";
            $CauseofDeath[19]="Surgical site infection ";
            $CauseofDeath[20]="Other major infection";
            $CauseofDeath[21]="Sepsis";
            $CauseofDeath[22]="Systemic embolism";
            $CauseofDeath[23]="Inoperable Defect";
            $CauseofDeath[24]="Other, specify";
        $html="";
        if($pid!='')
            $c= $this->PatientInformation_Model->viewRecord($pid)->row();
        $html.="<table cellspacing='0' cellpadding='0' border='1' width='100%' style='border: 1px solid black'> ";
        $html.="<tr bgcolor='#CED8F6'>";
        $html.="<td colspan='4'>Patient Profiles</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td width='25%' bgcolor='#edf0f4'>Patient ID</td>";
        $html.="<td width='25%'>".$c->patientSSN."</td>";
        $html.="<td width='25%' bgcolor='#edf0f4'>Chart number</td>";
        $html.="<td width='25%'>".$c->patientChartNumber."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Patient Name</td>";
        $html.="<td>".$c->patientName."</td>";
        $html.="<td bgcolor='#edf0f4'>Birthday</td>";
        $html.="<td>".str_replace('0000-00-00', '', $c->patientBirthday)."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Age</td>";
        $html.="<td>".$c->patientAge.($c->patientAgeUnit=="1"?"Years":($c->patientAgeUnit=="2"?"Months":"Days"))."</td>";
        $html.="<td bgcolor='#edf0f4'>Gender</td>";
        $html.="<td>".$c->patientGender."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Operation date</td>";
        $html.="<td>".str_replace('0000-00-00', '', $c->patientOpDate)."</td>";
        $html.="<td bgcolor='#edf0f4'>Discharge date</td>";
        $html.="<td>".str_replace('0000-00-00', '', $c->patientDischargeDate)."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Congenital surgery</td>";
        $html.="<td>".($c->patientCongenitalSurgery=="Y"?"Y":"N")."</td>";
        $html.="<td bgcolor='#edf0f4'>Other associated disease</td>";
        $html.="<td>".$c->patientAssociatedDisease."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>EUROSCORE II</td>";
        $html.="<td>".$c->euroScoreII."</td>";
        $html.="<td bgcolor='#edf0f4'>SYNTAX Score</td>";
        $html.="<td>".$c->patientSyntaxScore."</td>";
        $html.="</tr>";
        
        $html.="<tr bgcolor='#CED8F6'>";
        $html.="<td colspan='4'>EUROSCORE II</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Weight</td>";
        $html.="<td>".$c->patientBodyWeight."</td>";
        $html.="<td bgcolor='#edf0f4'>Serum Creatinine</td>";
        $html.="<td>".$c->patientSerumCreatinine."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Ccr before operation</td>";
        $html.="<td>".$c->CcrberforOperation."</td>";
        $html.="<td bgcolor='#edf0f4'>Renal impairment</td>";
        $html.="<td>".($c->pastHistoryRenalImpairment!=""?$Renalimpairment[$c->pastHistoryRenalImpairment]:"")."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Extracardiac arteriopathy</td>";
        $html.="<td>".$c->pastHistoryExtracardiacArteriopathy."</td>";
        $html.="<td bgcolor='#edf0f4'>Poor mobility</td>";
        $html.="<td>".$c->pastHistoryPoorMobility."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Previous cardiac surgery</td>";
        $html.="<td>".$c->pastHistoryPreviousCardiacSurgery."</td>";
        $html.="<td bgcolor='#edf0f4'>Chronic lung disease</td>";
        $html.="<td>".$c->pastHistoryChronicLungDisease."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Active endocarditis</td>";
        $html.="<td>".$c->pastHistoryActiveEndocarditis."</td>";
        $html.="<td bgcolor='#edf0f4'>Critical preoperative state</td>";
        $html.="<td>".$c->pastHistoryCriticalPreoperativeState."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Diabetes on insulin</td>";
        $html.="<td>".$c->pastHistoryDiabetesOnInsulin."</td>";
        $html.="<td bgcolor='#edf0f4'>NYHA</td>";
        $html.="<td>".($c->pastHistoryNYHA!=""?$NYHA[$c->pastHistoryNYHA]:"")."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>CCS class 4 angina</td>";
        $html.="<td>".$c->pastHistoryCCSClass4Angina."</td>";
        $html.="<td bgcolor='#edf0f4'>LV function</td>";
        $html.="<td>".($c->pastHistoryLVFunction!=""?$LVfunction[$c->pastHistoryLVFunction]:"")."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Recent MI</td>";
        $html.="<td>".$c->pastHistoryRecentMI."</td>";
        $html.="<td bgcolor='#edf0f4'>Pulmonary hypertension</td>";
        $html.="<td>".($c->pastHistoryPulmonaryHypertension!=""?$Pulmonary[$c->pastHistoryPulmonaryHypertension]:"")."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Urgency</td>";
        $html.="<td>".($c->pastHistoryUrgency!=""?$Urgency[$c->pastHistoryUrgency]:"")."</td>";
        $html.="<td bgcolor='#edf0f4'>Weight of the intervention</td>";
        $html.="<td>".($c->pastHistoryWeightOfTheIntervention!=""?$Weight[$c->pastHistoryWeightOfTheIntervention]:"")."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Surgery on thoracic aorta</td>";
        $html.="<td>".$c->pastHistorySurgeryThoracicAorta."</td>";
        $html.="<td bgcolor='#edf0f4'></td>";
        $html.="<td></td>";
        $html.="</tr>";
        
        $html.="<tr bgcolor='#CED8F6'>";
        $html.="<td colspan='4'>Operation procedures</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Surgeon 1</td>";
        $html.="<td>".$c->patientSurgeon."</td>";
        $html.="<td bgcolor='#edf0f4'>Surgeon 2</td>";
        $html.="<td>".$c->patientSurgeon2."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Surgeon 3</td>";
        $html.="<td>".$c->patientSurgeon3."</td>";
        $html.="<td bgcolor='#edf0f4'>Surgeon 4</td>";
        $html.="<td>".$c->patientSurgeon4."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Re-Operation</td>";
        $html.="<td>".$c->patientReoperation."</td>";
        $html.="<td bgcolor='#edf0f4'>Congenital surgery</td>";
        $html.="<td>".$c->patientCongenitalSurgery."</td>";
        $html.="</tr>";
        
        $html.="<tr bgcolor='#8DFEB5'>";
        $html.="<td colspan='4'>Open heart Surgery</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Diagnosis 1</td>";
        $html.="<td>".$c->AdultDiagnosis1."</td>";
        $html.="<td bgcolor='#edf0f4'>Diagnosis 2</td>";
        $html.="<td>".$c->AdultDiagnosis2."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Diagnosis 3</td>";
        $html.="<td>".$c->AdultDiagnosis3."</td>";
        $html.="<td bgcolor='#edf0f4'>Diagnosis 4</td>";
        $html.="<td>".$c->AdultDiagnosis4."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Diagnosis 5</td>";
        $html.="<td>".$c->AdultDiagnosis5."</td>";
        $html.="<td bgcolor='#edf0f4'>Diagnosis Others</td>";
        $html.="<td>".$c->AdultDiagnosisOthers."</td>";
        $html.="</tr>";
        if($c->operationCABG=='Y'){
            $html.="<tr bgcolor='#ECC8E7'>";
        $html.="<td colspan='4'>CABG</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>LIMA</td>";
        $html.="<td>".$c->operationLIMA."</td>";
        $html.="<td bgcolor='#edf0f4'>RIMA</td>";
        $html.="<td>".$c->operationRIMA."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Radial artery</td>";
        $html.="<td>".$c->operationRIMA_RadialA."</td>";
        $html.="<td bgcolor='#edf0f4'>Gastroepiploic artery</td>";
        $html.="<td>".$c->operationRIMA_GEA."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Vein graft</td>";
        $html.="<td>".$c->operationVeinGraft."</td>";
        $html.="<td bgcolor='#edf0f4'>Cardiopulmonary bypass</td>";
        $html.="<td>".$c->operationCardiopulmonaryBypass."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Cardiac arrest</td>";
        $html.="<td>".$c->operationCardiacArrest."</td>";
        $html.="<td bgcolor='#edf0f4'>備註</td>";
        $html.="<td>".$c->operationCABGMemo."</td>";
        $html.="</tr>";
        }
            if($c->operationAorticValve=='Y'){
            $html.="<tr bgcolor='#ECC8E7'>";
        $html.="<td colspan='4'>Aortic valve surgery</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Aortic valve plasty (AVP)</td>";
        $html.="<td>".$c->operationAorticValve_AVP."</td>";
        $html.="<td bgcolor='#edf0f4'></td>";
        $html.="<td>".$c->operationAVP."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Aortic valve replacement (AVR)</td>";
        $html.="<td>".$c->operationAorticValve_AVR."</td>";
        $html.="<td bgcolor='#edf0f4'></td>";
        $html.="<td>".$c->operationAVRSelect."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Bentall’s Op</td>";
        $html.="<td>".$c->operationMitralValveBentall."</td>";
        $html.="<td bgcolor='#edf0f4'>備註</td>";
        $html.="<td>".$c->operationAorticMemo."</td>";
        $html.="</tr>";
            }
              if($c->operationAorticSurgery=='Y'){
            $html.="<tr bgcolor='#ECC8E7'>";
        $html.="<td colspan='4'>Aortic surgery</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Dissection</td>";
        $html.="<td>".$c->operationDissection."</td>";
        $html.="<td bgcolor='#edf0f4'>Aneurysm</td>";
        $html.="<td>".$c->operationAneurysm."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Others</td>";
        $html.="<td>".$c->operationEtiologyOthers."</td>";
        $html.="<td bgcolor='#edf0f4'>Cardiopulmonary bypass</td>";
        $html.="<td>".$c->operationEtiologyCardiopulmonarBypass."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Cerebral protection</td>";
        $html.="<td>".$c->operationAorticSurgeryCerebralProtection."</td>";
        $html.="<td bgcolor='#edf0f4'>Location</td>";
        $html.="<td>".$c->operationAorticSurgeryLocation."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Method</td>";
        $html.="<td>".$c->operationAorticSurgeryMethod."</td>";
        $html.="<td bgcolor='#edf0f4'>備註</td>";
        $html.="<td>".$c->operationAorticSurgeryMemo."</td>";
        $html.="</tr>";
        }
          if($c->operationMitralValve=='Y'){
            $html.="<tr bgcolor='#ECC8E7'>";
        $html.="<td colspan='4'>Mitral valve surgery</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>MVP</td>";
        $html.="<td>".$c->Operation_MitralValve_MVP."</td>";
        $html.="<td bgcolor='#edf0f4'>Ring</td>";
        $html.="<td>".$c->operationMVPRing."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Artificial chordae</td>";
        $html.="<td>".$c->operationMVPArtificialChord."</td>";
        $html.="<td bgcolor='#edf0f4'>;Annular plication</td>";
        $html.="<td>".$c->operationMVPAnnularPlication."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Leaflet resection</td>";
        $html.="<td>".$c->operationMVPLeafletResection."</td>";
        $html.="<td bgcolor='#edf0f4'>Others</td>";
        $html.="<td>".$c->operationMVPOthers."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>MVR</td>";
        $html.="<td>".$c->Operation_MitralValve_MVR."</td>";
        $html.="<td bgcolor='#edf0f4'></td>";
        $html.="<td>".$c->operationMVR."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>備註</td>";
        $html.="<td>".$c->operationMVRMemo."</td>";
        $html.="<td bgcolor='#edf0f4'></td>";
        $html.="<td></td>";
        $html.="</tr>";
          }
    if($c->operationArrythmiaSurgery=='Y'){
            $html.="<tr bgcolor='#ECC8E7'>";
        $html.="<td colspan='4'>Arrhythmia surgery</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Maze (biatrial lesion + PVI)</td>";
        $html.="<td>".$c->operationMazebiatrialLesion."</td>";
        $html.="<td bgcolor='#edf0f4'>LA Maze (no RA lesion)</td>";
        $html.="<td>".$c->operationMazeLA."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>PVI with LAA closure</td>";
        $html.="<td>".$c->operationMazePVIwithLAA."</td>";
        $html.="<td bgcolor='#edf0f4'>PVI without LAA closure</td>";
        $html.="<td>".$c->operationMazePVIwithoutLAA."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Others</td>";
        $html.="<td>".$c->operationMazeOthers."</td>";
        $html.="<td bgcolor='#edf0f4'>Energy source</td>";
        $html.="<td>".$c->operationMazeEnergySource."</td>";
        $html.="</tr>";
        $html.="<td bgcolor='#edf0f4'>備註</td>";
        $html.="<td>".$c->operationMazeMemo."</td>";
        $html.="<td bgcolor='#edf0f4'></td>";
        $html.="<td></td>";
        $html.="</tr>";
    }
               if($c->operationTricuspidValve=='Y'){
            $html.="<tr bgcolor='#ECC8E7'>";
        $html.="<td colspan='4'>Tricuspid valve surgery</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>TVP</td>";
        $html.="<td>".$c->Operation_TricuspidValve_TVP."</td>";
        $html.="<td bgcolor='#edf0f4'>Ring</td>";
        $html.="<td>".$c->operationTVPRing."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Artificial chordae</td>";
        $html.="<td>".$c->operationTVPArtificialChord."</td>";
        $html.="<td bgcolor='#edf0f4'>Annular plication</td>";
        $html.="<td>".$c->operationTVPAnnularPlication."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Leaflet resection</td>";
        $html.="<td>".$c->operationTVPLeafletResection."</td>";
        $html.="<td bgcolor='#edf0f4'>Others</td>";
        $html.="<td>".$c->operationTVPOthers."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>TVR</td>";
        $html.="<td>".$c->Operation_TricuspidValve_TVR."</td>";
        $html.="<td bgcolor='#edf0f4'></td>";
        $html.="<td>".$c->operationTVR."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>備註</td>";
        $html.="<td>".$c->operationTricuspidValveMemo."</td>";
        $html.="<td bgcolor='#edf0f4'></td>";
        $html.="<td></td>";
        $html.="</tr>";
               }
            if($c->operationPulmonaryValve=='Y'){
            $html.="<tr bgcolor='#ECC8E7'>";
        $html.="<td colspan='4'>Pulmonary valve surgery</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>PVP</td>";
        $html.="<td>".$c->Operation_PulmonaryValve_PVP."</td>";
        $html.="<td bgcolor='#edf0f4'></td>";
        $html.="<td>".$c->operationPulmonaryValvePVP."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>PVR</td>";
        $html.="<td>".$c->Operation_PulmonaryValve_PVR."</td>";
        $html.="<td bgcolor='#edf0f4'></td>";
        $html.="<td>".$c->operationPulmonaryValvePVR."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>備註</td>";
        $html.="<td>".$c->operationPulmonaryValveMemo."</td>";
        $html.="<td bgcolor='#edf0f4'></td>";
        $html.="<td></td>";
        $html.="</tr>";
            }
             if($c->operationHeartTransplantation=='Y'){
            $html.="<tr bgcolor='#ECC8E7'>";
        $html.="<td colspan='4'>Heart transplant & Mechanical support</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Heart transplant</td>";
        $html.="<td>".$c->operationHeartTransplantationOP."</td>";
        $html.="<td bgcolor='#edf0f4'>LVAD</td>";
        $html.="<td>".$c->operationHeartTransplantationLVAD."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>RVAD</td>";
        $html.="<td>".$c->operationHeartTransplantationRVAD."</td>";
        $html.="<td bgcolor='#edf0f4'>備註</td>";
        $html.="<td>".$c->operationHeartTransplantationMemo."</td>";
        $html.="</tr>";
             }
               if($c->operationOtherCardiacSurgery=='Y'){
            $html.="<tr bgcolor='#ECC8E7'>";
        $html.="<td colspan='4'>Other cardiac surgery</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Repair of Post-MI free wall rupture</td>";
        $html.="<td>".$c->operationOtherCardiacSurgery1."</td>";
        $html.="<td bgcolor='#edf0f4'>Repair of Post-MI ventricular septal defect (VSR)</td>";
        $html.="<td>".$c->operationOtherCardiacSurgery2."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Repair of traumatic cardiac rupture</td>";
        $html.="<td>".$c->operationOtherCardiacSurgery3."</td>";
        $html.="<td bgcolor='#edf0f4'>Intracardiac tumor excision</td>";
        $html.="<td>".$c->operationOtherCardiacSurgery4."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Septal myectomy</td>";
        $html.="<td>".$c->operationOtherCardiacSurgery5."</td>";
        $html.="<td bgcolor='#edf0f4'>Pericardiectomy</td>";
        $html.="<td>".$c->operationOtherCardiacSurgery6."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>LV aneurysm surgery</td>";
        $html.="<td>".$c->operationOtherCardiacSurgery7."</td>";
        $html.="<td bgcolor='#edf0f4'>Pulmonary embolectomy</td>";
        $html.="<td>".$c->operationOtherCardiacSurgery8."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Pulmonary endarterectomy</td>";
        $html.="<td>".$c->operationOtherCardiacSurgery9."</td>";
        $html.="<td bgcolor='#edf0f4'>Cardiac Implantable Electronic Device lead insertion, replacement, or extraction</td>";
        $html.="<td>".$c->operationOtherCardiacSurgery11."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Others</td>";
        $html.="<td>".$c->operationOtherCardiacSurgery10."</td>";
        $html.="<td bgcolor='#edf0f4'>備註</td>";
        $html.="<td>".$c->operationOtherCardiacSurgeryMemo."</td>";
        $html.="</tr>";
               }

            $html.="<tr bgcolor='#8DFEB5'>";
        $html.="<td colspan='4'>Congenital Surgery</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Diagnosis 1</td>";
        $html.="<td>".$c->CongenitalDiagnosis1."</td>";
        $html.="<td bgcolor='#edf0f4'>Diagnosis 2</td>";
        $html.="<td>".$c->CongenitalDiagnosis2."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Diagnosis 3</td>";
        $html.="<td>".$c->CongenitalDiagnosis3."</td>";
        $html.="<td bgcolor='#edf0f4'>Diagnosis 4</td>";
        $html.="<td>".$c->CongenitalDiagnosis4."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Diagnosis 5</td>";
        $html.="<td>".$c->CongenitalDiagnosis5."</td>";
        $html.="<td bgcolor='#edf0f4'>Diagnosis Others</td>";
        $html.="<td>".$c->CongenitalDiagnosisOthers."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Primary Procedure</td>";
        $html.="<td>".$c->CongenitalProcedure1."</td>";
        $html.="<td bgcolor='#edf0f4'>Secondary Procedure 1</td>";
        $html.="<td>".$c->CongenitalProcedure2."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Secondary Procedure 2</td>";
        $html.="<td>".$c->CongenitalProcedure3."</td>";
        $html.="<td bgcolor='#edf0f4'>Secondary Procedure 3</td>";
        $html.="<td>".$c->CongenitalProcedure4."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Secondary Procedure 4</td>";
        $html.="<td>".$c->CongenitalProcedure5."</td>";
        $html.="<td bgcolor='#edf0f4'>Procedure Others</td>";
        $html.="<td>".$c->CongenitalProcedureOthers."</td>";
        $html.="</tr>";
        if($c->operationCongenitalBypass=='Y'){
            $html.="<tr bgcolor='#ECC8E7'>";
        $html.="<td colspan='4'>Bypass</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Total CPB time</td>";
        $html.="<td>".$c->operationCongenitalBypassCPBTime."</td>";
        $html.="<td bgcolor='#edf0f4'>Aortic cross clump time</td>";
        $html.="<td>".$c->operationCongenitalBypassAorticTime."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Circulatory arrest time</td>";
        $html.="<td>".$c->operationCongenitalBypassCirculatoryTime."</td>";
        $html.="<td bgcolor='#edf0f4'>Cardioplegia</td>";
        $html.="<td>".$c->operationCongenitalBypassCardioplegia."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>RACHS Class</td>";
        $html.="<td>".$c->operationCongenitalBypassRACHS."</td>";
        $html.="<td bgcolor='#edf0f4'>STS Mortality Category</td>";
        $html.="<td>".$c->operationCongenitalBypassSTS."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>備註</td>";
        $html.="<td>".$c->operationCongenitalBypassMemo."</td>";
        $html.="<td bgcolor='#edf0f4'></td>";
        $html.="<td></td>";
        $html.="</tr>";
        }

            $html.="<tr bgcolor='#CED8F6'>";
        $html.="<td colspan='4'>Outcome results</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Extubation date</td>";
        $html.="<td>".str_replace('0000-00-00', '', $c->outcomeExtubationDate)."</td>";
        $html.="<td bgcolor='#edf0f4'>Discharge date</td>";
        $html.="<td>".str_replace('0000-00-00', '', $c->patientDischargeDate)."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>出院狀況</td>";
        $html.="<td>".$c->outcomeStatus."</td>";
        $html.="<td bgcolor='#edf0f4'></td>";
        $html.="<td></td>";
        $html.="</tr>";
        if($c->patientCongenitalSurgery!='Y') {
            $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Operative Mortality</td>";
        $html.="<td>".$c->outcomeCheck1."</td>";
        $html.="<td colspan=2>".$c->outcomeData1."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Permanent Stroke</td>";
        $html.="<td>".$c->outcomeCheck2."</td>";
        $html.="<td colspan=2>".$c->outcomeData2."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Renal Failure</td>";
        $html.="<td>".$c->outcomeCheck3."</td>";
        $html.="<td colspan=2>".$c->outcomeData3."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Prolonged Ventilation > 24 hours</td>";
        $html.="<td>".$c->outcomeCheck4."</td>";
        $html.="<td colspan=2>".$c->outcomeData4."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Deep Sternal Wound Infection</td>";
        $html.="<td>".$c->outcomeCheck5."</td>";
        $html.="<td colspan=2>".$c->outcomeData5."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Reoperation For any reason</td>";
        $html.="<td>".$c->outcomeCheck6."</td>";
        $html.="<td colspan=2>".$c->outcomeData6."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Major Morbidity or Operative Mortality</td>";
        $html.="<td>".$c->outcomeCheck7."</td>";
        $html.="<td colspan=2>".$c->outcomeData7."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>LOS</td>";
        $html.="<td>".$c->outcomeCheck8."</td>";
        $html.="<td colspan=2>".$c->outcomeData8."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Short Stay: PLOS < 6 days</td>";
        $html.="<td>".$c->outcomeCheck9."</td>";
        $html.="<td colspan=2>".$c->outcomeData9."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Long Stay: PLOS >14 days</td>";
        $html.="<td>".$c->outcomeCheck10."</td>";
        $html.="<td colspan=2>".$c->outcomeData10."</td>";
        $html.="</tr>";
        } else  {
            $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Arrhythmia requiring drug therapy</td>";
        $html.="<td>".$c->outcomeChildComplication1."</td>";
        $html.="<td bgcolor='#edf0f4'>Arrhythmia requiring electrical cardioversion or defibrillation</td>";
        $html.="<td>".$c->outcomeChildComplication2."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Arrhythmia requiring Temporary pacemaker </td>";
        $html.="<td>".$c->outcomeChildComplication3."</td>";
        $html.="<td bgcolor='#edf0f4'>Bleeding, requiring reoperation</td>";
        $html.="<td>".$c->outcomeChildComplication4."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Cardiac dysfunction resulting in low cardiac output</td>";
        $html.="<td>".$c->outcomeChildComplication5."</td>";
        $html.="<td bgcolor='#edf0f4'>Cardiac failure (severe cardiac dysfunction)</td>";
        $html.="<td>".$c->outcomeChildComplication6."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Chylothorax</td>";
        $html.="<td>".$c->outcomeChildComplication7."</td>";
        $html.="<td bgcolor='#edf0f4'>Endocarditis­postprocedural infective endocarditis</td>";
        $html.="<td>".$c->outcomeChildComplication8."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Intraventricular hemorrhage (IVH) > grade 2</td>";
        $html.="<td>".$c->outcomeChildComplication9."</td>";
        $html.="<td bgcolor='#edf0f4'>Mechanical circulatory support (IABP, VAD, ECMO, or CPS)</td>";
        $html.="<td>".$c->outcomeChildComplication10."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Multi­System Organ Failure (MSOF) = Multi­Organ Dysfunction Syndrome (MODS)</td>";
        $html.="<td>".$c->outcomeChildComplication11."</td>";
        $html.="<td bgcolor='#edf0f4'>Neurological deficit diagnosed in the operating room, persisting at discharge or 91 days if patient is still in hospital.</td>";
        $html.="<td>".$c->outcomeChildComplication12."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Neurological deficit diagnosed in the operating room, not present at discharge</td>";
        $html.="<td>".$c->outcomeChildComplication13."</td>";
        $html.="<td bgcolor='#edf0f4'>Neurological deficit that occurred after the operating room visit, persisting at discharge</td>";
        $html.="<td>".$c->outcomeChildComplication14."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Neurological deficit that occurred after the operating room visit, not present at discharge</td>";
        $html.="<td>".$c->outcomeChildComplication15."</td>";
        $html.="<td bgcolor='#edf0f4'>Paralyzed diaphragm (possible phrenic nerve injury)</td>";
        $html.="<td>".$c->outcomeChildComplication16."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Pericardial Effusion, requiring drainage</td>";
        $html.="<td>".$c->outcomeChildComplication17."</td>";
        $html.="<td bgcolor='#edf0f4'>Peripheral nerve injury persisting at discharge or 91 days if patient is still in hospita</td>";
        $html.="<td>".$c->outcomeChildComplication18."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Peripheral nerve injury not present at discharge or 91 days if patient is still in hospital</td>";
        $html.="<td>".$c->outcomeChildComplication19."</td>";
        $html.="<td bgcolor='#edf0f4'>Postoperative/Postprocedural respiratory insufficiency requiring mechanical ventilatory support > 7 days</td>";
        $html.="<td>".$c->outcomeChildComplication20."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Postoperative/Postprocedural respiratory insufficiency requiring reintubation</td>";
        $html.="<td>".$c->outcomeChildComplication21."</td>";
        $html.="<td bgcolor='#edf0f4'>Pulmonary vein obstruction</td>";
        $html.="<td>".$c->outcomeChildComplication22."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Renal failure ­ acute renal failure, Acute renal failure requiring dialysis at the time of hospital discharge or 91 days if patient is still in hospital</td>";
        $html.="<td>".$c->outcomeChildComplication23."</td>";
        $html.="<td bgcolor='#edf0f4'>Renal failure ­ acute renal failure, Acute renal failure requiring temporary dialysis with the need for dialysis not present at hospital discharge or 91 days if patient is still in hospital</td>";
            $html.="<td>".$c->outcomeChildComplication24."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Renal failure ­ acute renal failure, Acute renal failure requiring temporary hemofiltration with the need for dialysis not present at hospital discharge or 91 days if patient is still in hospital</td>";
            $html.="<td>".$c->outcomeChildComplication25."</td>";
        $html.="<td bgcolor='#edf0f4'>Respiratory failure, requiring tracheostomy</td>";
        $html.="<td>".$c->outcomeChildComplication26."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Seizure</td>";
        $html.="<td>".$c->outcomeChildComplication27."</td>";
        $html.="<td bgcolor='#edf0f4'>Sepsis</td>";
        $html.="<td>".$c->outcomeChildComplication28."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Sternum left open, unplanned</td>";
        $html.="<td>".$c->outcomeChildComplication29."</td>";
        $html.="<td bgcolor='#edf0f4'>Stroke: Ischemic</td>";
        $html.="<td>".$c->outcomeChildComplication30."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Subdural Bleed </td>";
        $html.="<td>".$c->outcomeChildComplication31."</td>";
        $html.="<td bgcolor='#edf0f4'>Systemic vein obstruction</td>";
        $html.="<td>".$c->outcomeChildComplication32."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>>Unplanned cardiac reoperation during the postoperative or postprocedural time period, exclusive of reoperation for bleeding</td>";
        $html.="<td>".$c->outcomeChildComplication33."</td>";
        $html.="<td bgcolor='#edf0f4'>Vocal cord dysfunction (possible recurrent laryngeal nerve injury) </td>";
        $html.="<td>".$c->outcomeChildComplication34."</td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'>Wound infection­Mediastinitis</td>";
        $html.="<td>".$c->outcomeChildComplication35."</td>";
        $html.="<td bgcolor='#edf0f4'>Wound infection­Superficial wound infection</td>";
        $html.="<td>".$c->outcomeChildComplication36."</td>";
        $html.="</tr>";
        $html.="<tr bgcolor='#ECC8E7'>";
        $html.="<td colspan='4'>Primary Cause of Death </td>";
        $html.="</tr>";
        $html.="<tr>";
        $html.="<td bgcolor='#edf0f4'></td>";
        $html.="<td colspan='4'>".($c->outcomeChildCauseofDeath!=""?$CauseofDeath[$c->outcomeChildCauseofDeath]:"X")."</td>";
        $html.="</tr>";
        }
        return $html;
             
         }

    function addSurgeonID(){
             $this->load->model('PatientInformation_Model');
         $this->load->model('user_Model');
         $p=$this->PatientInformation_Model->query_patientlist("","","",0,0);
         foreach($p->result() as $row){
                 $column = $this->PatientInformation_Model->viewRecord($row->patientID)->row();
              if($column->patientSurgeon!=""){
                        $surgeon=$this->user_Model->queryUserbyRealname($column->patientSurgeon);
                  if($surgeon->num_rows() ==1){
                               $column->patientSurgeon_id=$surgeon->row()->userID;
                     $column->patientSurgeon_associalid=$surgeon->row()->associateID;
                     }
                          }
                        if($column->patientSurgeon2!=""){
                        $surgeon2=$this->user_Model->queryUserbyRealname($column->patientSurgeon2);
                if($surgeon2->num_rows() ==1) {
                             $column->patientSurgeon_id2=$surgeon2->row()->userID;
                     $column->patientSurgeon_associalid2=$surgeon2->row()->associateID;
                }
                        }
                        if($column->patientSurgeon3!=""){
                        $surgeon3=$this->user_Model->queryUserbyRealname($column->patientSurgeon3);
                if($surgeon3->num_rows() ==1) {
                               $column->patientSurgeon_id3=$surgeon3->row()->userID;
                     $column->patientSurgeon_associalid3=$surgeon3->row()->associateID;
                }
                        }
                        if($column->patientSurgeon4!=""){
                        $surgeon4=$this->user_Model->queryUserbyRealname($column->patientSurgeon4);
                if($surgeon4->num_rows() ==1){
                             $column->patientSurgeon_id4=$surgeon4->row()->userID;
                   $column->patientSurgeon_associalid4=$surgeon->row()->associateID;
                }
                        }
                        $this->PatientInformation_Model->Update_patient($column->patientID, $column);
         }
    }
  function uncompleteMemo(){
        $this->load->view('patient/uncompleteMemo');
  }
  function CHDMemo(){
      $this->load->view('patient/CHDMemo');
  }
  
  public function deleteAttachment($id){
        if($this->session->userdata('userID')=="")
        redirect(base_url().'home', 'refresh');
        
          $data['page']="index";   
          $data['patientpage']="divPatientProfiles"; 
                
          $data['msg']="學會同意書刪除成功";    
          $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
          $this->load->model('PatientInformation_Model');
     
        $this->load->library('patientinformationClass');
      //  $id=$this->input->post('nid');
                $patientinformationClass= new patientinformationClass;
                $patientinformationClass = $this->PatientInformation_Model->viewRecord($id)->row();
                 $this->load->helper("file");
                            //echo $advertisementClass->abanner;
                        unlink('./uploads/'.$patientinformationClass->agreement);
                        
                $patientinformationClass->agreement='';
                
       
        $this->PatientInformation_Model->Update_patient($id, $patientinformationClass);
       
         $column = $this->PatientInformation_Model->viewRecord($id);
            $data['myContent']=$column;  
             //query LVAD count
                     $data['LVADCount'] = $this->PatientInformation_Model->query_LVADCount()->row()->LVADCount;
            //query data permission beginning
            $data['dataPermission']="N";
        $dataOwnerID=$column->row()->patientSurgeon_id;
        $this->load->model('user_Model');
         if($dataOwnerID=="" || $dataOwnerID==$this->session->userdata('userID') || $this->user_Model->query_user($dataOwnerID)->row()->vsPermission=="1" || $this->PatientInformation_Model->queryDataOwner($dataOwnerID,$this->session->userdata('userID'))->num_rows() >=1){
            $data['dataPermission']="Y";
        }
      //query data permission ending
            //Select data History beginning
                  $column = $this->PatientInformation_Model->qryPatientHistory($id);
            $data['dataHistory']=$column;  
             //Select data History end
            $this->load->model('Parameter_Model'); 
        
        $vsList = $this->Parameter_Model->query_vsList();
        $data['vsList']=$vsList;  
                 $this->load->view('patient/content',$data);
                 
 }

  public function deleteHospitalAttachment($id){
        if($this->session->userdata('userID')=="")
        redirect(base_url().'home', 'refresh');
        
          $data['page']="index";   
          $data['patientpage']="divPatientProfiles"; 
                
          $data['msg']="醫院同意書刪除成功";    
          $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
          $this->load->model('PatientInformation_Model');
     
        $this->load->library('patientinformationClass');
      //  $id=$this->input->post('nid');
                $patientinformationClass= new patientinformationClass;
                $patientinformationClass = $this->PatientInformation_Model->viewRecord($id)->row();
                 $this->load->helper("file");
                            //echo $advertisementClass->abanner;
                        unlink('./uploads/'.$patientinformationClass->hospitalagreement);
                        
                $patientinformationClass->hospitalagreement='';
                
       
        $this->PatientInformation_Model->Update_patient($id, $patientinformationClass);
       
         $column = $this->PatientInformation_Model->viewRecord($id);
            $data['myContent']=$column;  
             //query LVAD count
                     $data['LVADCount'] = $this->PatientInformation_Model->query_LVADCount()->row()->LVADCount;
            //query data permission beginning
            $data['dataPermission']="N";
        $dataOwnerID=$column->row()->patientSurgeon_id;
        $this->load->model('user_Model');
         if($dataOwnerID=="" || $dataOwnerID==$this->session->userdata('userID') || $this->user_Model->query_user($dataOwnerID)->row()->vsPermission=="1" || $this->PatientInformation_Model->queryDataOwner($dataOwnerID,$this->session->userdata('userID'))->num_rows() >=1){
            $data['dataPermission']="Y";
        }
      //query data permission ending
            //Select data History beginning
                  $column = $this->PatientInformation_Model->qryPatientHistory($id);
            $data['dataHistory']=$column;  
             //Select data History end
            $this->load->model('Parameter_Model'); 
        
        $vsList = $this->Parameter_Model->query_vsList();
        $data['vsList']=$vsList;  
                 $this->load->view('patient/content',$data);
                 
 }

function LVAD(){
    $this->load->library('session');
        if($this->session->userdata('userID')=="" )
             redirect(base_url().'homenew', 'refresh');
           
        $this->load->model('PatientInformation_Model');
        
        $patientID=$this->input->post('patientID');
        
        $this->load->library('patientinformationClass');
        
               // $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                $patientinformationClass= new patientinformationClass;
                $patientinformationClassOrignal= new patientinformationClass;
                $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                $patientinformationClassOrignal=$this->PatientInformation_Model->viewRecord($patientID)->row();
                $patientinformationClass->patientID=$patientID;
                $patientinformationClass->LVADmachineLVAD=$this->input->post('LVADmachineLVAD');
                $patientinformationClass->LVADmachineRVAD=$this->input->post('LVADmachineRVAD');
                $patientinformationClass->LVADIntermacsLevel=$this->input->post('LVADIntermacsLevel');
                $patientinformationClass->pastHistoryNYHA=$this->input->post('LVADNYHAClass');
                $patientinformationClass->LVADPeakVO2=$this->input->post('LVADPeakVO2');
                $patientinformationClass->LVADIVinotropicLarge14days=$this->input->post('LVADIVinotropicLarge14days')==null?'':$this->input->post('LVADIVinotropicLarge14days');
                $patientinformationClass->LVADIIABPSupportLarge7days=$this->input->post('LVADIIABPSupportLarge7days')==null?'':$this->input->post('LVADIIABPSupportLarge7days');
                $patientinformationClass->LVADPreOperativeVentlator=$this->input->post('LVADPreOperativeVentlator')==null?'':$this->input->post('LVADPreOperativeVentlator');
                $patientinformationClass->LVADECMOSupport=$this->input->post('LVADECMOSupport')==null?'':$this->input->post('LVADECMOSupport');
                $patientinformationClass->patientSerumCreatinine=$this->input->post('LVADCreatinine');
                $patientinformationClass->LVADDialysis=$this->input->post('LVADDialysis');
                $patientinformationClass->LVADBUN=$this->input->post('LVADBUN');
                $patientinformationClass->LVADAlbumin=$this->input->post('LVADAlbumin');
                $patientinformationClass->LVADINR=$this->input->post('LVADINR');
                $patientinformationClass->LVADBilirubin=$this->input->post('LVADBilirubin');
                $patientinformationClass->LVADHeartRate=$this->input->post('LVADHeartRate');
                $patientinformationClass->LVADCVPLevel=$this->input->post('LVADCVPLevel');
                $patientinformationClass->LVADPulmonary=$this->input->post('LVADPulmonary');
                $patientinformationClass->LVADLVEF=$this->input->post('LVADLVEF');
                $patientinformationClass->LVADSevereRV=$this->input->post('LVADSevereRV')==null?'':$this->input->post('LVADSevereRV');
                $patientinformationClass->LVADSevereTR=$this->input->post('LVADSevereTR')==null?'':$this->input->post('LVADSevereTR');
                $patientinformationClass->LVADHMRS=$this->input->post('LVADHMRS');
                $patientinformationClass->LVADHMRSRisk=$this->input->post('LVADHMRSRisk');
                $patientinformationClass->LVADHMRS90DaysMortality=$this->input->post('LVADHMRS90DaysMortality');
                $patientinformationClass->LVADCRITT=$this->input->post('LVADCRITTScore');
                $patientinformationClass->LVADCRITTNote=$this->input->post('LVADCRITTNote');
              
              
                $this->PatientInformation_Model->Update_patient($patientID, $patientinformationClass);
                $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                 if(comparePatient($patientinformationClassOrignal,$patientinformationClass)=="Y"){
                                   
                       $access_id=accessLog('U','PATIENT',$patientID,$this->session->userdata('userRealname').'修改病患資料【LVAD Special Sheet】(病歷號:'.$patientinformationClass->patientChartNumber.')','S');
                                   $patientinformationClassOrignal->patientID=null;
                       $patientinformationClassOrignal->SyntaxScoreDominance='1';
                       $patientinformationClassOrignal->isSaved=$access_id;
                       $patientinformationClass->patientID=null;
                       $patientinformationClass->SyntaxScoreDominance='2';
                       $patientinformationClass->isSaved=$access_id;
                       $this->PatientInformation_Model->Save_patienthistory($patientinformationClassOrignal);
                       $this->PatientInformation_Model->Save_patienthistory($patientinformationClass);
                       
                } 
                //$this->PatientInformation_Model->Update_patient($patientID, $patientinformationClass);
                
                            $data['page']="index";   
                      $data['patientpage']="divLVAD";  
                   $data['msg']="LVAD Special Sheet Saved";   
                    $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
                   $column = $this->PatientInformation_Model->viewRecord($patientID);
                     $data['myContent']=$column; 
                     //query LVAD count
                     $data['LVADCount'] = $this->PatientInformation_Model->query_LVADCount()->row()->LVADCount;
                     //query data permission beginning
            $data['dataPermission']="N";
        $dataOwnerID=$column->row()->patientSurgeon_id;
        $this->load->model('user_Model');
        if($dataOwnerID=="" || $dataOwnerID==$this->session->userdata('userID') || $this->user_Model->query_user($dataOwnerID)->row()->vsPermission=="1" || $this->PatientInformation_Model->queryDataOwner($dataOwnerID,$this->session->userdata('userID'))->num_rows() >=1){
            $data['dataPermission']="Y";
        }
      //query data permission ending
                            //Select data History beginning
                            $column = $this->PatientInformation_Model->qryPatientHistory($patientID);
                     $data['dataHistory']=$column;  
                            //Select data History end   
                            $this->load->model('Parameter_Model');
                       
                        $vsList = $this->Parameter_Model->query_vsList();
                        $data['vsList']=$vsList;  
                  $this->load->view('patient/content',$data);
  }

function LVADHelp1(){
       
    $this->load->view('patient/LVADHelper1');
}
function LVADHelp2(){
       
    $this->load->view('patient/LVADHelper2');
}
function LVADHelp3(){
       
    $this->load->view('patient/LVADHelper3');
}

//AJAX
    function queryExistPatient(){

         $chart=$this->input->post('chart');
      $opdate=$this->input->post('opdate');
       $this->load->model('PatientInformation_Model');
       $query=$this->PatientInformation_Model->viewRecordByChart($chart,$opdate);

        

         $arr=array('status'=>'success','result'=>$query->result());

         echo json_encode($arr);

    }
     function queryExistEvaluation(){

         $chart=$this->input->post('chart');
      $opdate=$this->input->post('opdate');
       $this->load->model('PatientInformation_Model');
       $query=$this->PatientInformation_Model->viewEvaluationByChart($chart,$opdate);

        

         $arr=array('status'=>'success','result'=>$query->result());

         echo json_encode($arr);

    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */