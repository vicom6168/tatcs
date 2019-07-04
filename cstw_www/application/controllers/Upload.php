<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {

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
         
        $this->load->model('Analysis_Model');
        $this->load->helper('form');
    }
    
    public function index()
    {
        $d1=$this->input->post('qDate1')==null?"":$this->input->post('qDate1');
     $d2=$this->input->post('qDate2')==null?"":$this->input->post('qDate2');
     $h1=$this->input->post('patientHospital')==null?"":$this->input->post('patientHospital');
        $data['result_msg']='';
        //$this->load->view('homenew',$data);
         $this->load->model('PatientInformation_Model');
      
        $data['patientList']=$this->PatientInformation_Model->export_uploadpatientlist($d1,$d2,$h1);
        
       
      $data['d1']=$d1;
     $data['d2']=$d2;
     $data['h1']=$h1;
     $data['page']="upload";  
     $data['subpage']="patient"; 
     $data['path']="<li>上傳學會</li><li  class='break'>&#187;</li>";
     $this->load->view('upload/index',$data);
     }
        public function nonsurgery()
    {
        $y1=$this->input->post('y1')==null?"":$this->input->post('y1');
     $m1=$this->input->post('m1')==null?"":$this->input->post('m1');
     $y2=$this->input->post('y2')==null?"":$this->input->post('y2');
     $m2=$this->input->post('m2')==null?"":$this->input->post('m2');
     $h1=$this->input->post('patientHospital')==null?"":$this->input->post('patientHospital');
        $data['result_msg']='';
        //$this->load->view('homenew',$data);
         $this->load->model('PatientInformation_Model');
      
        $data['patientList']=$this->PatientInformation_Model->export_uploadNonSurgery($y1,$m1,$y2,$m2,$h1);
        
       
      $data['y1']=$y1;
     $data['m1']=$m1;
      $data['y2']=$y2;
     $data['m2']=$m2;
     $data['h1']=$h1;
     $data['page']="upload";  
     $data['subpage']="nonsurgery"; 
     $data['path']="<li>上傳學會</li><li  class='break'>&#187;</li>";
     $this->load->view('upload/nonsurgery',$data);
     }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */