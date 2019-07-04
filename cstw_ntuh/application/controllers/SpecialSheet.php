<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SpecialSheet extends CI_Controller {

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
        redirect(base_url().'homenew', 'refresh');
         
        $this->load->model('Contact_Model');
        $this->load->helper('form');
    }
    
    public function index($page=0)
    {
        
        $data['result_msg']='';
     $data['page']="specialsheet";    
     $data['subpage']="index";  
     $data['path']="<li>我要提問</li><li  class='break'>&#187;</li>";
   
       
     
        
     $this->load->view('specialsheet/index',$data);
     }
    public function SPList()
    {
        $data['path']="<li>特殊表單</li><li  class='break'>&#187;特殊表單列表</li>";
        $data['result_msg']='';
     $data['page']="specialsheet";    
     $data['subpage']="index";  
    
       
     
        
     $this->load->view('specialsheet/SPList',$data);
     }
    
    public function LVAD($qryField="0",$qryOrder="0",$qryStr='999999999',$page=0)
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
        $data['patientList']=$this->PatientInformation_Model->query_patientLVADlist($qryField,$qryOrder,urldecode($qryStr),$page,$config['per_page']);
        $config['total_rows'] = $this->PatientInformation_Model->query_patientLVADlist($qryField,$qryOrder,urldecode($qryStr),0,0)->num_rows() ;
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
             $data['page']="specialsheet";    
           $data['subpage']="index";  
        $data['path']="<li>VAD 病患資料列表</li>";
        $data['qStr']=$qryStr=="999999999"?"":urldecode($qryStr);
        $data['qField']=$qryField;
        $data['qOrder']=$qryOrder;
        $this->load->view('specialsheet/LVAD',$data);
    }
   
          public function addcontact()
    {
        
        $data['result_msg']='';
      $data['page']="contact";  
     $data['path']="<li>我要提問</li><li  class='break'>&#187;</li>";
     $this->load->view('contact/addcontact',$data);
     }
    
    
    public function savecontact(){
         $data['page']="contact";   
      $data['path']="<li>我要提問</li><li  class='break'>&#187;</li>";
      $data['msg']="已把資料傳送給學會管理者, 謝謝您";
  
    
        $this->load->library('contactClass');
                $contactClass= new contactClass;
                $contactClass->username=$this->input->post('username');
                $contactClass->hospital=$this->config->item('hospitalName');;
                $contactClass->content=$this->input->post('content');
                $contactClass->email=$this->input->post('email');
               
                $contactClass->phone=$this->input->post('phone');
                $contactClass->subject=$this->input->post('subject');
                $contactClass->submittime= date('Y-m-d H:i:s');
                $contactClass->status="1";   
                
                $id=$this->Contact_Model->save_contact($contactClass);
          $access_id=accessLog('A','Contact',$id,$this->session->userdata('userRealname').'新增我要提問【'.$this->input->post('subject').'】','S');
        $this->load->view('contact/addcontact',$data);
        }


public function editcontact(){
         $data['page']="contact";   
      $data['path']="<li>我要提問</li><li  class='break'>&#187;</li>";
      $data['msg']="已把資料傳送給學會管理者, 謝謝您";
  
    
        $this->load->library('contactClass');
                $cantactClass= new cantactClass;
                $cantactClass->username=$this->input->post('username');
                $cantactClass->hospital=$this->config->item('hospitalName');;
                $cantactClass->content=$this->input->post('content');
                $cantactClass->email=$this->input->post('email');
               
                $cantactClass->phone=$this->input->post('phone');
                $cantactClass->subject=$this->input->post('subject');
                $cantactClass->submittime= date('Y-m-d H:i:s');
                $cantactClass->status="1";   
                
                $this->Contact_Model->save_contact($cantactClass);
          $access_id=accessLog('A','Contact',$id,$this->session->userdata('userRealname').'新增我要提問【'.$this->input->post('subject').'】','S');
        $this->load->view('contact/addcontact',$data);
        }



    public function Vascular($qryField="0",$qryOrder="0",$qryStr='999999999',$page=0)
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
        $data['patientList']=$this->PatientInformation_Model->query_patientVascularlist($qryField,$qryOrder,urldecode($qryStr),$page,$config['per_page']);
        $config['total_rows'] = $this->PatientInformation_Model->query_patientVascularlist($qryField,$qryOrder,urldecode($qryStr),0,0)->num_rows() ;
        $config['base_url'] = base_url().'specialSheet/Vascular/'.$qryField.'/'.$qryOrder.'/'.$qryStr;
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
             $data['page']="specialsheet";    
        $data['subpage']="Vascular";  
        $data['path']="<li>Vascular 病患資料列表</li>";
        $data['qStr']=$qryStr=="999999999"?"":urldecode($qryStr);
        $data['qField']=$qryField;
        $data['qOrder']=$qryOrder;
        $this->load->view('specialsheet/Vascular',$data);
    }
    function addVascularPatient(){
        $this->load->library('session');
        if($this->session->userdata('userID')=="" )
             redirect(base_url().'homenew', 'refresh');
           
        $this->load->model('Parameter_Model');
        $vsList = $this->Parameter_Model->query_vsList();
        $data['vsList']=$vsList;  
        $data['page']="specialsheet";    
        $data['subpage']="Vascular";  
        $data['path']="<li>Vascular 病患資料</li><li>Vascular special sheet</li><li  class='break'>&#187; 新增病患</li>";
        $this->load->view('patient/addVascularPatient',$data);
  }
   function saveVascularPatient(){
       $this->load->library('session');
        if($this->session->userdata('userID')=="" )
             redirect(base_url().'homenew', 'refresh');
           
        $this->load->model('Vascular_Model');
        
        
        $this->load->library('VascularClass');
        
               // $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                       $VascularClass= new VascularClass;
                $VascularClass->patientChartNumber=$this->input->post('patientChartNumber');
                $VascularClass->patientHospital=$this->input->post('patientHospital');
                $VascularClass->patientName=$this->input->post('patientName');
                $VascularClass->patientBirthday=$this->input->post('patientBirthday');
                $VascularClass->patientAge=$this->input->post('patientAge');
                $VascularClass->patientAgeDescription=$this->input->post('patientAgeDescription');
                $VascularClass->patientAgeUnit=$this->input->post('patientAgeUnit');
                $VascularClass->patientGender=$this->input->post('patientGender')==null?"":$this->input->post('patientGender');
                $VascularClass->patientSurgeon=$this->input->post('patientSurgeon');
                $VascularClass->patientSurgeon2=$this->input->post('patientSurgeon2');
                $VascularClass->patientSurgeon3=$this->input->post('patientSurgeon3');
                $VascularClass->patientSurgeon4=$this->input->post('patientSurgeon4');
                $VascularClass->patientSurgeon_id=$this->input->post('patientSurgeon_id');
                $VascularClass->patientSurgeon_id2=$this->input->post('patientSurgeon_id2');
                $VascularClass->patientSurgeon_id3=$this->input->post('patientSurgeon_id3');
                $VascularClass->patientSurgeon_id4=$this->input->post('patientSurgeon_id4');
                
                $VascularClass->patientProcedure1=$this->input->post('patientProcedure1');
                $VascularClass->patientProcedure2=$this->input->post('patientProcedure2');
                $VascularClass->patientProcedure3=$this->input->post('patientProcedure3');
                $VascularClass->patientProcedure4=$this->input->post('patientProcedure4');
                $VascularClass->patientProcedure5=$this->input->post('patientProcedure5');
                $VascularClass->patientProcedure_id1=$this->input->post('patientProcedure_id1');
                $VascularClass->patientProcedure_id2=$this->input->post('patientProcedure_id2');
                $VascularClass->patientProcedure_id3=$this->input->post('patientProcedure_id3');
                $VascularClass->patientProcedure_id4=$this->input->post('patientProcedure_id4');
                $VascularClass->patientProcedure_id5=$this->input->post('patientProcedure_id5');
                
                $VascularClass->patientOpDate=$this->input->post('patientOpDate');
                $VascularClass->patientProcedureOthers=$this->input->post('patientProcedureOthers');
                $VascularClass->patientDiagnosis=$this->input->post('patientDiagnosis');
                $VascularClass->vascularMemo=$this->input->post('vascularMemo');
                
                        $VascularClass->isDeleted='N';
                $VascularClass->createPerson=$this->session->userdata('userID');
                $VascularClass->createTime=date('Y-m-d H:i:s');
                    
                $insert_id=$this->Vascular_Model->Save_patient($VascularClass);
                accessLog('A','Vascular',$insert_id,$this->session->userdata('userRealname').'新增Vascular病患資料【病歷號碼：'.$this->input->post('patientChartNumber').'】','S');
        
                redirect(base_url().'specialSheet/Vascular/', 'refresh');
                 
   }
 function viewVascularRecord($pid){
         $this->load->library('session');
        if($this->session->userdata('userID')=="" )
        redirect(base_url().'homenew', 'refresh');
        
      
        $data['msg']="";  
        $data['page']="specialsheet";    
        $data['subpage']="Vascular";  
        $data['path']="<li>Vascular 病患資料</li><li>Vascular special sheet</li><li  class='break'>&#187; 檢視病患</li>";
        $this->load->model('Vascular_Model'); 
       
        if($pid!='')
            $column = $this->Vascular_Model->viewVascularRecord($pid);
        $data['myContent']=$column;  
      
        
        
        $this->load->model('Parameter_Model');  
        
        $vsList = $this->Parameter_Model->query_vsList();
        $data['vsList']=$vsList;  
        $this->load->view('patient/Vascularcontent',$data);
    }
 
  function updateVascularRecord(){
        $this->load->library('session');
        if($this->session->userdata('userID')=="" )
             redirect(base_url().'homenew', 'refresh');
           
       $this->load->model('Vascular_Model');
        
        
        $this->load->library('VascularClass');
        
        $patientID=$this->input->post('patientID');
        
               // $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                       $VascularClass= new VascularClass;
                $VascularClass = $this->Vascular_Model->viewVascularRecord($patientID)->row();
               $VascularClass->patientChartNumber=$this->input->post('patientChartNumber');
                $VascularClass->patientHospital=$this->input->post('patientHospital');
                $VascularClass->patientName=$this->input->post('patientName');
                $VascularClass->patientBirthday=$this->input->post('patientBirthday');
                $VascularClass->patientAge=$this->input->post('patientAge');
                $VascularClass->patientAgeDescription=$this->input->post('patientAgeDescription');
                $VascularClass->patientAgeUnit=$this->input->post('patientAgeUnit');
                $VascularClass->patientGender=$this->input->post('patientGender')==null?"":$this->input->post('patientGender');
                $VascularClass->patientSurgeon=$this->input->post('patientSurgeon');
                $VascularClass->patientSurgeon2=$this->input->post('patientSurgeon2');
                $VascularClass->patientSurgeon3=$this->input->post('patientSurgeon3');
                $VascularClass->patientSurgeon4=$this->input->post('patientSurgeon4');
                $VascularClass->patientSurgeon_id=$this->input->post('patientSurgeon_id');
                $VascularClass->patientSurgeon_id2=$this->input->post('patientSurgeon_id2');
                $VascularClass->patientSurgeon_id3=$this->input->post('patientSurgeon_id3');
                $VascularClass->patientSurgeon_id4=$this->input->post('patientSurgeon_id4');
                
                $VascularClass->patientProcedure1=$this->input->post('patientProcedure1');
                $VascularClass->patientProcedure2=$this->input->post('patientProcedure2');
                $VascularClass->patientProcedure3=$this->input->post('patientProcedure3');
                $VascularClass->patientProcedure4=$this->input->post('patientProcedure4');
                $VascularClass->patientProcedure5=$this->input->post('patientProcedure5');
                $VascularClass->patientProcedure_id1=$this->input->post('patientProcedure_id1');
                $VascularClass->patientProcedure_id2=$this->input->post('patientProcedure_id2');
                $VascularClass->patientProcedure_id3=$this->input->post('patientProcedure_id3');
                $VascularClass->patientProcedure_id4=$this->input->post('patientProcedure_id4');
                $VascularClass->patientProcedure_id5=$this->input->post('patientProcedure_id5');
                
                $VascularClass->patientOpDate=$this->input->post('patientOpDate');
                $VascularClass->patientProcedureOthers=$this->input->post('patientProcedureOthers');
                $VascularClass->patientDiagnosis=$this->input->post('patientDiagnosis');
                $VascularClass->vascularMemo=$this->input->post('vascularMemo');
                
                $VascularClass->isDeleted='N';
                $VascularClass->modifyPerson=$this->session->userdata('userID');
                $VascularClass->modifyTime=date('Y-m-d H:i:s');
                  $this->Vascular_Model->update_patient($patientID, $VascularClass);
              
                
           $access_id=accessLog('U','Vascular',$patientID,$this->session->userdata('userRealname').'修改Vascular病患資料(病歷號:'.$VascularClass->patientChartNumber.')','S');
         
               $data['msg']="病患資料修改完成";  
        $data['page']="specialsheet";    
        $data['subpage']="Vascular";  
        $data['path']="<li>Vascular 病患資料</li><li>Vascular special sheet</li><li  class='break'>&#187; 檢視病患</li>";
        $this->load->model('Vascular_Model'); 
       
        if($patientID!='')
            $column = $this->Vascular_Model->viewVascularRecord($patientID);
        $data['myContent']=$column;  
      
     
                          
        $this->load->model('Parameter_Model'); 
                       
                 $vsList = $this->Parameter_Model->query_vsList();
                 $data['vsList']=$vsList;   
                   $this->load->view('patient/Vascularcontent',$data);
  }
 
     public function deleteVascularRecord($pid){
       // $this->load->library('session');
       // if($this->session->userdata('userID')=="" )
       // redirect(base_url().'homenew', 'refresh');
         $this->load->model('Vascular_Model'); 
        if($pid!=''){
            $query = $this->Vascular_Model->viewVascularRecord($pid);
        $column = $this->Vascular_Model->deleteVascularRecord($pid);
        accessLog('D','Vascular',$query->row()->patientID,$this->session->userdata('userRealname').'刪除Vascular病患資料【病歷號碼：'.$query->row()->patientChartNumber.'】','S');
        }
        redirect(base_url().'specialSheet/Vascular', 'refresh');
    }

 function queryVascularProcedure($d){
       $this->load->model('PatientInformation_Model');
   
       $data['Procedure']=$this->PatientInformation_Model->selectVascularProcedure();
       $data['w']= $d;
       $this->load->view('patient/vascularprocedure',$data);
  }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */