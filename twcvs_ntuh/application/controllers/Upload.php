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
     $h1= $this->session->userdata('hospital');
        $data['result_msg']='';
        //$this->load->view('homenew',$data);
         $this->load->model('PatientInformation_Model');
     $data['patientLastupdateTime']= $this->PatientInformation_Model->query_uploadpatienttime()->row()->patientLastupdateTime;
     if($d1!="" && $d2!=""){
     $data['patientList']=$this->PatientInformation_Model->export_uploadpatientlist($d1,$d2,$h1,$data['patientLastupdateTime']);
     } else {
          $data['patientList']=$this->PatientInformation_Model->export_uploadpatientlist("1900-01-01","1900-01-01",$h1,$data['patientLastupdateTime']);
     }
       
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
    
    function uploadeddata($page=0,$qryField="0",$qryOrder="0",$qryStr='999999999'){
         $this->load->library('session');
        if($this->session->userdata('userID')=="")
        redirect(base_url().'homenew', 'refresh');
     
        $data['result_msg']='';
        
        $qryStr=$this->session->userdata('hospital');
        //$this->load->view('homenew',$data);
         $this->load->model('PatientInformation_Model');
      $this->load->model('Parameter_Model');
      //  $column = $this->PatientInformation_Model->query_patientlist();
            $config['per_page'] = 100; 
        $data['patientList']=$this->PatientInformation_Model->query_uploadpatientlist($qryField,$qryOrder,urldecode($qryStr),$page,$config['per_page']);
        $config['total_rows'] = $this->PatientInformation_Model->query_uploadpatientlist($qryField,$qryOrder,urldecode($qryStr),0,0)->num_rows() ;
        $config['base_url'] = base_url().'upload/uploadeddata/';
        $config['num_links'] = 2;
        $config['uri_segment'] =3;
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
            $data['page']="upload";    
        $data['path']="<li>已上傳病患資料列表</li>";
        $data['qStr']=$qryStr=="999999999"?"":urldecode($qryStr);
        $data['qField']=$qryField;
        $data['qOrder']=$qryOrder;
        $this->load->view('upload/uploadeddata',$data);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */