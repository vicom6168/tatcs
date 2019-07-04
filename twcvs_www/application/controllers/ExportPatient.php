<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ExportPatient extends CI_Controller {

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
        redirect(base_url().'home', 'refresh');
         
        $this->load->model('Analysis_Model');
        $this->load->helper('form');
    }
    
public function index()
    {
         $this->load->library('session');
        if($this->session->userdata('userID')=="")
        redirect(base_url().'home/home', 'refresh');
        
     $d1=$this->input->post('qDate1')==null?"1900-01-01":$this->input->post('qDate1');
     $d2=$this->input->post('qDate2')==null?"1900-01-01":$this->input->post('qDate2');
     $h1=$this->input->post('patientHospital')==null?"":$this->input->post('patientHospital');
        $data['result_msg']='';
        $data['patientList']='';
        //$this->load->view('home/home',$data);
         $this->load->model('PatientInformation_Model');
      if( $d1!='' &&  $d2!=''){
        $data['patientList']=$this->PatientInformation_Model->export_patientlist($d1,$d2,$h1);
        $access_id=accessLog('R','EXPORT',$this->session->userdata('userID'),$this->session->userdata('userRealname').'病患資料匯出 (期間:'.$d1.'~'.$d2.')','S');
      }
      if($d1=='1900-01-01') 
      $data['d1']='';
    else
      $data['d1']=$d1;
     if($d2=='1900-01-01') 
      $data['d2']='';
    else
      $data['d2']=$d2;
     $data['h1']=$h1;
        $data['page']="export";    
        $data['path']="<li>病患資料匯出</li><li  class='break'>&#187;</li><li>病患資料列表</li>";
        $this->load->view('exportpatient/query',$data);
    }
   
     
     public function EXCEL($d1,$d2,$h1)
    {
         $this->load->model('PatientInformation_Model');
        $data['patientList']=$this->PatientInformation_Model->export_patientlistCVS($d1,$d2,$h1);
     $data['page']="analysis";  
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
     
     $data['d1']=$d1;
     $data['d2']=$d2;
     $data['h1']=$h1;
     $access_id=accessLog('R','EXPORT',$this->session->userdata('userID'),$this->session->userdata('userRealname').'病患資料EXCEL匯出 (期間:'.$d1.'~'.$d2.')','S');
     
        $this->load->view('exportpatient/EXCEL',$data);
    }
  
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */