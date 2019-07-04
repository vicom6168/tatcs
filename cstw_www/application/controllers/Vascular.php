<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vascular extends CI_Controller {

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
   
     $data['path']="<li>Vascular special sheet</li><li  class='break'>&#187;</li>";
   
        $config['per_page'] = 20; 
        $data['contactList']=$this->Contact_Model->query_contactList($page,$config['per_page']);
        $config['total_rows'] = $this->Contact_Model->query_contactList(0,0)->num_rows() ;
        $config['base_url'] = base_url().'vascular/index/';
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
            $data['page']="contact";    
     
        
     $this->load->view('contact/index',$data);
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
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */