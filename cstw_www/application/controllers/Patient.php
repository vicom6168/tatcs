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
    
	public function index($qryHospital="0",$qryOrder="0",$qryStr='999999999',$page=0)
	{
	     $this->load->library('session');
        if($this->session->userdata('userID')=="")
        redirect(base_url().'home/home', 'refresh');
      if($qryStr=="" || $qryStr=="Keyword" )
           $qryStr="";
      
      $qryHospital=urldecode($qryHospital);
        $data['result_msg']='';
        //$this->load->view('home/home',$data);
         $this->load->model('PatientInformation_Model');
      $this->load->model('Parameter_Model');
      //  $column = $this->PatientInformation_Model->query_patientlist();
            $config['per_page'] = 20; 
        $data['patientList']=$this->PatientInformation_Model->query_patientlist($qryHospital,$qryOrder,urldecode($qryStr),$page,$config['per_page']);
        $config['total_rows'] = $this->PatientInformation_Model->query_patientlist($qryHospital,$qryOrder,urldecode($qryStr),0,0)->num_rows() ;
        $config['base_url'] = base_url().'patient/index/'.$qryHospital.'/'.$qryOrder.'/'.$qryStr;
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
        $data['qOrder']=$qryOrder;
        $this->load->model('Hospital_Model');
        $hospital = $this->Hospital_Model->query_hospitalList();  
        $data['hospitalList']=$hospital;
        $data['qHospital']=$qryHospital;
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
        $data['cancerpage']="";
        $data['msg']="";  
        $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
        $this->load->model('PatientInformation_Model'); 
       
        if($pid!='')
            $column = $this->PatientInformation_Model->viewRecord($pid);
        $data['myContent']=$column;  
         
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
        $procedureCatList = $this->Parameter_Model->query_procedureCategoryList();
        $data['procedureCatList']=$procedureCatList;  
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
        $procedureCatList = $this->Parameter_Model->query_procedureCategoryList();
        $data['procedureCatList']=$procedureCatList;  
        $this->load->view('patient/syntaxscore',$data);
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
              $data['cancerpage']="";
           // $data['msg']="Patient Profiles Saved";    
            $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
       //  echo "AAAAAAAAAAAAAA".$this->upload->display_errors();
          
         $column = $this->PatientInformation_Model->viewRecord($patientID);
         $data['myContent']=$column;  
          
             //Select data History end
            $this->load->model('Parameter_Model'); 
        
        $vsList = $this->Parameter_Model->query_vsList();
        $data['vsList']=$vsList;  
        $procedureCatList = $this->Parameter_Model->query_procedureCategoryList();
        $data['procedureCatList']=$procedureCatList;  
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
              $data['cancerpage']="";
                
           // $data['msg']="Patient Profiles Saved";    
            $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
       //  echo "AAAAAAAAAAAAAA".$this->upload->display_errors();
          
         $column = $this->PatientInformation_Model->viewRecord($patientID);
         $data['myContent']=$column;  
       
             //Select data History end
            $this->load->model('Parameter_Model'); 
        
        $vsList = $this->Parameter_Model->query_vsList();
        $data['vsList']=$vsList;  
        $procedureCatList = $this->Parameter_Model->query_procedureCategoryList();
        $data['procedureCatList']=$procedureCatList;  
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
                $patientinformationClass->patientOpDate=$this->input->post('patientOpDate');
                $patientinformationClass->AdmissionDate=$this->input->post('AdmissionDate');
                $patientinformationClass->DischargeDate=$this->input->post('DischargeDate');
                $patientinformationClass->ICUAdmissionDate=$this->input->post('ICUAdmissionDate');
                $patientinformationClass->ICUDischargeDate=$this->input->post('ICUDischargeDate');
                $patientinformationClass->ExtubationDate=$this->input->post('ExtubationDate');
                $patientinformationClass->patientDiagnosis=$this->input->post('patientDiagnosis');
                $patientinformationClass->patientAssociatedDisease=$this->input->post('patientAssociatedDisease');
                
                $patientinformationClass->LOS=$this->input->post('LOS');
                $patientinformationClass->ICU_LOS=$this->input->post('ICU_LOS');
               
                          if(isset($_FILES['agreement']['tmp_name']) && $_FILES['agreement']['tmp_name']!="" ){
                        $patientinformationClass->agreement=$uploaddata['upload_data']['file_name'];
                    }
                              if(isset($_FILES['hospitalagreement']['tmp_name']) && $_FILES['hospitalagreement']['tmp_name']!="" ){
                        $patientinformationClass->hospitalagreement=$uploaddatahospital['upload_data_hospital']['file_name'];
                    }
                $this->PatientInformation_Model->Update_patient($patientID, $patientinformationClass);
           $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
           if(comparePatient($patientinformationClassOrignal,$patientinformationClass)=="Y"){
                
           $access_id=accessLog('U','PATIENT',$patientID,$this->session->userdata('userRealname').'修改病患資料【基本資料】(病歷號:'.$patientinformationClass->patientChartNumber.')','S');
           $patientinformationClassOrignal->patientID=null;
           $patientinformationClassOrignal->modifiedFlag='1';
           $patientinformationClassOrignal->isSaved=$access_id;
           $patientinformationClass->patientID=null;
           $patientinformationClass->modifiedFlag='2';
           $patientinformationClass->isSaved=$access_id;
           $this->PatientInformation_Model->Save_patienthistory($patientinformationClassOrignal);
           $this->PatientInformation_Model->Save_patienthistory($patientinformationClass);
           
                } 
                 // $this->calEuroScore($patientinformationClass);
                 // $this->calCCRScore($patientinformationClass);
                 $data['page']="index";   
              $data['patientpage']="divPatientProfiles"; 
                $data['cancerpage']="";
            $data['msg']="基本資料存檔完成";    
            $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
            $column = $this->PatientInformation_Model->viewRecord($patientID);
            $data['myContent']=$column;  
           
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
        $procedureCatList = $this->Parameter_Model->query_procedureCategoryList();
        $data['procedureCatList']=$procedureCatList;  
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
                
                $patientinformationClass->outcomeMortalityCheck=$this->input->post('outcomeMortalityCheck')==null?"N":"Y";
                $patientinformationClass->outcomeMortalityNote=$this->input->post('outcomeMortalityNote');
                $patientinformationClass->outcomeInfectionCheck=$this->input->post('outcomeInfectionCheck')==null?"N":"Y";
                $patientinformationClass->outcomeInfectionNote=$this->input->post('outcomeInfectionNote');
                $patientinformationClass->outcomeReoperationCheck=$this->input->post('outcomeReoperationCheck')==null?"N":"Y";
                $patientinformationClass->outcomeReoperationNote=$this->input->post('outcomeReoperationNote');
                
                $patientinformationClass->outcomePneumoniaCheck=$this->input->post('outcomePneumoniaCheck')==null?"N":"Y";
                $patientinformationClass->outcomePneumoniaNote=$this->input->post('outcomePneumoniaNote');
                $patientinformationClass->outcomeIntubationCheck=$this->input->post('outcomeIntubationCheck')==null?"N":"Y";
                $patientinformationClass->outcomeIntubationNote=$this->input->post('outcomeIntubationNote');
                $patientinformationClass->outcomeHemothoraxCheck=$this->input->post('outcomeHemothoraxCheck')==null?"N":"Y";
                $patientinformationClass->outcomeHemothoraxNote=$this->input->post('outcomeHemothoraxNote');
                $patientinformationClass->outcomePneumothoraxCheck=$this->input->post('outcomePneumothoraxCheck');
                $patientinformationClass->outcomePneumothoraxNote=$this->input->post('outcomePneumothoraxNote');
                $patientinformationClass->outcomeBPFistulaCheck=$this->input->post('outcomeBPFistulaCheck')==null?"N":"Y";
                $patientinformationClass->outcomeBPFistulaNote=$this->input->post('outcomeBPFistulaNote');
                $patientinformationClass->outcomeChylothoraxCheck=$this->input->post('outcomeChylothoraxCheck')==null?"N":"Y";
                $patientinformationClass->outcomeChylothoraxNote=$this->input->post('outcomeChylothoraxNote');
                $patientinformationClass->outcomeAnastomosisCheck=$this->input->post('outcomeAnastomosisCheck')==null?"N":"Y";
                $patientinformationClass->outcomeAnastomosisNote=$this->input->post('outcomeAnastomosisNote');
                $patientinformationClass->outcomeIleusCheck=$this->input->post('outcomeIleusCheck')==null?"N":"Y";
                $patientinformationClass->outcomeIleusNote=$this->input->post('outcomeIleusNote');
                $patientinformationClass->outcomeAspirationCheck=$this->input->post('outcomeAspirationCheck')==null?"N":"Y";
                $patientinformationClass->outcomeAspirationNote=$this->input->post('outcomeAspirationNote');
                $patientinformationClass->outcomeDysphagiaCheck=$this->input->post('outcomeDysphagiaCheck')==null?"N":"Y";
                $patientinformationClass->outcomeDysphagiaNote=$this->input->post('outcomeDysphagiaNote');
                $patientinformationClass->outcomeArrthymiaCheck=$this->input->post('outcomeArrthymiaCheck')==null?"N":"Y";
                $patientinformationClass->outcomeArrthymiaNote=$this->input->post('outcomeArrthymiaNote');
                $patientinformationClass->outcomeOthersCheck=$this->input->post('outcomeOthersCheck')==null?"N":"Y";
                $patientinformationClass->outcomeOthersNote=$this->input->post('outcomeOthersNote');
                  
                
                
                $patientinformationClass->outcomeStatus=$this->input->post('outcomeStatus');
               
                $this->PatientInformation_Model->Update_patient($patientID, $patientinformationClass);
                 $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                 if(comparePatient($patientinformationClassOrignal,$patientinformationClass)=="Y"){
                             
                   $access_id=accessLog('U','PATIENT',$patientID,$this->session->userdata('userRealname').'修改病患資料【併發症及結果】(病歷號:'.$patientinformationClass->patientChartNumber.')','S');
                    $patientinformationClassOrignal->patientID=null;
                  $patientinformationClassOrignal->modifiedFlag='1';
                   $patientinformationClassOrignal->isSaved=$access_id;
                   $patientinformationClass->patientID=null;
                   $patientinformationClass->modifiedFlag='2';
                   $patientinformationClass->isSaved=$access_id;
                   $this->PatientInformation_Model->Save_patienthistory($patientinformationClassOrignal);
                   $this->PatientInformation_Model->Save_patienthistory($patientinformationClass);
           
                } 
                //$this->PatientInformation_Model->Update_patient($patientID, $patientinformationClass);
                $data['page']="index";   
            $data['patientpage']="divOutcome"; 
            $data['cancerpage']="";
                  $data['msg']="併發症及結果存檔完成";   
                  $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
                  $column = $this->PatientInformation_Model->viewRecord($patientID);
                   $data['myContent']=$column;    
                  
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
                        $procedureCatList = $this->Parameter_Model->query_procedureCategoryList();
        $data['procedureCatList']=$procedureCatList;  
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
                 $patientinformationClass->diseaseType=$this->input->post('diseaseType');
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
                
                $patientinformationClass->ProcedureOthers=$this->input->post('ProcedureOthers');
                        //20161201修改開始
                        $patientinformationClass->patientSurgeon=$this->input->post('patientSurgeon');
                $patientinformationClass->patientSurgeon2=$this->input->post('patientSurgeon2');
                $patientinformationClass->patientSurgeon3=$this->input->post('patientSurgeon3');
                $patientinformationClass->patientSurgeon4=$this->input->post('patientSurgeon4');
                $patientinformationClass->patientReoperation=$this->input->post('patientReoperation');
                
                   
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
                      
                $this->PatientInformation_Model->Update_patient($patientID, $patientinformationClass);
                $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                        //20170214修改結束
                if(comparePatient($patientinformationClassOrignal,$patientinformationClass)=="Y"){
               
           $access_id=accessLog('U','PATIENT',$patientID,$this->session->userdata('userRealname').'修改病患資料【診斷及手術】(病歷號:'.$patientinformationClass->patientChartNumber.')','S');
                $patientinformationClassOrignal->patientID=null;
           $patientinformationClassOrignal->modifiedFlag='1';
           $patientinformationClassOrignal->isSaved=$access_id;
           $patientinformationClass->patientID=null;
          $patientinformationClass->modifiedFlag='2';
           $patientinformationClass->isSaved=$access_id;
           $this->PatientInformation_Model->Save_patienthistory($patientinformationClassOrignal);
           $this->PatientInformation_Model->Save_patienthistory($patientinformationClass);
                }
                        //$this->PatientInformation_Model->Update_patient($patientID, $patientinformationClass);
                $data['page']="index";   
            $data['patientpage']="divOperation";  
            $data['cancerpage']=""; 
                  $data['msg']="手術及診斷資料存檔完成";  
                  $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
                  $column = $this->PatientInformation_Model->viewRecord($patientID);
                  $data['myContent']=$column;  
               
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
                     $procedureCatList = $this->Parameter_Model->query_procedureCategoryList();
        $data['procedureCatList']=$procedureCatList;  
                 $this->load->view('patient/content',$data);
  }
  
function cancerLifestyle(){
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
                 $patientinformationClass->CancerLSHeight=$this->input->post('CancerLSHeight');
                 $patientinformationClass->CancerLSWeight=$this->input->post('CancerLSWeight');
                 $patientinformationClass->CancerLSSmokingAmount=$this->input->post('CancerLSSmokingAmount');
                 $patientinformationClass->CancerLSSmokingYear=$this->input->post('CancerLSSmokingYear');
                 $patientinformationClass->CancerLSSmokingQuitYear=$this->input->post('CancerLSSmokingQuitYear');
                 $patientinformationClass->CancerLSBetelNutsAmount=$this->input->post('CancerLSBetelNutsAmount');
                 $patientinformationClass->CancerLSBetelNutsYear=$this->input->post('CancerLSBetelNutsYear');
                 $patientinformationClass->CancerLSBetelNutsQuitYear=$this->input->post('CancerLSBetelNutsQuitYear');
                 $patientinformationClass->CancerLSDrinking=$this->input->post('CancerLSDrinking');
                 $patientinformationClass->CancerLSKPS_ECOG=$this->input->post('CancerLSKPS_ECOG');
                 
                        
                          //20170214修改開始
                      
                $this->PatientInformation_Model->Update_patient($patientID, $patientinformationClass);
                $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                        //20170214修改結束
                if(comparePatient($patientinformationClassOrignal,$patientinformationClass)=="Y"){
               
           $access_id=accessLog('U','PATIENT',$patientID,$this->session->userdata('userRealname').'修改病患資料【病史資料:生活型態】(病歷號:'.$patientinformationClass->patientChartNumber.')','S');
                $patientinformationClassOrignal->patientID=null;
           $patientinformationClassOrignal->modifiedFlag='1';
           $patientinformationClassOrignal->isSaved=$access_id;
           $patientinformationClass->patientID=null;
          $patientinformationClass->modifiedFlag='2';
           $patientinformationClass->isSaved=$access_id;
           $this->PatientInformation_Model->Save_patienthistory($patientinformationClassOrignal);
           $this->PatientInformation_Model->Save_patienthistory($patientinformationClass);
                }
                        //$this->PatientInformation_Model->Update_patient($patientID, $patientinformationClass);
                $data['page']="index";   
            $data['patientpage']="divCancer"; 
            $data['cancerpage']="";  
                  $data['msg']="生活型態資料存檔完成";  
                  $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
                  $column = $this->PatientInformation_Model->viewRecord($patientID);
                  $data['myContent']=$column;  
               
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
                     $procedureCatList = $this->Parameter_Model->query_procedureCategoryList();
        $data['procedureCatList']=$procedureCatList;  
                 $this->load->view('patient/content',$data);
  }
 function cancerTherapy(){
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
                 $patientinformationClass->CancerSysDxDate=$this->input->post('CancerSysDxDate');
                 $patientinformationClass->CancerRadiotherapy_initialDate=$this->input->post('CancerRadiotherapy_initialDate');
                 $patientinformationClass->CancerRadiotherapy_endDate=$this->input->post('CancerRadiotherapy_endDate');
                 $patientinformationClass->CancerChemotherapy_PreCT=$this->input->post('CancerChemotherapy_PreCT');
                 $patientinformationClass->CancerChemotherapy_CT=$this->input->post('CancerChemotherapy_CT');
                 $patientinformationClass->CancerChemotherapy_initialDate=$this->input->post('CancerChemotherapy_initialDate');
                 $patientinformationClass->CancerTargetTherapy_PreTx=$this->input->post('CancerTargetTherapy_PreTx');
                 $patientinformationClass->CancerTargetTherapy_Tx=$this->input->post('CancerTargetTherapy_Tx');
                 $patientinformationClass->CancerTargetTherapy_initialDate=$this->input->post('CancerTargetTherapy_initialDate');
                 $patientinformationClass->CancerHormoneTherapy_PreTx=$this->input->post('CancerHormoneTherapy_PreTx');
                 $patientinformationClass->CancerHormoneTherapy_Tx=$this->input->post('CancerHormoneTherapy_Tx');
                 $patientinformationClass->CancerHormoneTherapy_initialDate=$this->input->post('CancerHormoneTherapy_initialDate');
                 $patientinformationClass->CancerImmunotherapy_PreImm=$this->input->post('CancerImmunotherapy_PreImm');
                 $patientinformationClass->CancerImmunotherapy_Imm=$this->input->post('CancerImmunotherapy_Imm');
                 $patientinformationClass->CancerImmunotherapy_initialDate=$this->input->post('CancerImmunotherapy_initialDate');
                 
                        
                          //20170214修改開始
                      
                $this->PatientInformation_Model->Update_patient($patientID, $patientinformationClass);
                $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                        //20170214修改結束
                if(comparePatient($patientinformationClassOrignal,$patientinformationClass)=="Y"){
               
           $access_id=accessLog('U','PATIENT',$patientID,$this->session->userdata('userRealname').'修改病患資料【病史資料:其他治療】(病歷號:'.$patientinformationClass->patientChartNumber.')','S');
                $patientinformationClassOrignal->patientID=null;
           $patientinformationClassOrignal->modifiedFlag='1';
           $patientinformationClassOrignal->isSaved=$access_id;
           $patientinformationClass->patientID=null;
          $patientinformationClass->modifiedFlag='2';
           $patientinformationClass->isSaved=$access_id;
           $this->PatientInformation_Model->Save_patienthistory($patientinformationClassOrignal);
           $this->PatientInformation_Model->Save_patienthistory($patientinformationClass);
                }
                        //$this->PatientInformation_Model->Update_patient($patientID, $patientinformationClass);
                  $data['page']="index";   
            $data['patientpage']="divCancer";   
            $data['cancerpage']="divCancerBody";   
                  $data['msg']="其他治療資料存檔完成";  
                  $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
                  $column = $this->PatientInformation_Model->viewRecord($patientID);
                  $data['myContent']=$column;  
               
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
                     $procedureCatList = $this->Parameter_Model->query_procedureCategoryList();
        $data['procedureCatList']=$procedureCatList;  
                 $this->load->view('patient/content',$data);
  }
   
  
  function cancerStatus(){
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
                 if($patientinformationClass->diseaseType=="1"){
                          $patientinformationClass->CancerClinical_T=$this->input->post('CancerClinical_T_lung');
                 $patientinformationClass->CancerClinical_N=$this->input->post('CancerClinical_N_lung');
                 $patientinformationClass->CancerClinical_M=$this->input->post('CancerClinical_M_lung');
                 $patientinformationClass->CancerClinical_StageGroup=$this->input->post('CancerClinical_StageGroup_lung');
                 $patientinformationClass->CancerPathological_T=$this->input->post('CancerPathological_T_lung');
                 $patientinformationClass->CancerPathological_N=$this->input->post('CancerPathological_N_lung');
                 $patientinformationClass->CancerPathological_M=$this->input->post('CancerPathological_M_lung');
                 $patientinformationClass->CancerPathological_Stage=$this->input->post('CancerPathological_Stage_lung');
                 } else if($patientinformationClass->diseaseType=="5"){
                         $patientinformationClass->CancerClinical_T=$this->input->post('CancerClinical_T_e');
                 $patientinformationClass->CancerClinical_N=$this->input->post('CancerClinical_N_e');
                 $patientinformationClass->CancerClinical_M=$this->input->post('CancerClinical_M_e');
                 $patientinformationClass->CancerClinical_StageGroup=$this->input->post('CancerClinical_StageGroup_e');
                 $patientinformationClass->CancerPathological_T=$this->input->post('CancerPathological_T_e');
                 $patientinformationClass->CancerPathological_N=$this->input->post('CancerPathological_N_e');
                 $patientinformationClass->CancerPathological_M=$this->input->post('CancerPathological_M_e');
                 $patientinformationClass->CancerPathological_Stage=$this->input->post('CancerPathological_Stage_e');
                 } else {
                     $patientinformationClass->CancerClinical_T="";
                 $patientinformationClass->CancerClinical_N="";
                 $patientinformationClass->CancerClinical_M="";
                 $patientinformationClass->CancerClinical_StageGroup="";
                 $patientinformationClass->CancerPathological_T="";
                 $patientinformationClass->CancerPathological_N="";
                 $patientinformationClass->CancerPathological_M="";
                 $patientinformationClass->CancerPathological_Stage="";
                 
                 }
                  $patientinformationClass->CancerStage_memo=$this->input->post('CancerStage_memo');
                        
                          //20170214修改開始
                      
                $this->PatientInformation_Model->Update_patient($patientID, $patientinformationClass);
                $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                        //20170214修改結束
                if(comparePatient($patientinformationClassOrignal,$patientinformationClass)=="Y"){
               
           $access_id=accessLog('U','PATIENT',$patientID,$this->session->userdata('userRealname').'修改病患資料【病史資料:生活型態】(病歷號:'.$patientinformationClass->patientChartNumber.')','S');
                $patientinformationClassOrignal->patientID=null;
           $patientinformationClassOrignal->modifiedFlag='1';
           $patientinformationClassOrignal->isSaved=$access_id;
           $patientinformationClass->patientID=null;
          $patientinformationClass->modifiedFlag='2';
           $patientinformationClass->isSaved=$access_id;
           $this->PatientInformation_Model->Save_patienthistory($patientinformationClassOrignal);
           $this->PatientInformation_Model->Save_patienthistory($patientinformationClass);
                }
                        //$this->PatientInformation_Model->Update_patient($patientID, $patientinformationClass);
                $data['page']="index";   
            $data['patientpage']="divCancer";   
            $data['cancerpage']="divCancerClinic";
                  $data['msg']="癌症分期資料存檔完成";  
                  $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
                  $column = $this->PatientInformation_Model->viewRecord($patientID);
                  $data['myContent']=$column;  
               
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
                     $procedureCatList = $this->Parameter_Model->query_procedureCategoryList();
        $data['procedureCatList']=$procedureCatList;  
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
        $procedureCatList = $this->Parameter_Model->query_procedureCategoryList();
        $data['procedureCatList']=$procedureCatList;  
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
      
    $this->load->view('patient/printPatient',$data);
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
  
  function queryProcedure($d,$t){
       $this->load->model('PatientInformation_Model');
   
       $data['Procedure']=$this->PatientInformation_Model->selectProcedure($t);
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
        $procedureCatList = $this->Parameter_Model->query_procedureCategoryList();
        $data['procedureCatList']=$procedureCatList;  
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
        $procedureCatList = $this->Parameter_Model->query_procedureCategoryList();
        $data['procedureCatList']=$procedureCatList;  
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
        $procedureCatList = $this->Parameter_Model->query_procedureCategoryList();
        $data['procedureCatList']=$procedureCatList;  
                 $this->load->view('patient/content',$data);
                 
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
     
     function uncompleteMemo(){
        $this->load->view('patient/uncompleteMemo');
  }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */